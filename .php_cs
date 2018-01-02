<?php

$finder = PhpCsFixer\Finder::create()
    ->in('source/')
;

return include('vendor/apishka/cs/.php_cs');