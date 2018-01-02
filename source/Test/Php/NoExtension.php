<?php declare(strict_types = 1);

namespace Apishka\Tester\Test\Php;

use Apishka\Tester\Exception;
use Apishka\Tester\Result;
use Apishka\Tester\TestAbstract;

/**
 * Apishka tester test PHP no extension
 */
class NoExtension extends TestAbstract
{
    /**
     * {@inheritdoc}
     */
    public function getSupportedNames(): array
    {
        return array(
            'PHP/NoExtension',
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(... $params): Result
    {
        $this->debug('> Running tests for no PHP Extension');

        $extension = $params[0];

        return $this->runTest(
            $this->getName() . ' ' . $extension,
            function () use ($extension)
            {
                $this->debug(' > Check extension ' . var_export($extension, true));

                if (extension_loaded($extension))
                    throw Exception::apishka('Extension ' . var_export($extension, true) . ' is loaded.');
            }
        );
    }
}
