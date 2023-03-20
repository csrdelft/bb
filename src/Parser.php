<?php

namespace CsrDelft\Lib\Bb;

use CsrDelft\Lib\Bb\Internal\BbError;
use CsrDelft\Lib\Bb\Internal\BbString;
use CsrDelft\Lib\Bb\Tag\BbNode;

/**
 * Main BB-code Parser file
 *
 * This file is based on the eamBBParser class of the eamBBParser project.
 */
abstract class Parser
{
    const BR_TAG = '[br]';
    const TAG_NOHTML_OPEN = '[nohtml]';
    const TAG_HTML_CLOSE = '[/html]';
    const TAG_HTML_OPEN = '[html]';
    const TAG_NOHTML_CLOSE = '[/nohtml]';
    /**
     * Array holding tags & text
     *
     * An array, like this ->
     * Array (
     *    [0] => Hello, this is
     *    [1] => [b]
     *    [2] => bold
     *    [3] => [/b]
     *    [4] => , cool huh?!
     *      )
     *
     * @var string[]
     */
    public $parseArray = array();
    /**
     * Maximum allowed number of tags
     *
     * When having trouble with users trying to get down the server by using tons of tags, lower this limit.
     * Open and closing tags will count towards max.
     * @var int Maximum number of tags to be parsed.
     *
     */
    public $maxTags = 2000;
    /**
     * Allow HTML in code
     *
     * Whether or not to allow HTMl code. Default is false. When set to false, [html] tag won't do anything.
     * @var boolean
     */
    public $allowHtml = false;
    /**
     * Accept html by default
     *
     * When set to true, html will be accepted. When set to false, only html within [html] tags will be accepted.
     * This setting only has effect when $allow_html is set to true.
     * @var boolean
     */
    public $standardHtml = false;
    /**
     * It's possible with the ubboff tag to switch processing off.
     *
     * Keep track of ubb status
     *
     * When we're in a [ubboff] block, this will be false. Otherwise true.
     * Also used by [commentaar] and [prive]
     */
    public $bbMode = true;
    /**
     * Enable paragraph mode
     *
     * When set to true, the parser will try to use &lt;p&gt; tags around text, and remove unnecessary br's.
     * <b>This is an experimental feature! Please let me know if you find strange behaviour!</b>
     * @var boolean
     */
    protected $paragraphMode = false;
    /**
     * Storage for outgoing HTML
     */
    private $html;
    /**
     * How deep are we; e.g. How many open tags?
     */
    private $level = 0;
    /**
     * Amount of tags already parsed
     */
    private $tagsCounted = 0;
    /**
     * Keep track of open paragraphs
     */
    private $paragraphOpen = false;
    /**
     * Tags that do not need to be encapsulated in paragraphs, filled in constructor.
     */
    private $paragraphlessTags = ['br'];
    /**
     * Keep track of current paragraph-required-status
     *
     * When we're in a tag that does not need to be encapsulate in a paragraph, this var will be false, otherwise true.
     * Works only when in paragraph mode.
     */
    private $paragraphRequired = true;
    /**
     * Environment
     *
     * @var BbEnv
     */
    private $env = null;
    /**
     * @var BbTag[]|string[]
     */
    private $registry = [];

    public function __construct($env = null)
    {
        if (is_null($env)) {
            $env = new BbEnv();
        }

        $this->env = $env;

        foreach ($this->getTags() as $tag) {
            if (is_array($tag::getTagName())) {
                foreach ($tag::getTagName() as $tagName) {
                    $this->registry[$tagName] = $tag;
                }
            } else {
                $this->registry[$tag::getTagName()] = $tag;
            }

            if ($tag::isParagraphLess()) {
                $this->paragraphlessTags[] = $tag::getTagName();
            }
        }
    }

    /**
     * @param BbEnv|mixed|null $env
     */
    public function setEnv($env): void
    {
        $this->env = $env;
    }

    abstract public function getTags();

    /**
     * Transform BB code to HTML code.
     *
     * This method takes a text with BB code and transforms it to HTML.
     * @param string $bbcode BB code to be transformed
     * @return string HTML
     */
    public function getHtml($bbcode)
    {
        if (strlen($bbcode) == 0) {
            return null;
        }

        $blocks = $this->parseString($bbcode);

        $html = $this->render($blocks, $this->env->mode);

        $this->html = str_replace(self::BR_TAG, "<br />\n", $html);

        return $this->html;
    }

    /**
     * @param string $bbcode
     * @return BbNode[]|null
     */
    public function parseString($bbcode)
    {
        if ($this->env->mode !== "preview" && $this->env->mode !== "plain") {
            $bbcode = str_replace(array("\r\n", "\n"), self::BR_TAG, $bbcode);
        }

        // Create the parsearray with the buildarray function, pretty nice ;)
        $this->tagsCounted = 0;
        $this->parseArray = $this->tokenize($bbcode);

        // Fix html rights
        $this->htmlFix();

        return $this->parseArray();
    }

