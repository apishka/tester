<?php declare(strict_types = 1);

namespace Apishka\Tester;

/**
 * Apishka tester test abstract
 */
abstract class TestAbstract
{
    /**
     * Debug callback
     * @var callable
     */
    private $_debug_callback = null;

    /**
     * Get supported names
     * @return array
     */
    abstract public function getSupportedNames(): array;

    /**
     * @param array ...$params
     * @return mixed
     */
    abstract protected function execute(... $params);

    /**
     * Run execute
     * @param array $params
     * @param mixed $debug_callback
     * @return Result
     */
    public function runExecute(array $params, callable $debug_callback = null)
    {
        $this->_debug_callback = $debug_callback;

        $result = $this->execute(...array_slice($params, 1));

        if ($result instanceof Result)
            return $result;

        return Result::apishka(
            $this->getName(),
            $result
        );
    }

    /**
     * @param string $text
     * @return $this
     */
    protected function debug(string $text): self
    {
        if ($this->_debug_callback !== null)
            call_user_func($this->_debug_callback, $text);

        return $this;
    }

    /**
     * Run test
     * @param string  $name
     * @param callable $callback
     * @return Result
     */
    protected function runTest($name, callable $callback): Result
    {
        try
        {
            call_user_func($callback);
        }
        catch (\Throwable $e)
        {
            return Result::apishka($name, false)->setException($e);
        }

        return Result::apishka($name);
    }

    /**
     * Get name
     * @return string
     */
    protected function getName(): string
    {
        return $this->getSupportedNames()[0];
    }
}
