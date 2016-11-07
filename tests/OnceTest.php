<?php
namespace Thunder\Once\Tests;

final class OnceTest extends \PHPUnit_Framework_TestCase
{
    public function testOnceClosure()
    {
        $range = range('A', 'Z');
        $callable = function() use($range) {
            return $range[array_rand($range)];
        };
        $result = once($callable);
        for($i = 0; $i < 10; $i++) {
            $this->assertSame($result, once($callable));
        }
    }

    public function testOnceClass()
    {
        $callable = new class($range) {
            public function getCharacter() {
                $range = range('A', 'Z');

                return $range[array_rand($range)];
            }
        };
        $result = once([$callable, 'getCharacter']);
        for($i = 0; $i < 10; $i++) {
            $this->assertSame($result, once([$callable, 'getCharacter']));
        }
    }

    public function testGlobalClosure()
    {
        ob_start();
        $result = json_decode(shell_exec('php '.__DIR__.'/globalClosureTest.php'), true);
        ob_get_clean();

        $this->assertCount(3, $result);
        $this->assertSame(array_pad([], count($result), $result[0]), $result);
    }

    public function testGlobalClass()
    {
        ob_start();
        $result = json_decode(shell_exec('php '.__DIR__.'/globalClassTest.php'), true);
        ob_get_clean();

        $this->assertCount(3, $result);
        $this->assertSame(array_pad([], count($result), $result[0]), $result);
    }
}