    /**
     * Renders a Node[] to a string.
     *
     * @param BbNode[] $blocks
     * @param string $mode
     * @return string
     */
    public function render($blocks, $mode)
    {
        if (empty($blocks)) {
            return '';
        }

        $text = '';

        foreach ($blocks as $block) {
            try {
                if ($block->isAllowed()) {
                    $block->setContent($this->render($block->getChildren(), $mode));

                    if ($mode == "light") {
                        $text .= $block->renderLight();
                    } elseif ($mode == "preview") {
                        $text .= $block->renderPreview();
                    } elseif ($mode == "plain") {
                        $text .= $block->renderPlain();
                    } else {
                        $text .= $block->render();
                    }
                } else {
                    $text .= '';
                }
            } catch (BbException $exception) {
                $text .= $exception->getMessage();
            }
        }

        return $text;
    }

    private function tokenize($str)
    {
        $tokens = "[]";

        $index = 0;
        $prevIndex = 0;
        $numTags = 0;

        $word = strtok($str, $tokens);

        while (false !== $word) {
            $index = strpos($str, $word, $index);

            // This word is a tag if it it surrounded by [ and ]
            if (strpos($str, "[$word]", $index - 1) === $index - 1) {
                $words[] = "[$word]";
                $index += strlen($word) + 1;

                $numTags++;
            } else {
                $words[] = substr($str, $prevIndex, $index + strlen($word) - $prevIndex);
                $index += strlen($word);
            }

            $word = strtok($tokens);

            $prevIndex = $index;

            if ($numTags > $this->maxTags) {
                return ['<b style="color:red">[max # of tags reached, quitting splitting procedure]</b>' . $str];
            }
        }

        // The string can have trailing tokens, we want to return these.
        $words[] = substr($str, $index);

        // Cleanup
        strtok('', '');

        return $words;
    }

    /**
     * Set [html] and [nohtml] tags according to settings
     */
    private function htmlFix()
    {
        // First, check if html is allowed
        if (!$this->allowHtml) {
            $html = false;
        } elseif ($this->standardHtml) {
            $html = true;
        } else {
            $html = false;
        }

        $newParseArray = array();
        while ($tag = array_shift($this->parseArray)) {
            switch ($tag) {
                case self::TAG_NOHTML_OPEN:
                case self::TAG_HTML_CLOSE:
                    $html = false;
                    break;
                case self::TAG_HTML_OPEN:
                case self::TAG_NOHTML_CLOSE:
                    if ($this->allowHtml) {
                        $html = true;
                    }
                    break;

                default:
                    if ($html) {
                        if ($tag == self::BR_TAG) {
                            $tag = "\n";
                        } // Really, no BR's in html code is wanted.
                        $newParseArray[] = $tag;
                    } else {
                        $newParseArray[] = htmlspecialchars($tag);
                    }
            }
        }
        $this->parseArray = $newParseArray;
        return true;
    }

