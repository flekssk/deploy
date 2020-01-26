<?php

namespace App\Infrastructure\Pipeline;

class CommandCollection implements \Iterator
{
    /**
     * @var int
     */
    private $cursorPosition;
    /**
     * @var array
     */
    private $commands;

    public function __construct()
    {
        $this->commands = [];
        $this->cursorPosition = 0;
    }

    public function pushCommand(CommandInterface $command)
    {
        $this->commands[] = $command;
    }

    /**
     * Return the current element
     *
     * @link https://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     * @since 5.0.0
     */
    public function current()
    {
        return $this->commands[$this->cursorPosition];
    }

    /**
     * Move forward to next element
     *
     * @link https://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function next()
    {
        $this->cursorPosition++;
    }

    /**
     * Return the key of the current element
     *
     * @link https://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     * @since 5.0.0
     */
    public function key()
    {
        return $this->cursorPosition;
    }

    /**
     * Checks if current position is valid
     *
     * @link https://php.net/manual/en/iterator.valid.php
     * @return bool The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     * @since 5.0.0
     */
    public function valid()
    {
        return isset($this->commands[$this->cursorPosition]);
    }

    /**
     * Rewind the Iterator to the first element
     *
     * @link https://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function rewind()
    {
        $this->cursorPosition = 0;
    }
}
