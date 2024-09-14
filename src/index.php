<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Application\Test;

$test = new Test();

var_dump($test->execute());