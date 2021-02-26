<?php

namespace CsrDelft\BbBundle\Tests;

use CsrDelft\BbBundle\Parser\BbEnv;
use CsrDelft\BbBundle\Parser\Parser;
use CsrDelft\BbBundle\Tests\Lib\VarDriverPlatformIndependent;
use Spatie\Snapshots\MatchesSnapshots;

final class PlainTagsTest extends BaseTestCase
{
    use MatchesSnapshots;
    protected $parser;
    protected $renderer;

    public function setUp(): void
    {
        $env = new BbEnv();
        $env->mode = "plain";
        $container = $this->createContainer();
        $this->parser = $container->get(Parser::class);
        $this->renderer = $container->get('bb.render.plain');
    }

    public function testList() {
        $this->assertBbCodeMatchSnapshot(<<<BB
[*] Ding
[*] Ding
BB
);
    }

    public function testQuote() {
        $this->assertBbCodeMatchSnapshot("[quote]A quote by someone[/quote]");
        $this->assertBbCodeMatchSnapshot("[quote]A quote \nby someone[/quote]");
    }

    public function testStrikeThrough() {
        $this->assertBbCodeMatchSnapshot("[s]strikethrough[/s] not striketrough");
    }

    public function testBold()
    {
        $this->assertBbCodeMatchSnapshot("[b][u]bold[/u][/b] not bold");
    }

    public function testItalic() {
        $this->assertBbCodeMatchSnapshot("[i]test[/i] test");
    }

    public function testCode() {
        $this->assertBbCodeMatchSnapshot("[code=javascript]this\n[b]is[/b]\ncode[/code]");
        $this->assertBbCodeMatchSnapshot("code: [code]hello world![/code]");
    }

    public function testEmail() {
        $this->assertBbCodeMatchSnapshot("[email=test@test.com]link[/email]");
    }

    public function testHeading() {
        $this->assertBbCodeMatchSnapshot("[h]heading[/h]");
    }

    private function assertBbCodeMatchSnapshot($code) {
        $html = $this->renderer->render($this->parser->parseString($code));
        $this->assertMatchesSnapshot($html, new VarDriverPlatformIndependent());
    }
}
