<?php

declare(strict_types=1);

namespace ApneaDev\AoC22\Day07;

use ApneaDev\AoC22\lib\Collection\Collection;

class Runner extends \ApneaDev\AoC22\lib\Runner\Runner
{
    public function challengeA(): string
    {
        $tree = $this->buildTreeFromInput();
        $list = $this->flattenTree($tree);

        return (string) $list->filter(function ($element) {
            return true === $element['isDir'] && $element['size'] <= 100000;
        })->reduce(function ($result, $element) {
            return $result += $element['size'];
        }, 0);
    }

    public function challengeB(): string
    {
        $tree = $this->buildTreeFromInput();

        $totalSpace = 70000000;
        $requiredSpace = 30000000;
        $usedSpace = $tree['size'];
        $freeSpace = $totalSpace - $usedSpace;
        $missingSpace = $requiredSpace - $freeSpace;

        $list = $this->flattenTree($tree);

        return (string) $list->filter(function ($element) use ($missingSpace) {
            return true === $element['isDir'] && $element['size'] >= $missingSpace;
        })->reduce(function ($result, $element) {
            return min($result, $element['size']);
        }, $totalSpace);
    }

    public function buildTreeFromInput()
    {
        $tree = new Collection(
            [
                'name' => '/',
                'size' => null,
                'isDir' => true,
                'parent' => null,
                'children' => new Collection(),
            ]
        );

        $current = &$tree;

        foreach ($this->input as $line) {
            $parts = explode(' ', $line);
            if ('$' === $parts['0'] && 'cd' === $parts[1]) {
                // cd root
                if ('/' === $parts[2]) {
                    $current = $tree;

                    continue;
                }

                // cd up
                if ('..' === $parts[2]) {
                    // todo: calculate size?
                    $this->calculateSize($current, false);

                    $current = &$current['parent'];

                    continue;
                }
                $current = &$current['children'][$parts[2]];

                continue;
            } elseif ('$' !== $parts[0]) {
                // dir info
                if ('dir' === $parts[0]) {
                    $current['children'][$parts[1]] = new Collection(
                        [
                            'name' => $parts[1],
                            'size' => null,
                            'isDir' => true,
                            'parent' => &$current,
                            'children' => new Collection(),
                        ]
                    );

                    continue;
                }
                // file info
                $current['children'][$parts[1]] = new Collection(
                    [
                        'name' => $parts[1],
                        'size' => (int) $parts[0],
                        'isDir' => false,
                        'parent' => &$current,
                        'children' => null,
                    ]);
            }
        }

        $this->calculateSize($tree, false);

        return $tree;
    }

    public function calculateSize(Collection &$dir, bool $force = false)
    {
        $size = 0;
        foreach ($dir['children'] as &$child) {
            if ($child['isDir']) {
                if ($force || null === $child['size']) {
                    $child = $this->calculateSize($child, $force);
                }
            }
            $size += $child['size'];
        }
        $dir['size'] = $size;

        return $dir;
    }

    public function flattenTree($tree): Collection
    {
        $list = [];
        foreach ($tree['children'] as $element) {
            if (true === $element['isDir']) {
                array_push($list, ...$this->flattenTree($element));
            }
            $list[] = $element;
        }

        return new Collection($list);
    }
}
