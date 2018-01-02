<?php declare(strict_types = 1);

namespace Apishka\Tester;

/**
 * Apishka tester result
 *
 * @method static Result apishka(string $name, $result = true)
 */
class Result
{
    /**
     * Traits
     */
    use \Apishka\EasyExtend\Helper\ByClassNameTrait;

    /**
     * Exception
     *
     * @var \Throwable
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
     * @var mixed
     */
    private $_result = null;

    /**
     * Construct
     *
     * @param string $name
     * @param mixed  $result
     */
    public function __construct(string $name, $result = true)
    {
        $this->_name   = $name;
        $this->_result = $result;
    }

    /**
     * Set exception
     *
     * @param \Throwable $e
     *
     * @return Result this
     */
    public function setException(\Throwable $e)
    {
        $this->_exception = $e;

        return $this;
    }

    /**
     * Is success
     *
     * @return mixed
     */
    public function isSuccess()
    {
        if (is_bool($this->_result))
            return $this->_result;

        if (is_array($this->_result))
        {
            foreach ($this->_result as $key => $result)
            {
                if (!($result instanceof self))
                    throw new \Exception();

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
    public function getDataInternal(): array
    {
        if (is_array($this->_result))
        {
            $result = array(
                'name'      => $this->_name,
                'success'   => $this->isSuccess(),
            );

            if ($this->_exception)
                $result['error'] = $this->_exception->getMessage();

            foreach ($this->_result as $key => $test)
                $result['subtests'][$key] = $test->getDataInternal();
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

    /**
     * Get data
     *
     * @return array
     */
    public function getData(): array
    {
        return array(
            $this->getDataInternal(),
        );
    }

    /**
     * Clean data
     *
     * @param array $data
     *
     * @return array
     */
    public function cleanData($data): array
    {
        $result = array();
        foreach ($data as $key => $test)
        {
            $result[$key] = $test;
            if ($test['success'])
                unset($result[$key]['subtests']);

            if (array_key_exists('subtests', $result[$key]))
                $result[$key]['subtests'] = $this->cleanData($result[$key]['subtests']);
        }

        return $result;
    }
}
