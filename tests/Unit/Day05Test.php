<?php

declare(strict_types=1);

namespace ApneaDev\AoC22\Tests;

use ApneaDev\AoC22\Day05\Runner;
use ApneaDev\AoC22\lib\Collection\Collection;
use ApneaDev\AoC22\lib\Stream\StreamFactory;
use Codeception\Test\Unit;

class Day05Test extends Unit
{
    public const INPUT = <<<EOF
        [D]    
    [N] [C]    
    [Z] [M] [P]
     1   2   3 

     move 1 from 2 to 1
     move 3 from 1 to 3
     move 2 from 2 to 1
     move 1 from 1 to 2
    EOF;

    protected $challengeAResult = 'CMZ';
    protected $challengeBResult = 'MCD';

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
