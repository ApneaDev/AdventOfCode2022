<?php

declare(strict_types=1);

namespace ApneaDev\AoC22\Day02;

class Runner extends \ApneaDev\AoC22\lib\Runner\Runner
{
    public function challengeA(): string
    {
        return (string) $this->input
        ->map(
            function ($item) {
                return explode(' ', $item);
            }
        )
        ->reduce(
            function ($result, $item) {
                return $result + $this->calculateScore(...$item);
            },
            0
        );
    }

      public function challengeB(): string
      {
          return (string) $this->input
            ->map(
                function ($item) {
                    return explode(' ', $item);
                }
            )
            ->reduce(
                function ($result, $item) {
                    $opponent = $item[0];
                    // draw
                    if ('Y' === $item[1]) {
                        $me = $opponent;
                    } elseif ('X' === $item[1]) {
                        // loose
                        $me = ('A' === $opponent) ? 'C' : (('B' === $opponent) ? 'A' : 'B');
                    } else {
                        // win
                        $me = ('A' === $opponent) ? 'B' : (('B' === $opponent) ? 'C' : 'A');
                    }

                    return $result + $this->calculateScore($opponent, $me);
                },
                0
            );
      }

      public function calculateScore($opponent, $me)
      {
          $points = 0;
          switch ($me) {
              case 'A': // Rock A X
              case 'X': // Rock A X
                  $points = 1;
                  $points += ('A' === $opponent) ? 3 : (('C' === $opponent) ? 6 : 0);
                  break;
              case 'B': // Paper B Y
              case 'Y': // Paper B Y
                  $points = 2;
                  $points += ('B' === $opponent) ? 3 : (('A' === $opponent) ? 6 : 0);
                  break;
              case 'C': // Scissors C Z
              case 'Z': // Scissors C Z
                  $points = 3;
                  $points += ('C' === $opponent) ? 3 : (('B' === $opponent) ? 6 : 0);
                  break;
          }

          return $points;
      }
}
