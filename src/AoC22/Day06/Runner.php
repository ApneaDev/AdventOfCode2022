<?php

declare(strict_types=1);

namespace ApneaDev\AoC22\Day06;

use ApneaDev\AoC22\lib\Collection\Collection;

class Runner extends \ApneaDev\AoC22\lib\Runner\Runner
{
    public function __construct(Collection $input)
    {
        $this->input = (string) $input[0];
    }

    public function challengeA(): string
    {
        return (string) $this->findMarker($this->input, 4);
    }

    public function challengeB(): string
    {
        return (string) $this->findMarker($this->input, 14);
    }

    public function findMarker(string $input, int $windowSize)
    {
        $pointer = 0;
        $inputLength = strlen($input);
        while ($pointer <= $inputLength) {
            $window = substr($input, $pointer, $windowSize);
            $doublePos = $this->checkWindow($window);
            if (null === $doublePos) {
                return $pointer + $windowSize;
            }
            $pointer += $doublePos + 1;
        }

        return null;
    }

    public function checkWindow(string $window)
    {
        $map = [];
        $windowSize = strlen($window);
        for ($i = 0; $i < $windowSize; ++$i) {
            $char = $window[$i];
            if (array_key_exists($char, $map)) {
                return $map[$char];
            }
            $map[$char] = $i;
        }

        return null;
    }
}
