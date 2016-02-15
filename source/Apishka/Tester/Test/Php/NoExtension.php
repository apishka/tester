<?php

/**
 * Apishka tester test PHP no extension
 *
 * @uses Apishka_Tester_TestAbstract
 *
 * @author Evgeny Reykh <evgeny@reykh.com>
 */

class Apishka_Tester_Test_Php_NoExtension extends Apishka_Tester_TestAbstract
{
    /**
     * Get supported names
     *
     * @return array
     */

    public function getSupportedNames()
    {
        return array(
            'PHP/NoExtension',
        );
    }

    /**
     * Execute
     *
     * @param string $extension
     *
     * @return mixed
     */

    protected function execute($extension)
    {
        return $this->runTest(
            function () use ($extension)
            {
                if (extension_loaded($extension))
                    throw Apishka_Tester_Exception::apishka('Extention ' . var_export($name, true) . ' is loaded.');
            }
        );
    }
}