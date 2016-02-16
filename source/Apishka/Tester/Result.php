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
     * Exception
     *
     * @var Throwable
     */

    private $_exception = null;

    /**
     * Name
     *
     * @var string
     */

    private $_name = null;

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
        $this->_name   = $name;
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
        $this->_exception = $e;

        return $this;
    }

    /**
     * Is success
     *
     * @return void
     */

    public function isSuccess()
    {
        if (is_bool($this->_result))
            return $this->_result;

        if (is_array($this->_result))
        {
            foreach ($this->_result as $key => $result)
            {
                if (!($result instanceof Apishka_Tester_Result))
                    throw new Exception();

                if (!$result->isSuccess())
                    return false;
            }
        }

        return true;
    }

    /**
     * Get as array
     *
     * @return array
     */

    public function getData()
    {
        $result = array();

        if (is_array($this->_result))
        {
            $result = array(
                'name'      => $this->_name,
                'success'   => $this->isSuccess(),
            );

            if ($this->_exception)
                $result['error'] = $this->_exception->getMessage();

            foreach ($this->_result as $key => $test)
                $result['subtests'][$key] = $test->getData();
        }
        else
        {
            $result = array(
                'name'      => $this->_name,
                'success'   => $this->isSuccess(),
            );

            if ($this->_exception)
                $result['error'] = $this->_exception->getMessage();
        }

        return $result;
    }
}
