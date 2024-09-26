<?php
use PHPUnit\Framework\TestCase;
require_once("ttt.php");
class ttt_test extends TestCase
{
    public function testPlayerCanMakeMove()
    {
        $game = new TicTacToe();
        $game->makeMove(0, 0, 'X');
        $this->assertEquals('X', $game->getBoard()[0][0]);
    }

    public function testPlayerCannotOverrideMove()
    {
        $game = new TicTacToe();
        $game->makeMove(0, 0, 'X');
        $this->expectException(InvalidArgumentException::class);
        $game->makeMove(0, 0, 'O');
    }

    public function testWinConditionRow()
    {
        $game = new TicTacToe();
        $game->makeMove(0, 0, 'X');
        $game->makeMove(0, 1, 'X');
        $game->makeMove(0, 2, 'X');
        $this->assertTrue($game->checkWinner('X'));
    }

    public function testWinConditionCol()
    {
        $game = new TicTacToe();
        $game->makeMove(0, 0, 'X');
        $game->makeMove(1, 0, 'X');
        $game->makeMove(2, 0, 'X');
        $this->assertTrue($game->checkWinner('X'));
    }

    public function testWinConditionDiag()
    {
        $game = new TicTacToe();
        $game->makeMove(0, 0, 'X');
        $game->makeMove(1, 1, 'X');
        $game->makeMove(2, 2, 'X');
        $this->assertTrue($game->checkWinner('X'));
    }

    public function testDrawCondition()
    {
        $game = new TicTacToe();
        $game->makeMove(0, 0, 'X');
        $game->makeMove(0, 1, 'O');
        $game->makeMove(0, 2, 'X');
        $game->makeMove(1, 0, 'X');
        $game->makeMove(1, 1, 'O');
        $game->makeMove(1, 2, 'X');
        $game->makeMove(2, 0, 'O');
        $game->makeMove(2, 1, 'X');
        $game->makeMove(2, 2, 'O');
        $this->assertTrue($game->isDraw());
    }
}
