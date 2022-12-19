<?php

namespace SierraKomodo\AdventOfCode\Year2022\Day01;


/**
 * @param string $inputData AoC input data.
 * @return int The amount of calories carried by the elf who has the most calories.
 */
function calorieCounting(string $inputData): int
{
    /** @var string[] $inputElves Blocks of calories carried by each elf, split from double line breaks. */
    $inputElves = explode("\r\n\r\n", $inputData);

    /** @var int[] $outputElves Output array of total calories carried by each elf. */
    $outputElves = [];

    /**
     * @var int $index
     * @var string $inputElf A single block of calories representing one elf's carried food.
     */
    foreach ($inputElves as $index => $inputElf) {
        // Split each elf's block of calories by single line breaks, then sum all the values together.
        $outputElves[$index] = array_sum(explode("\r\n", $inputElf));
    }

    // Sort the list of total calories in descending order.
    rsort($outputElves);

    // Return the highest value in the list of total calories, which should be the first entry after sorting.
    return $outputElves[0];
}

echo calorieCounting(file_get_contents('input.txt'));