    /**
     * Process array
     *
     * Walks through the array until one of the stoppers is found. When encountering an 'open' tag, which is not in $forbidden, open corresponding bb_ function.
     * @param array $stoppers
     * @param array $forbidden
     * @return BbNode[]
     */
    public function parseArray($stoppers = [], $forbidden = [])
    {
        if (!is_array($this->parseArray)) { // Well, nothing to parse
            return null;
        }
        $blocks = [];

        $forbiddenAantalOpen = 0;
        while ($entry = array_shift($this->parseArray)) {
            if (in_array($entry, $stoppers)) {
                if ($forbiddenAantalOpen == 0) {
                    $this->level--;
                    return $blocks;
                } else {
                    $forbiddenAantalOpen--;
                    $blocks[] = new BbString($entry);
                }
            } else {
                $tag = $this->getTag($entry);

                if ($tag && in_array($tag, $forbidden)) {
                    if ($tag != 'br') {
                        $forbiddenAantalOpen++;
                    } else {
                        $entry = "\n";
                    }
                }

                $isOpenTag = $this->isOpenTag($entry);
                $isAllowed = !in_array($tag, $forbidden) && !isset($forbidden['all']);
                $exists = isset($this->registry[$tag]);

                if ($this->bbMode && $isOpenTag && $exists && $isAllowed) {
                    $tagInstance = $this->createTagInstance($this->registry[$tag], $this, $this->env);

                    $arguments = $this->getArguments($entry);

                    if ($this->paragraphMode) {
                        // Add paragraphs if necessary

                        $paragraphSettingModified = false;
                        if (!$this->paragraphOpen && !in_array($tag, $this->paragraphlessTags) && $this->level == 0) {  // Only encaps when level = 0, we don't want paragraphs inside lists or stuff
                            $text .= '<p>';
                            $this->paragraphOpen = true;
                        } elseif (in_array($tag, $this->paragraphlessTags)) {
                            // We're in some tag that doesn't need to be <p> enclosed, like a heading or a table.
                            if ($this->paragraphRequired) {
                                $paragraphSettingModified = true;
                                $this->paragraphRequired = false;
                            }
                            if ($this->paragraphOpen && $this->level == 0) {
                                $this->paragraphOpen = false;
                            }
                        }
                    }

                    $this->level++;
                    try {
                        $tagInstance->parse($arguments);
                    } catch (BbException $ex) {
                        $tagInstance = new BbError($ex->getMessage());
                    }

                    // Reset paragraph_required.
                    if ($this->paragraphMode && $paragraphSettingModified) {
                        $this->paragraphRequired = true;
                    }

                    $blocks[] = $tagInstance;
                } else {

                    if ($this->paragraphMode && $entry == self::BR_TAG) {
                        $shift = array_shift($this->parseArray);
                        if ($shift == self::BR_TAG) {
                            // Two brs, looks like a new paragraph!
                            // First, check for more. We don't want endless <p></p> pairs, that doesn't work.

                            $secondshift = array_shift($this->parseArray);
                            while ($secondshift == self::BR_TAG) {
                                $secondshift = array_shift($this->parseArray);
                            }
                            array_unshift($this->parseArray, $secondshift);

                            $shift = array_shift($this->parseArray);

                            if ($this->paragraphRequired && !in_array($this->getTag($shift), $this->paragraphlessTags)) {
                                if ($this->paragraphOpen) {
                                    if ($this->level == 0) {
                                        // Close old one, and open new one
                                        $entry = "</p>\n\n<p>";
                                        $this->paragraphOpen = true;
                                    }
                                } else {
                                    if ($this->level == 0) {
                                        /** @noinspection HtmlUnknownAttribute */
                                        $entry = "<p 1>";
                                        $this->paragraphOpen = true;
                                    }
                                }
                            } else {
                                $entry = null;
                            }

                            // We have found 1 [br], so normally we'd put it back
                            // But if next thing is a paragraphless tag (say, table) or end of document,
                            // We can skip the [br], since there will be a </p> anyway.
                        } elseif (in_array($this->getTag($shift), $this->paragraphlessTags)) {

                            $entry = null;
                        }
                        array_unshift($this->parseArray, $shift);
                    }

                    // Add paragraphs if necessary
                    if ($this->paragraphMode && !$this->paragraphOpen && $this->paragraphRequired && $this->level == 0) {
                        $this->paragraphOpen = true;
                    }

                    $blocks[] = new BbString($entry);
                }
            }
        } // End of BIG while!

        if ($this->paragraphOpen) { // No need for a level check, should be zero anyway.
            $this->paragraphOpen = false;
            $blocks[] = new BbString("</p>");
        }

        return $blocks;
    }

    /**
     * return name of a tag
     *
     * When supplied with a full tag ([b] or [img w=5 h=10]), return tag name
     * @param string $fullTag The full tag to get the tagname from
     * @return string
     */
    private function getTag($fullTag)
    {
        if (substr($fullTag, 0, 1) == '[' && substr($fullTag, strlen($fullTag) - 1, 1) == ']') {
            return strtok($fullTag, '[ =]');
        } else {
            return false;
        }
    }

    /**
     * return arguments of a tag in array-form
     *
     * When supplied with a full tag ([h=5] or [img=blah.gif w=5 h=10]), return array with argument/value as key/value pairs
     * @param string $fullTag The full tag to get the arguments from
     * @return string[]
     */
    private function getArguments(string $fullTag): array
    {
        $arguments = [];
        $tag = substr($fullTag, 1, strlen($fullTag) - 2);
        $argList = explode(' ', $tag);
        $i = 0;
        foreach ($argList as $entry) {
            $split = explode('=', $entry);
            if (count($split) >= 2) {
                $key = array_shift($split);
                $value = implode('=', $split);
            } else {
                if ($i != 0) { // Do not key = val if key = tagname. Dan gewoon geen args.
                    $key = $entry;
                    $value = $entry;
                }
            }
            if (isset($value) && isset($key)) {
                if (strstr(strtolower($value), 'javascript:')) {
                    $value = 'disabled';
                }

                $arguments[$key] = $value;
            }
        }
        return $arguments;
    }

    protected function createTagInstance(string $tag, Parser $parser, $env): BbTag
    {
        /** @var BbTag $tagInstance */
        $tagInstance = new $tag($parser, $env);
        $tagInstance->setParser($parser);
        $tagInstance->setEnv($env);

        return $tagInstance;
    }

    /**
     * @param string $entry
     * @return bool
     */
    private function isOpenTag(string $entry): bool
    {
        return substr($entry, 0, 1) == '[' && substr($entry, strlen($entry) - 1, 1) == ']'
            && substr($entry, 1, 1) != '/';
    }

}
