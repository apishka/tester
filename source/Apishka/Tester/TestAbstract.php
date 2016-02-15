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
     * Traits
     */

    use Apishka\EasyExtend\Helper\ByClassNameTrait;

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
     * @param ... $params
     *
     * @return Apishka_Tester_Result
     */

    public function runExecute(...$params)
    {
        return Apishka_Tester_Result::apishka($this->execute(...$params));
    }

    /**
     * Run test
     *
     * @param Closure $callback
     *
     * @return Apishka_Tester_Result
     */

    protected function runTest($callback)
    {
        try
        {
            call_user_func($callback);
        }
        catch (Throwable $e)
        {
            return Apishka_Tester_Result::apishka(false)->setException($e);
        }

        return Apishka_Tester_Result::apishka();
    }
}
