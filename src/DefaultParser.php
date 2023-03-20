<?php

namespace CsrDelft\Lib\Bb;

use CsrDelft\Lib\Bb\Tag\BbBold;
use CsrDelft\Lib\Bb\Tag\BbClear;
use CsrDelft\Lib\Bb\Tag\BbCode;
use CsrDelft\Lib\Bb\Tag\BbCommentaar;
use CsrDelft\Lib\Bb\Tag\BbDiv;
use CsrDelft\Lib\Bb\Tag\BbEmail;
use CsrDelft\Lib\Bb\Tag\BbHeading;
use CsrDelft\Lib\Bb\Tag\BbHorizontalRule;
use CsrDelft\Lib\Bb\Tag\BbItalic;
use CsrDelft\Lib\Bb\Tag\BbLeet;
use CsrDelft\Lib\Bb\Tag\BbLishort;
use CsrDelft\Lib\Bb\Tag\BbList;
use CsrDelft\Lib\Bb\Tag\BbListItem;
use CsrDelft\Lib\Bb\Tag\BbMe;
use CsrDelft\Lib\Bb\Tag\BbNewline;
use CsrDelft\Lib\Bb\Tag\BbNobold;
use CsrDelft\Lib\Bb\Tag\BbNode;
use CsrDelft\Lib\Bb\Tag\BbQuote;
use CsrDelft\Lib\Bb\Tag\BbStrikethrough;
use CsrDelft\Lib\Bb\Tag\BbSubscript;
use CsrDelft\Lib\Bb\Tag\BbSuperscript;
use CsrDelft\Lib\Bb\Tag\BbTable;
use CsrDelft\Lib\Bb\Tag\BbTableCell;
use CsrDelft\Lib\Bb\Tag\BbTableHeader;
use CsrDelft\Lib\Bb\Tag\BbTableRow;
use CsrDelft\Lib\Bb\Tag\BbUnderline;

/**
 * @author G.J.W. Oolbekkink <g.j.w.oolbekkink@gmail.com>
 * @since 06/07/2019
 */
final class DefaultParser extends Parser
{
    /**
     * @return BbNode[]
     */
    public function getTags(): array
    {
        return [
            new BbBold(),
            new BbClear(),
            new BbCode(),
            new BbCommentaar(),
            new BbDiv(),
            new BbEmail(),
            new BbHeading(),
            new BbHorizontalRule(),
            new BbItalic(),
            new BbLeet(),
            new BbLishort(),
            new BbListItem(),
            new BbMe(),
            new BbNewline(),
            new BbNobold(),
            new BbQuote(),
            new BbStrikethrough(),
            new BbSubscript(),
            new BbSuperscript(),
            new BbTable(),
            new BbTableCell(),
            new BbTableHeader(),
            new BbTableRow(),
            new BbList(),
            new BbUnderline(),
        ];
    }
}
