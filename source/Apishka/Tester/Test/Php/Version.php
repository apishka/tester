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
     * @param ... $params
     *
     * @return mixed
     */

    protected function execute(... $params)
    {
        $this->debug('> Running tests for PHP version');

        $version = $params[0];

        return $this->runTest(
            $this->getName() . ' ' . $version,
            function () use ($version)
            {
                $current_version = phpversion();

                $this->debug('=> Current version ' . var_export($current_version, true));
                $this->debug('=> Required verssion ' . var_export($version, true));

                if (!version_compare($current_version, $version, '>='))
                    throw Apishka_Tester_Exception::apishka('Version ' . var_export($current_version, true) . ' is not supported. Necessary version ' . var_export($version, true) . '.');
            }
        );
    }
}
