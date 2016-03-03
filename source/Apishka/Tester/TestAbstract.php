<?php

/**
 * Apishka tester test abstract
 *
 * @abstract
 *
 * @author Evgeny Reykh <evgeny@reykh.com>
 */

abstract class Apishka_Tester_TestAbstract
{
    /**
     * Debug callback
     *
     * @var mixed
     */

    private $_debug_callback = null;

    /**
     * Get supported names
     *
     * @abstract
     *
     * @return array
     */

    abstract public function getSupportedNames();

    /**
     * Execute
     *
     * @param ... $params
     *
     * @abstract
     *
     * @return mixed
     */

    abstract protected function execute(... $params);

    /**
     * Run execute
     *
     * @param array $params
     * @param mixed $debug_callback
     *
     * @return Apishka_Tester_Result
     */

    public function runExecute($params, $debug_callback = null)
    {
        $this->_debug_callback = $debug_callback;

        $result = $this->execute(...array_slice($params, 1));

        if ($result instanceof Apishka_Tester_Result)
            return $result;

        return Apishka_Tester_Result::apishka(
            $this->getName(),
            $result
        );
    }

    /**
     * Debug
     *
     * @param string $text
     *
     * @return Apishka_Tester_TestAbstract this
     */

    protected function debug($text)
    {
        if ($this->_debug_callback !== null)
            call_user_func($this->_debug_callback, $text);

        return $this;
    }

    /**
     * Run test
     *
     * @param string  $name
     * @param Closure $callback
     *
     * @return Apishka_Tester_Result
     */

    protected function runTest($name, $callback)
    {
        try
        {
            call_user_func($callback);
        }
        catch (Throwable $e)
        {
            return Apishka_Tester_Result::apishka($name, false)->setException($e);
        }

        return Apishka_Tester_Result::apishka($name);
    }

    /**
     * Get name
     *
     * @return string
     */

    protected function getName()
    {
        return $this->getSupportedNames()[0];
    }
}
