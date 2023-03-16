<?php

namespace CsrDelft\BbParser\Tag;

use CsrDelft\BbParser\BbTag;

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
class BbEmail extends BbTag
{

    private $text;
    private $email;
    private $mailto;

    public static function getTagName(): string
    {
        return 'email';
    }

    public function render($arguments = []): string
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

    public function renderPlain(): string
    {
        return $this->text . " <" . $this->email . ">";
    }

    /**
     * @source http://www.regular-expressions.info/email.html
     * @param $email
     *
     * @return bool
     */
    private function emailLike($email): bool
    {
        if (empty($email)) {
            return false;
        }
        return preg_match("/^[a-zA-Z0-9!#$%&'\*\+=\?^_`{|}~-]+(?:\.[a-zA-Z0-9!#$%&'\*\+=\?^_`{|}~-]+)*@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+(?:[a-zA-Z]{2,})\b$/", $email);
    }

    /**
     * @param array $arguments
     * @return array
     */
    public function parse($arguments = []): void
    {
        $this->mailto = array_shift($this->parser->parseArray);
        $endtag = array_shift($this->parser->parseArray);

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
            if (isset($arguments['email'])) {
                if ($this->emailLike($arguments['email'])) {
                    $this->email = $this->text = $arguments['email'];
                }
            }
            array_unshift($this->parser->parseArray, $endtag);
            array_unshift($this->parser->parseArray, $this->mailto);
        }
    }
}
