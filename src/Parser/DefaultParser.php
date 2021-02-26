<?php
namespace CsrDelft\BbBundle\Parser;

use CsrDelft\BbBundle\Parser\Tags\BoldParser;
use CsrDelft\BbBundle\Parser\Tags\ClearParser;
use CsrDelft\BbBundle\Parser\Tags\CodeParser;
use CsrDelft\BbBundle\Parser\Tags\CommentaarParser;
use CsrDelft\BbBundle\Parser\Tags\DivParser;
use CsrDelft\BbBundle\Parser\Tags\EmailParser;
use CsrDelft\BbBundle\Parser\Tags\HeadingParser;
use CsrDelft\BbBundle\Parser\Tags\HorizontalRuleParser;
use CsrDelft\BbBundle\Parser\Tags\ItalicParser;
use CsrDelft\BbBundle\Parser\Tags\LeetParser;
use CsrDelft\BbBundle\Parser\Tags\LishortParser;
use CsrDelft\BbBundle\Parser\Tags\ListParser;
use CsrDelft\BbBundle\Parser\Tags\ListItemParser;
use CsrDelft\BbBundle\Parser\Tags\MeParser;
use CsrDelft\BbBundle\Parser\Tags\NewlineParser;
use CsrDelft\BbBundle\Parser\Tags\NoboldParser;
use CsrDelft\BbBundle\Parser\Tags\QuoteParser;
use CsrDelft\BbBundle\Parser\Tags\StrikethroughParser;
use CsrDelft\BbBundle\Parser\Tags\SubscriptParser;
use CsrDelft\BbBundle\Parser\Tags\SuperscriptParser;
use CsrDelft\BbBundle\Parser\Tags\TableParser;
use CsrDelft\BbBundle\Parser\Tags\TableCellParser;
use CsrDelft\BbBundle\Parser\Tags\TableHeaderParser;
use CsrDelft\BbBundle\Parser\Tags\TableRowParser;
use CsrDelft\BbBundle\Parser\Tags\UnderlineParser;

/**
 * @author G.J.W. Oolbekkink <g.j.w.oolbekkink@gmail.com>
 * @since 06/07/2019
 */
final class DefaultParser extends Parser {
    protected $tags = [
        BoldParser::class,
        ClearParser::class,
        CodeParser::class,
        CommentaarParser::class,
        DivParser::class,
        EmailParser::class,
        HeadingParser::class,
        HorizontalRuleParser::class,
        ItalicParser::class,
        LeetParser::class,
        LishortParser::class,
        ListItemParser::class,
        MeParser::class,
        NewlineParser::class,
        NoboldParser::class,
        QuoteParser::class,
        StrikethroughParser::class,
        SubscriptParser::class,
        SuperscriptParser::class,
        TableParser::class,
        TableCellParser::class,
        TableHeaderParser::class,
        TableRowParser::class,
        ListParser::class,
        UnderlineParser::class,
    ];
}
