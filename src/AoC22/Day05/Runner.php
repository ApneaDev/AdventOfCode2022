<?php

declare(strict_types=1);

namespace ApneaDev\AoC22\Day05;

use ApneaDev\AoC22\lib\Collection\Collection;

class Runner extends \ApneaDev\AoC22\lib\Runner\Runner
{
    protected $stack;

    public function challengeA(): string
    {
        $this->stack = $this->createStacksFromInput();

        $this->runCode(
            function ($count, $from, $to) {
                $crane = $this->liftCrates($from, $count);
                $this->dropCrates($to, $crane);
            }
        );

        return $this->formatResult();
    }

    public function challengeB(): string
    {
        $this->stack = $this->createStacksFromInput();
        $this->runCode(
            function ($count, $from, $to) {
                $crane = $this->liftCrates($from, $count);
                $crane = array_reverse($crane);
                $this->dropCrates($to, $crane);
            }
        );

        return $this->formatResult();
    }

    public function createStacksFromInput()
    {
        $stacks = [];

        $this->input->each(function ($item) use (&$stacks) {
            if ('1' === $item[1]) {
                return false;
            }
            $stackCount = strlen($item) / 4;
            for ($i = 0; $i < $stackCount; ++$i) {
                $crate = trim($item[$i * 4 + 1]);
                if ('' != $crate) {
                    if (!array_key_exists($i + 1, $stacks)) {
                        $stacks[$i + 1] = [];
                    }
                    $stacks[$i + 1][] = $crate;
                }
            }
        });

        $lifo = new Collection();
        foreach ($stacks as $idx => $stack) {
            $lifo[$idx] = new \SplStack();
            $lifo[$idx]->setIteratorMode(\SplStack::IT_MODE_LIFO | \SplStack::IT_MODE_DELETE);
            $stack = array_reverse($stack);
            foreach ($stack as $crate) {
                $lifo[$idx]->push($crate);
            }
        }

        return $lifo;
    }

    public function liftCrates($stack, $count)
    {
        $crane = [];
        for ($i = 0; $i < $count; ++$i) {
            $crane[] = $this->stack[$stack]->pop();
        }

        return $crane;
    }

    public function dropCrates($stack, $crane)
    {
        foreach ($crane as $crate) {
            $this->stack[$stack]->push($crate);
        }
    }

    public function runCode($callable)
    {
        $this->input->each(function ($item) use ($callable) {
            if (preg_match('/move (\d+) from (\d+) to (\d+)/', $item, $matches)) {
                $callable($matches[1], $matches[2], $matches[3]);
            }
        });
    }

    public function formatResult()
    {
        $result = '';
        $stackCount = $this->stack->count();
        for ($i = 0; $i < $stackCount; ++$i) {
            $result .= $this->stack[$i + 1]->pop();
        }

        return $result;
    }
}
