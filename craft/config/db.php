<?php

/**
 * Database Configuration
 *
 * All of your system's database configuration settings go in here.
 * You can see a list of the default settings in craft/app/etc/config/defaults/db.php
 */

$database = [
    'tablePrefix' => 'craft',
];

switch (ENV) {
    case 'live':
        $database['server'] = 'ID142026_crabasp.db.webhosting.be';
        $database['user'] = 'ID142026_crabasp';
        $database['password'] = '6GVKUh!7JEmR9y';
        $database['database'] = 'ID142026_crabasp';
        break;

    case 'staging':
        $database['server'] = 'ID142026_crabass.db.webhosting.be';
        $database['user'] = 'ID142026_crabass';
        $database['password'] = '6GVKUh!7JEmR9y';
        $database['database'] = 'ID142026_crabass';
        break;

    default:
        $database['server'] = '127.0.0.1';
        $database['user'] = 'root';
        $database['password'] = 'root';
        $database['database'] = PROJECTCODE;
        break;
}

return $database;
