<?php

use Kraska\OffBalance\Kernel;
use Symfony\Component\Dotenv\Dotenv;

$autoload = dirname(__DIR__).'/vendor/autoload_runtime.php';

if (!file_exists($autoload)) {
    $autoload = dirname(__DIR__).'/httpd.private/vendor/autoload_runtime.php';
    (new Dotenv())->bootEnv(dirname(__DIR__).'/httpd.private/.env');
}

require_once $autoload;

return function (array $context) {
    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};
