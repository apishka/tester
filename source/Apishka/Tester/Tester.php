<?php

/**
 * Apishka tester tester
 *
 * @author Evgeny Reykh <evgeny@reykh.com>
 */

class Apishka_Tester_Tester
{
    /**
     * Traits
     */

    use Apishka\EasyExtend\Helper\ByClassNameTrait;

    /**
     * Execute
     *
     * @return mixed
     */

    public function execute()
    {
        $router = Apishka_Tester_Router::apishka();
        $result = array();
        foreach ($this->getTestsConfig() as $package => $config)
        {
            $subresult = array();
            foreach ($config['tests'] as $test)
                $subresult[] = $router->getItem($test[0])->runExecute($test);

            $result[] = Apishka_Tester_Result::apishka('Package ' . $package, $subresult);
        }

        return Apishka_Tester_Result::apishka('Environment', $result);
    }

    /**
     * Get tests config
     *
     * @return array
     */

    protected function getTestsConfig()
    {
        $builder = new Apishka\EasyExtend\Builder();
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
     *
     * @param string $file
     *
     * @return array
     */

    protected function readConfig($file)
    {
        return include($file);
    }
}
