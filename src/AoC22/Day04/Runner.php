<?php

declare(strict_types=1);

namespace ApneaDev\AoC22\Day04;

use ApneaDev\AoC22\lib\Collection\Collection;

class Runner extends \ApneaDev\AoC22\lib\Runner\Runner
{
    public function challengeA(): string
    {
        return (string) $this->input
          ->map([$this, 'mapInput'])
          ->reduce(function ($result, $item) {
              return $result + (
                  (($item[0][0] <= $item[1][0] && $item[0][1] >= $item[1][1])
                    || ($item[0][0] >= $item[1][0] && $item[0][1] <= $item[1][1]))
                  ? 1
                  : 0
              );
          }, 0);
    }

    public function challengeB(): string
    {
        return (string) $this->input
          ->map([$this, 'mapInput'])
          ->reduce(function ($result, $item) {
              return $result + (
                  ($item[0][0] <= $item[1][0] && $item[0][1] >= $item[1][0])
          || ($item[1][0] <= $item[0][0] && $item[1][1] >= $item[0][0])
                  ? 1
                  : 0
              );
          }, 0);
    }

    public function mapInput($item)
    {
        $matches = [];
        preg_match('/(\d+)\-(\d+),(\d+)\-(\d+)/', $item, $matches);

        return new Collection([
          new Collection([$matches[1], $matches[2]]),
          new Collection([$matches[3], $matches[4]]),
        ]);
    }
}
