<?php

declare(strict_types=1);

namespace ApneaDev\AoC22\Day03;

use ApneaDev\AoC22\lib\Collection\Collection;

class Runner extends \ApneaDev\AoC22\lib\Runner\Runner
{
    public function challengeA(): string
    {
        return (string) $this->input
          ->map(
              function ($item) {
                  $length = strlen($item);
                  $length /= 2;

                  return [substr($item, 0, $length), substr($item, $length)];
              }
          )->map(function ($item) {
              $length = strlen($item[0]);
              $map = [];

              for ($i = 0; $i < $length; ++$i) {
                  $char = $item[0][$i];
                  $map[$char] = true;
              }

              for ($i = 0; $i < $length; ++$i) {
                  $char = $item[1][$i];
                  if (array_key_exists($char, $map)) {
                      return $char;
                  }
              }

              return '';
          })
          ->reduce(function ($result, $item) {
              return $result + $this->charToPriority($item);
          }, 0);
    }

    public function challengeB(): string
    {
        return (string) $this->input
          ->chunk(3)
          ->map(function ($group) {
              return $group->map(function ($item) {
                  $map = new Collection();
                  $length = strlen($item);
                  for ($i = 0; $i < $length; ++$i) {
                      $map[$item[$i]] = true;
                  }

                  return $map;
              })->reduce(function ($result, $item) {
                  if (null === $result) {
                      return $item;
                  }

                  return $result->intersectByKeys($item->toArray());
              }, null);
          })
          ->reduce(function ($result, $item) {
              return $result + $this->charToPriority($item->keys()[0]);
          }, 0);
    }

    public function charToPriority(string $char)
    {
        $priority = ord($char);

        return $priority -= ($priority >= 96) ? 96 : 38;
    }
}
