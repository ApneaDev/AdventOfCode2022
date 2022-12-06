<?php

declare(strict_types=1);

namespace ApneaDev\AoC22\Tests;

use ApneaDev\AoC22\Day06\Runner;
use ApneaDev\AoC22\lib\Collection\Collection;
use ApneaDev\AoC22\lib\Stream\StreamFactory;
use Codeception\Test\Unit;

class Day06Test extends Unit
{
    public const INPUT = null;
    protected $challengeAResult = '';
    protected $challengeBResult = '';

    public function challengeAProvider(): array
    {
        return [
        ['bvwbjplbgvbhsrlpgdmjqwftvncz', '5'],
        ['nppdvjthqldpwncqszvftbrmjlhg', '6'],
        ['nznrnfrfntjfmvfwmzdfjlvtqnbhcprsg', '10'],
        ['zcfzfwzzqfrljwzlrfnpqdbhtmscgvjw', '11'],
        ];
    }

    /**
     * @dataProvider challengeAProvider
     *
     * @param string $input
     * @param array  $expected
     */
    public function testChallengeA($input, $expected)
    {
        $input = Collection::createFromStream((new StreamFactory())->createStream($input));
        $runner = new Runner($input);
        $this->assertEquals($expected, $runner->challengeA());
    }

    public function challengeBProvider(): array
    {
        return [
        ['mjqjpqmgbljsphdztnvjfqwrcgsmlb', '19'],
        ['bvwbjplbgvbhsrlpgdmjqwftvncz', '23'],
        ['nppdvjthqldpwncqszvftbrmjlhg:', '23'],
        ['nznrnfrfntjfmvfwmzdfjlvtqnbhcprsg', '29'],
        ['zcfzfwzzqfrljwzlrfnpqdbhtmscgvjw', '26'],
        ];
    }

    /**
     * @dataProvider challengeBProvider
     *
     * @param string $input
     * @param array  $expected
     */
    public function testChallengeB($input, $expected)
    {
        $input = Collection::createFromStream((new StreamFactory())->createStream($input));
        $runner = new Runner($input);
        $this->assertEquals($expected, $runner->challengeB());
    }
}
