<?php

/**
 * Apishka tester test PHP extension
 *
 * @uses Apishka_Tester_TestAbstract
 *
 * @author Evgeny Reykh <evgeny@reykh.com>
 */

class Apishka_Tester_Test_Php_Extension extends Apishka_Tester_TestAbstract
{
    /**
     * Get supported names
     *
     * @return array
     */

    public function getSupportedNames()
    {
        return array(
            'PHP/Extension',
        );
    }

    /**
     * Execute
     *
     * @param ... $params
     *
     * @return mixed
     */

    protected function execute(... $params)
    {
        $extension = $params[0];

        return $this->runTest(
            $this->getName() . ' ' . $extension,
            function () use ($extension)
            {
                if (!extension_loaded($extension))
                    throw Apishka_Tester_Exception::apishka('Extention ' . var_export($extension, true) . ' not loaded.');
            }
        );
    }
}
