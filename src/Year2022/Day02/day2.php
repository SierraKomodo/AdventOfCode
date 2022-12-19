<?php

namespace SierraKomodo\AdventOfCode\Year2022\Day02;


/**
 * Possible options for rock, paper, scissors
 */
enum Options
{
    case Rock;
    case Paper;
    case Scissors;


    /**
     * Fetches an option based on an input from the strategy guide.
     *
     * @param string $input Letter provided by the strategy guide. One of: A, B, C, X, Y, Z.
     * @return Options
     */
    public static function fromGuide(string $input): Options
    {
        return match ($input) {
            'A', 'X' => Options::Rock,
            'B', 'Y' => Options::Paper,
            'C', 'Z' => Options::Scissors,
        };
    }


    /**
     * @return int The score value for the given option.
     */
    public function toScore(): int
    {
        return match ($this) {
            self::Rock => 1,
            self::Paper => 2,
            self::Scissors => 3,
        };
    }


    /**
     * @return Options The option the selection beats.
     */
    public function beats(): Options
    {
        return match ($this) {
            self::Rock => Options::Scissors,
            self::Paper => Options::Rock,
            self::Scissors => Options::Paper,
        };
    }
}


enum Results
{
    case Win;
    case Loss;
    case Draw;


    /**
     * Determines the game result from the perspective of the player, given two rock paper scissors options.
     *
     * @param Options $opponent
     * @param Options $player
     * @return Results
     */
    public static function fromOptions(Options $opponent, Options $player): Results
    {
        if ($opponent == $player) {
            return Results::Draw;
        } elseif ($opponent->beats() == $player) {
            return Results::Loss;
        } else {
            return Results::Win;
        }
    }


    /**
     * @return int The score value for the game result.
     */
    public function toScore(): int
    {
        return match($this) {
            self::Win => 6,
            self::Loss => 0,
            self::Draw => 3,
        };
    }
}


function rockPaperScissors(string $inputData): int
{
    /** @var int $totalScore The player's total score. */
    $totalScore = 0;
    $rows = explode("\r\n", trim($inputData));
    foreach ($rows as $index => $row) {
        /** @var string[] $columns */
        $columns = explode(' ', $row);
        $opponent = Options::fromGuide($columns[0]);
        $player = Options::fromGuide($columns[1]);
        $result = Results::fromOptions($opponent, $player);
        $totalScore += $player->toScore() + $result->toScore();
    }

    return $totalScore;
}

echo rockPaperScissors(file_get_contents('input.txt'));
