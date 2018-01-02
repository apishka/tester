<?php declare(strict_types = 1);

namespace Apishka\Tester;

/**
 * Apishka tester exception
 * @method static Exception apishka(string $message = "", int $code = 0, \Throwable $previous = null)
 */
class Exception extends \Exception
{
    /**
     * Traits
     */
    use \Apishka\EasyExtend\Helper\ByClassNameTrait;
}
