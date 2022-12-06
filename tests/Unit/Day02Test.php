<?php

declare(strict_types=1);

namespace ApneaDev\AoC22\Tests;

use ApneaDev\AoC22\Day02\Runner;
use ApneaDev\AoC22\lib\Collection\Collection;
use ApneaDev\AoC22\lib\Stream\StreamFactory;
use Codeception\Test\Unit;

class Day02Test extends Unit
{
    public const INPUT = <<<EOF
    A Y
    B X
    C Z
    EOF;

    protected $challengeAResult = '15';
    protected $challengeBResult = '12';

    public function testChallengeA()
    {
        $input = Collection::createFromStream((new StreamFactory())->createStream(self::INPUT));
        $runner = new Runner($input);
        $this->assertEquals($this->challengeAResult, $runner->challengeA());
    }

    public function testChallengeB()
    {
        $input = Collection::createFromStream((new StreamFactory())->createStream(self::INPUT));
        $runner = new Runner($input);
        $this->assertEquals($this->challengeBResult, $runner->challengeB());
    }
}
