<?php
// app/tests.bootstrap.php
$dirBin = __DIR__ . '/../bin';
$env = 'test';
//warmup cache
passthru(sprintf(
    'php "%s/console" cache:clear --env=%s --no-warmup',
    $dirBin,
    $env
));
//create database
passthru(sprintf(
    'php "%s/console" doctrine:database:create --env=%s',
    $dirBin,
    $env
));
//update database
passthru(sprintf(
    'php "%s/console" doctrine:schema:update --force --env=%s',
    $dirBin,
    $env
));
//load fixtures
passthru(sprintf(
    'php "%s/console" fixtures:load --no-interaction --env=%s',
    $dirBin,
    $env
));

require __DIR__.'/autoload.php';
