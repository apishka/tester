<?php declare(strict_types = 1);

namespace Apishka\Tester\Test\Php;

use Apishka\Tester\Result;
use Apishka\Tester\TestAbstract;
use Apishka\Tester\Exception;

/**
 * Apishka tester test PHP extension
 */
class Extension extends TestAbstract
{
    /**
     * {@inheritdoc}
     */
    public function getSupportedNames(): array
    {
        return array(
            'PHP/Extension',
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(... $params): Result
    {
        $this->debug('> Running tests for PHP Extension');

        $extension = $params[0];

        return $this->runTest(
            $this->getName() . ' ' . $extension,
            function () use ($extension)
            {
                $this->debug(' > Check extension ' . var_export($extension, true));

                if (!extension_loaded($extension))
                    throw Exception::apishka('Extension ' . var_export($extension, true) . ' not loaded.');
            }
        );
    }
}
