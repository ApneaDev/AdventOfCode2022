<?php

declare(strict_types=1);

namespace ApneaDev\AoC22\Day01;

use ApneaDev\AoC22\lib\Collection\Collection;

class Runner extends \ApneaDev\AoC22\lib\Runner\Runner
{
    public function challengeA(): string
    {
        return (string) $this->mapInputToCollection()
                            ->rsort()[0];
    }

    public function challengeB(): string
    {
        return (string) $this->mapInputToCollection()
                            ->rsort()
                            ->slice(0, 3)
                            ->sum();
    }

    public function mapInputToCollection(): Collection
    {
        $result = new Collection();
        $result[0] = 0;
        $index = 0;
        $this->input->each(
            function ($value, $key) use (&$result, &$index) {
                if ('' == $value) {
                    ++$index;
                    $result[$index] = 0;

                    return;
                }
                $result[$index] += (int) $value;
            }
        );

        return $result;
    }
}
