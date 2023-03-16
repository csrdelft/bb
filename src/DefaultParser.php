<?php

namespace CsrDelft\BbParser;

use CsrDelft\BbParser\Tag\BbBold;
use CsrDelft\BbParser\Tag\BbClear;
use CsrDelft\BbParser\Tag\BbCode;
use CsrDelft\BbParser\Tag\BbCommentaar;
use CsrDelft\BbParser\Tag\BbDiv;
use CsrDelft\BbParser\Tag\BbEmail;
use CsrDelft\BbParser\Tag\BbHeading;
use CsrDelft\BbParser\Tag\BbHorizontalRule;
use CsrDelft\BbParser\Tag\BbItalic;
use CsrDelft\BbParser\Tag\BbLeet;
use CsrDelft\BbParser\Tag\BbLishort;
use CsrDelft\BbParser\Tag\BbList;
use CsrDelft\BbParser\Tag\BbListItem;
use CsrDelft\BbParser\Tag\BbMe;
use CsrDelft\BbParser\Tag\BbNewline;
use CsrDelft\BbParser\Tag\BbNobold;
use CsrDelft\BbParser\Tag\BbQuote;
use CsrDelft\BbParser\Tag\BbStrikethrough;
use CsrDelft\BbParser\Tag\BbSubscript;
use CsrDelft\BbParser\Tag\BbSuperscript;
use CsrDelft\BbParser\Tag\BbTable;
use CsrDelft\BbParser\Tag\BbTableCell;
use CsrDelft\BbParser\Tag\BbTableHeader;
use CsrDelft\BbParser\Tag\BbTableRow;
use CsrDelft\BbParser\Tag\BbUnderline;

/**
 * @author G.J.W. Oolbekkink <g.j.w.oolbekkink@gmail.com>
 * @since 06/07/2019
 */
final class DefaultParser extends Parser
{
    public function getTags()
    {
        return [
            BbBold::class,
            BbClear::class,
            BbCode::class,
            BbCommentaar::class,
            BbDiv::class,
            BbEmail::class,
            BbHeading::class,
            BbHorizontalRule::class,
            BbItalic::class,
            BbLeet::class,
            BbLishort::class,
            BbListItem::class,
            BbMe::class,
            BbNewline::class,
            BbNobold::class,
            BbQuote::class,
            BbStrikethrough::class,
            BbSubscript::class,
            BbSuperscript::class,
            BbTable::class,
            BbTableCell::class,
            BbTableHeader::class,
            BbTableRow::class,
            BbList::class,
            BbUnderline::class,
        ];
    }
}
