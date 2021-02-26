<?php


namespace CsrDelft\BbBundle\Renderer\Html;


use CsrDelft\BbBundle\Parser\Tags\EmailParser;

class HtmlEmail implements HtmlRenderer
{
    public static function getTag()
    {
        return EmailParser::class;
    }

    public function render($content, $arguments)
    {
        if (!empty($arguments['email'])) {
            $html = '<a class="bb-tag-email" href="mailto:' . $arguments['email'] . '">' . $arguments['text'] . '</a>';

            //spamprotectie: rot13 de email-tags, en voeg javascript toe om dat weer terug te rot13-en.
            if ($arguments['spamsafe']) {
                $html = '<script>document.write("' . str_rot13(addslashes($html)) . '".replace(/[a-zA-Z]/g, function(c){ return String.fromCharCode((c<="Z"?90:122)>=(c=c.charCodeAt(0)+13)?c:c-26);}));</script>';
            }
        } else {
            $html = '[email] Ongeldig e-mailadres (' . htmlspecialchars($arguments['mailto']) . ')';
        }
        return $html;
    }
}