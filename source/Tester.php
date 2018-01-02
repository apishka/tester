<?php declare(strict_types = 1);

namespace Apishka\Tester;

/**
 * Apishka tester tester
 */
class Tester
{
    /**
     * Traits
     */
    use \Apishka\EasyExtend\Helper\ByClassNameTrait;

    /**
     * @param callable $debug_callback
     * @return Result
     */
    public function execute(callable $debug_callback = null): Result
    {
        $router = Router::apishka();
        $result = array();
        foreach ($this->getTestsConfig() as $package => $config)
        {
            $subresult = array();

            $tests = $config['tests'];
            foreach ($tests as $test)
            {
                if ($debug_callback !== null)
                    $debug_callback('Running test ' . var_export($test[0], true));

                $subresult[] = $router->getItem($test[0])->runExecute($test, $debug_callback);
            }

            $result[] = Result::apishka('Package ' . $package, $subresult);
        }

        return Result::apishka('Environment', $result);
    }

    /**
     * Get tests config
     * @return array
     */
    protected function getTestsConfig(): array
    {
        $builder = new \Apishka\EasyExtend\Builder();
        $configs = $builder->getConfigFilesFromCache();

        $result = array();
        foreach ($configs as $package => $file)
        {
            $apishka = $this->readConfig($file);

            if (array_key_exists('tester', $apishka))
                $result[$package] = $apishka['tester'];
        }

        return $result;
    }

    /**
     * Read config
     * @param string $file
     * @return array
     */
    protected function readConfig(string $file): array
    {
        return include $file;
    }
}
