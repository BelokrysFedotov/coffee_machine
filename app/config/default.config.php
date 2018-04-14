<?php

$app['debug'] = true;


// Twig
$app['twig.path'] = array(__DIR__ . '/../templates');
//$app['twig.options'] = array('cache' => __DIR__ . '/../tmp/cache/twig');
$app['twig.options'] = array('cache' => '/tmp/cache/twig');