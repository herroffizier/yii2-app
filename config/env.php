<?php
// @codingStandardsIgnoreFile

if (defined('ENV')) {
    $env = ENV;
} elseif (file_exists(__DIR__.'/current_env')) {
    $env = file_get_contents(__DIR__.'/current_env');
} else {
    $env = 'vagrant';
}

if (!defined('ENV')) {
    define('ENV', $env);
}

$envFile = __DIR__.'/env/'.$env.'.php';
if (!file_exists($envFile)) {
    echo 'No file for current env ('.htmlspecialchars($env).')';
    die(1);
}

$revFile = __DIR__.'/revision';
if (file_exists($revFile)) {
    define('REVISION', file_get_contents($revFile));
} else {
    define('REVISION', null);
}

require_once $envFile;
unset($envFile);
