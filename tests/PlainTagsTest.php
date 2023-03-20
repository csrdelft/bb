<?php


use CsrDelft\Lib\Bb\BbEnv;
use CsrDelft\Lib\Bb\DefaultParser;
use CsrDelft\Lib\Bb\Test\VarDriverPlatformIndependent;
use PHPUnit\Framework\TestCase;
use Spatie\Snapshots\MatchesSnapshots;

final class PlainTagsTest extends TestCase
{
    use MatchesSnapshots;
    protected $parser;

    public function setUp(): void
    {
        $env = new BbEnv();
        $env->mode = "plain";
        $this->parser = new DefaultParser($env);
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
        $this->assertMatchesSnapshot($this->parser->getHtml($code), new VarDriverPlatformIndependent());
    }
}
