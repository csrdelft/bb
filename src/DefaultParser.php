<?php
namespace CsrDelft\bb;

use CsrDelft\bb\tag\BbBold;
use CsrDelft\bb\tag\BbClear;
use CsrDelft\bb\tag\BbCode;
use CsrDelft\bb\tag\BbCommentaar;
use CsrDelft\bb\tag\BbDiv;
use CsrDelft\bb\tag\BbEmail;
use CsrDelft\bb\tag\BbHeading;
use CsrDelft\bb\tag\BbHorizontalRule;
use CsrDelft\bb\tag\BbItalic;
use CsrDelft\bb\tag\BbLeet;
use CsrDelft\bb\tag\BbLishort;
use CsrDelft\bb\tag\BbList;
use CsrDelft\bb\tag\BbListItem;
use CsrDelft\bb\tag\BbMe;
use CsrDelft\bb\tag\BbNewline;
use CsrDelft\bb\tag\BbNobold;
use CsrDelft\bb\tag\BbQuote;
use CsrDelft\bb\tag\BbStrikethrough;
use CsrDelft\bb\tag\BbSubscript;
use CsrDelft\bb\tag\BbSuperscript;
use CsrDelft\bb\tag\BbTable;
use CsrDelft\bb\tag\BbTableCell;
use CsrDelft\bb\tag\BbTableHeader;
use CsrDelft\bb\tag\BbTableRow;
use CsrDelft\bb\tag\BbUnderline;

/**
 * @author G.J.W. Oolbekkink <g.j.w.oolbekkink@gmail.com>
 * @since 06/07/2019
 */
final class DefaultParser extends Parser {
    protected $tags = [
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
