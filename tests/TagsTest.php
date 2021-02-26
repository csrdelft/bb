<?php

namespace CsrDelft\BbBundle\Tests;

use CsrDelft\BbBundle\Parser\Parser;
use CsrDelft\BbBundle\Tests\Lib\VarDriverPlatformIndependent;
use Spatie\Snapshots\MatchesSnapshots;

final class TagsTest extends BaseTestCase
{
    use MatchesSnapshots;

    /**
     * @var \CsrDelft\BbBundle\Bb|object|null
     */
    private $converter;

    public function setUp(): void
    {
        $container = $this->createContainer();
        $this->converter = $container->get('bb.html');
    }

    public function testBold()
    {
        $this->assertBbCodeMatchSnapshot("[b][u]bold[/u][/b] not bold");
    }
    public function testClear() {
        $this->assertBbCodeMatchSnapshot("[clear] [clear=left] [clear]test[/clear]");
    }

    public function testCode() {
        $this->assertBbCodeMatchSnapshot("[code=javascript]this\n[b]is[/b]\ncode[/code]");
        $this->assertBbCodeMatchSnapshot("code: [code]hello world![/code]");
    }

    public function testCommentaar() {
        $this->assertBbCodeMatchSnapshot("[commentaar]onzichtbaar[/commentaar]");
    }

    public function testCommentaar2()
    {
        $this->assertBbCodeMatchSnapshot("[commentaar]onzichtbaar[/]zichtbaar");
    }

    public function testDiv() {
        $this->assertBbCodeMatchSnapshot("[div w=100 h=1000 class=wo style=color:blue; title=titel]dit is een [b]div[/b][rn][/div]");
        $this->assertBbCodeMatchSnapshot("[div w=100]dit is een [b]div[/b][rn][/div]");
    }

    public function testEmail() {
        $this->assertBbCodeMatchSnapshot("[email]test@test.com[/email]");
        $this->assertBbCodeMatchSnapshot("[email=test@test.com]link[/email]");
        $this->assertBbCodeMatchSnapshot("[email=test]test@test.com[/email]");
    }

    public function testHeading() {
        $this->assertBbCodeMatchSnapshot("[h][b]heading[/b][/h]");
        $this->assertBbCodeMatchSnapshot("[h]heading[/h][br]");
        $this->assertBbCodeMatchSnapshot("[h=2 id=foo]heading[/h]");
    }

    public function testBrokenCode() {
        $this->assertBbCodeMatchSnapshot("=][");
    }

    private function assertBbCodeMatchSnapshot($code) {
        $html = $this->converter->parse($code);
        $this->assertMatchesSnapshot($html, new VarDriverPlatformIndependent());
    }
}
