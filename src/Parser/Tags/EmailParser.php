<?php

namespace CsrDelft\BbBundle\Parser\Tags;

use CsrDelft\BbBundle\Parser\BbTag;
use CsrDelft\BbBundle\Parser\Parser;
use CsrDelft\BbBundle\Parser\TagParser;

/**
 * Email anchor
 *
 * @param String $arguments ['email'] Email address to link to
 * @param boolean optional $arguments['spamsafe'] Uses spam safe javascript obfuscator
 *
 * @author G.J.W. Oolbekkink <g.j.w.oolbekkink@gmail.com>
 * @since 27/03/2019
 * @example [email]noreply@csrdelft.nl[/email]
 * @example [email=noreply@csrdelft.nl spamsafe]text[/email]
 */
class EmailParser extends TagParser
{

    private $text;
    private $email;
    private $mailto;

    public static function getTagName()
    {
        return 'email';
    }

    public function render($arguments = [])
    {
        if (!empty($this->email)) {
            $html = '<a class="bb-tag-email" href="mailto:' . $this->email . '">' . $this->text . '</a>';

            //spamprotectie: rot13 de email-tags, en voeg javascript toe om dat weer terug te rot13-en.
            if (isset($arguments['spamsafe'])) {
                $html = '<script>document.write("' . str_rot13(addslashes($html)) . '".replace(/[a-zA-Z]/g, function(c){ return String.fromCharCode((c<="Z"?90:122)>=(c=c.charCodeAt(0)+13)?c:c-26);}));</script>';
            }
        } else {
            $html = '[email] Ongeldig e-mailadres (' . htmlspecialchars($this->mailto) . ')';
        }
        return $html;
    }

    public function renderPlain()
    {
        return $this->text . " <" . $this->email . ">";
    }

    /**
     * @param Parser $parser
     * @param $env
     * @param array $arguments
     * @return BbTag
     */
    public function parse(Parser $parser, $env, $arguments = [])
    {
        $this->mailto = array_shift($parser->parseArray);
        $endtag = array_shift($parser->parseArray);

        $this->email = '';
        $this->text = '';

        // only valid patterns
        if ($endtag == '[/email]') {
            if (isset($arguments['email'])) {
                if ($this->emailLike($arguments['email'])) {
                    $this->email = $arguments['email'];
                    $this->text = $this->mailto;
                }
            } else {
                if ($this->emailLike($this->mailto)) {
                    $this->email = $this->text = $this->mailto;
                }
            }
        } else {
            if (isset($arguments['email']) && $this->emailLike($arguments['email'])) {
                $this->email = $this->text = $arguments['email'];
            }
            array_unshift($parser->parseArray, $endtag);
            array_unshift($parser->parseArray, $this->mailto);
        }

        return $this->createTag([], [
            'email' => $this->email,
            'text' => $this->text,
            'mailto' => $this->mailto,
            'spamsafe' => $arguments['spamsafe'] ?? false,
        ]);
    }

    /**
     * @source http://www.regular-expressions.info/email.html
     * @param $email
     *
     * @return bool
     */
    function emailLike($email)
    {
        if (empty($email)) {
            return false;
        }
        return preg_match("/^[a-zA-Z0-9!#$%&'\*\+=\?^_`{|}~-]+(?:\.[a-zA-Z0-9!#$%&'\*\+=\?^_`{|}~-]+)*@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+(?:[a-zA-Z]{2,})\b$/", $email);
    }
}
