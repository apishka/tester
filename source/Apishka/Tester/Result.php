<?php

/**
 * Apishka tester result
 *
 * @author Evgeny Reykh <evgeny@reykh.com>
 */

class Apishka_Tester_Result
{
    /**
     * Traits
     */

    use Apishka\EasyExtend\Helper\ByClassNameTrait;

    /**
     * Result
     *
     * @var bool
     */

    private $_result = null;

    /**
     * Construct
     *
     * @param string $name
     * @param mixed  $result
     */

    public function __construct($name, $result = true)
    {
        $this->_result = $result;
    }

    /**
     * Set exception
     *
     * @param Throwable $e
     *
     * @return Apishka_Tester_Result this
     */

    public function setException(Throwable $e)
    {
        throw $e;
        $this->_exception = $e;

        return $this;
    }
}
