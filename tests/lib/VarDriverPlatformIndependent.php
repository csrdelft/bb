<?php


namespace CsrDelft\bb\test;


use PHPUnit\Framework\Assert;
use Spatie\Snapshots\Drivers\VarDriver;

class VarDriverPlatformIndependent extends VarDriver {
    public function match($expected, $actual) {
        $evaluated = eval(substr($expected, strlen('<?php ')));

        Assert::assertEquals(str_replace("\r\n", "\n", $evaluated), str_replace("\r\n", "\n", $actual));
    }
}
