<?php declare(strict_types = 1);

namespace Apishka\Tester;

use Apishka\EasyExtend\Router\ByKeyAbstract;

/**
 * Apishka tester router
 */
class Router extends ByKeyAbstract
{
    /**
     * Checks item for correct information
     *
     * @param \ReflectionClass $reflector
     *
     * @return bool
     */
    protected function isCorrectItem(\ReflectionClass $reflector): bool
    {
        return $reflector->isSubclassOf(TestAbstract::class);
    }

    /**
     * Get class variants
     *
     * @param \ReflectionClass $reflector
     * @param object           $item
     *
     * @return array
     */
    protected function getClassVariants(\ReflectionClass $reflector, $item): array
    {
        /** @var $item TestAbstract */
        return $item->getSupportedNames();
    }
}
