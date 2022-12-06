<?php

declare(strict_types=1);

namespace ApneaDev\AoC22\lib\Input;

use ApneaDev\AoC22\lib\Stream\StreamInterface;

interface InputInterface
{
    public function __construct(StreamInterface $input);

    public function rewind(): void;

    public function iterate($callable): void;

    public function map($callable): array;
}
