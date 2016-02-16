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
     * Get supported names
     *
     * @abstract
     *
     * @return array
     */

    abstract public function getSupportedNames();

    /**
     * Run execute
     *
     * @param array $params
     *
     * @return Apishka_Tester_Result
     */

    public function runExecute($params)
    {
        $result = $this->execute(...array_slice($params, 1));

        if ($result instanceof Apishka_Tester_Result)
            return $result;

        return Apishka_Tester_Result::apishka(
            $this->getName(),
            $result
        );
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
