<?php

declare(strict_types=1);

namespace ApneaDev\AoC22\Tests;

use ApneaDev\AoC22\Day01\Runner;
use ApneaDev\AoC22\lib\Collection\Collection;
use ApneaDev\AoC22\lib\Stream\StreamFactory;
use Codeception\Test\Unit;

class Day01Test extends Unit
{
    public const INPUT = <<<EOF
    1000
    2000
    3000

    4000

    5000
    6000

    7000
    8000
    9000

    10000
    EOF;

    protected $challengeAResult = '24000';
    protected $challengeBResult = '45000';

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
