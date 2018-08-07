<?php

return [
    'postgres' => [
        'class' => 'yii\db\Connection',
        'dsn' => 'pgsql:host=postgres;port=5432;dbname=sokolov-b2c',
        'username' => 'developer',
        'password' => 'developer',
        'charset' => 'utf8',
        'schemaMap' => [
            'pgsql'=> [
                'class'=>'yii\db\pgsql\Schema',
                'defaultSchema' => 'my' //specify your schema here
            ]
        ]
    ],
    'mysql' => [
        'class' => 'yii\db\Connection',
        'dsn' => 'mysql:host=mariadb;port=3306;dbname=sokolov-b2c',
        'username' => 'developer',
        'password' => 'developer',
        'charset' => 'utf8',

        // Schema cache options (for production environment)
        //'enableSchemaCache' => true,
        //'schemaCacheDuration' => 60,
        //'schemaCache' => 'cache',
    ],
];
