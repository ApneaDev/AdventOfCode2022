<?php

declare(strict_types=1);

namespace ApneaDev\AoC22\lib\Runner;

use ApneaDev\AoC22\lib\Collection\Collection;

abstract class Runner implements RunnerInterface
{
    protected $input = null;

    public function __construct(Collection $input)
    {
        $this->input = $input;
    }
}
