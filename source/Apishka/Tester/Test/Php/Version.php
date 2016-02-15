<?php

/**
 * Apishka tester test PHP version
 *
 * @uses Apishka_Tester_TestAbstract
 *
 * @author Evgeny Reykh <evgeny@reykh.com>
 */

class Apishka_Tester_Test_Php_Version extends Apishka_Tester_TestAbstract
{
    /**
     * Get supported names
     *
     * @return array
     */

    public function getSupportedNames()
    {
        return array(
            'PHP/Version',
        );
    }

    /**
     * Execute
     *
     * @param string $version
     *
     * @return array
     */

    protected function execute($version)
    {
        return $this->runTest(
            function () use ($version)
            {
                if (!version_compare(phpversion(), $required_version, '>='))
                    throw Apishka_Tester_Exception::apishka('Version ' . var_export($current_version, true) . ' is not supported. Necessary version ' . var_export($required_version, true) . '.');
            }
        );
    }
}
