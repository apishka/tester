<?php declare(strict_types = 1);

namespace Apishka\Tester\Test\Php;

use Apishka\Tester\Result;
use Apishka\Tester\TestAbstract;
use Apishka\Tester\Exception;

/**
 * Apishka tester test PHP version
 */
class Version extends TestAbstract
{
    /**
     * {@inheritdoc}
     */
    public function getSupportedNames(): array
    {
        return array(
            'PHP/Version',
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(... $params): Result
    {
        $this->debug('> Running tests for PHP version');

        $version = $params[0];

        return $this->runTest(
            $this->getName() . ' >= ' . $version,
            function () use ($version)
            {
                $current_version = phpversion();

                $this->debug(' > Current version ' . var_export($current_version, true));
                $this->debug(' > Required version ' . var_export($version, true));

                if (!version_compare($current_version, $version, '>='))
                    throw Exception::apishka('Version ' . var_export($current_version, true) . ' is not supported. Necessary version ' . var_export($version, true) . '.');
            }
        );
    }
}
