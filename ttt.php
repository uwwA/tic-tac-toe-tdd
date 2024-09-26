<?php
class TicTacToe
{
    private $board;
    public $size = 3;

    public function __construct()
    {
        $this->board = array_fill(0, $this->size, array_fill(0, $this->size, ''));
    }

    public function printBoard()
    {
        for ($i = 0; $i < $this->size; $i++) {
            for ($j = 0; $j < $this->size; $j++) {
                echo $this->board[$i][$j] === '' ? '-' : $this->board[$i][$j];
                if ($j < $this->size - 1) {
                    echo " | ";
                }
            }
            echo PHP_EOL;
            if ($i < $this->size - 1) {
                echo "<br>";
            }
        }
        echo PHP_EOL;
    }

    public function makeMove($row, $col, $player)
    {
        if ($this->board[$row][$col] !== '') {
            throw new InvalidArgumentException('Cell is already occupied.');
        }

        $this->board[$row][$col] = $player;
    }

    public function getBoard()
    {
        return $this->board;
    }

    public function checkBothWinners(){
        if($this->checkWinner("X")){ return "X";}
        if($this->checkWinner("O")){ return "O";}
        return false;
    }

    public function checkWinner($player)
    {
        // Check rows
        for ($i = 0; $i < $this->size; $i++) {
            if ($this->board[$i][0] === $player && 
                $this->board[$i][1] === $player && 
                $this->board[$i][2] === $player) {
                return true;
            }
        }

        // column
        for ($i = 0; $i < $this->size; $i++) {
            if ($this->board[0][$i] === $player && 
                $this->board[1][$i] === $player && 
                $this->board[2][$i] === $player) {
                return true;
            }
        }

        // diagonal
        if ($this->board[0][0] === $player && 
            $this->board[1][1] === $player && 
            $this->board[2][2] === $player) {
            return true;
        }

        if ($this->board[0][2] === $player && 
            $this->board[1][1] === $player && 
            $this->board[2][0] === $player) {
            return true;
        }

        return false;
    }

    public function isDraw()
    {
        foreach ($this->board as $row) {
            foreach ($row as $cell) {
                if ($cell === '') {
                    return false;
                }
            }
        }
        return true;
    }
}
$game = new TicTacToe();
$players = ['X', 'O']; 
for ($i = 0; $i < $game->size; $i++) {
    for ($j = 0; $j < $game->size; $j++) {
        $game->makeMove($i,$j,$players[array_rand($players)]);
        $winner = $game->checkBothWinners();
        if(!empty($winner)){
            echo "GG - $winner is the winner<br>";
            break 2;
        }
    }
}
if(empty($winner)){
    echo "GG - game ended in a draw<br>";
}
$game->printBoard();