<?php

declare(strict_types=1);

namespace ApneaDev\AoC22\lib\Runner;

use ApneaDev\AoC22\lib\Collection\Collection;

interface RunnerInterface
{
    public function __construct(Collection $input);

    public function challengeA(): string;

    public function challengeB(): string;
}
