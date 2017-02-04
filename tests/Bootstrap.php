<?php
/**
 * @category     Tests
 * @package      PassGen
 * @copyright    Copyright (c) 2017 Bentler Design (www.bricebentler.com)
 * @author       Brice Bentler <me@bricebentler.com>
 */

define('PROJECT_ROOT', dirname(__DIR__));

require_once PROJECT_ROOT . '/vendor/autoload.php';

set_error_handler(function($errorNumber, $errorString, $errorFile, $errorLine) {
    throw new ErrorException($errorString, 0, $errorNumber, $errorFile, $errorLine);
});

error_reporting(E_ALL);
