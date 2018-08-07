<?php
$db = require __DIR__ . '/db-dev.php';
// test database! Important not to run tests on production or development databases
//$db['postgres']['dsn'] = 'mysql:host=postgres;dbname=sokolov-b2c';
//$db['mysql']['dsn'] = 'mysql:host=mysql;dbname=sokolov-b2c';

return $db;
