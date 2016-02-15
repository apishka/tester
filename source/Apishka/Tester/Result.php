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
     * @param mixed $result
     */

    public function __construct($result = false)
    {
        $this->_result = $result;
    }
}
