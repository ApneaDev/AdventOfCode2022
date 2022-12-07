<?php

declare(strict_types=1);

namespace ApneaDev\AoC22\Tests;

use ApneaDev\AoC22\Day07\Runner;
use ApneaDev\AoC22\lib\Collection\Collection;
use ApneaDev\AoC22\lib\Stream\StreamFactory;
use Codeception\Test\Unit;

class Day07Test extends Unit
{
    public const INPUT = <<<EOF
    $ ls
    dir a
    14848514 b.txt
    8504156 c.dat
    dir d
    $ cd a
    $ ls
    dir e
    29116 f
    2557 g
    62596 h.lst
    $ cd e
    $ ls
    584 i
    $ cd ..
    $ cd ..
    $ cd d
    $ ls
    4060174 j
    8033020 d.log
    5626152 d.ext
    7214296 k
    EOF;

    protected $challengeAResult = '95437';
    protected $challengeBResult = '24933642';

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
