<?php

namespace CsrDelft\Lib\Bb\Tag;

use CsrDelft\Lib\Bb\BbTag;

/**
 * Code
 *
 * @param optional String $arguments['code'] Description of code type
 *
 * @since 27/03/2019
 * @author G.J.W. Oolbekkink <g.j.w.oolbekkink@gmail.com>
 * @example [code=PHP]phpinfo();[/code]
 */
class BbCode extends BbTag
{

    /**
     * @var string
     */
    private $code;

    public static function getTagName(): string
    {
        return 'code';
    }

    public function parse($arguments = []): void
    {
        $this->readContent(['br'], false);
        $this->code = isset($arguments['code']) ? $arguments['code'] . ' ' : '';
    }

    public function renderPlain(): string
    {
        return "$this->code\n\t" . str_replace("\n", "\n\t", $this->getContent());
    }

    public function render(): string
    {
        return vsprintf(
            "<div class=\"bb-tag-code\"><sub>%scode:</sub><pre class=\"bbcode\">%s</pre></div>",
            [
                $this->code,
                $this->getContent()
            ]
        );
    }
}
