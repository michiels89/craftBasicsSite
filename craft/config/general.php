<?php

/**
 * General Configuration
 *
 * All of your system's general configuration settings go in here.
 * You can see a list of the default settings in craft/app/etc/config/defaults/general.php
 */

if (!defined('PROJECTCODE')) {
    define('PROJECTCODE', strtolower('crabas'));
}

if (!defined('ENV')) {
    switch (__DIR__) {
        case '/data/sites/web/'.PROJECTCODE.'livestatikbe/subsites/'.PROJECTCODE.'.live.statik.be/public';
        case '/data/sites/web/'.PROJECTCODE.'livestatikbe/subsites/'.PROJECTCODE.'.live.statik.be/craft/config';
        case '/data/sites/web/'.PROJECTCODE.'livestatikbe/www';
            define('ENV', 'live');
            break;

        case '/data/sites/web/'.PROJECTCODE.'livestatikbe/subsites/'.PROJECTCODE.'.staging.statik.be/public';
        case '/data/sites/web/'.PROJECTCODE.'livestatikbe/subsites/'.PROJECTCODE.'.staging.statik.be/craft/config';
            define('ENV', 'staging');
            break;

        default:
            define('ENV', 'local');
            break;
    }
}

$settings = [
    'defaultCpLanguage' => 'en_be',
    'verificationCodeDuration' => 'P1W',
    'useEmailAsUsername' => true,
    'defaultWeekStartDay' => 1,
    'enableCsrfProtection' => true,
    'omitScriptNameInUrls' => true,
    'addTrailingSlashesToUrls' => false,
    'defaultSearchTermOptions' => array(
        'subLeft' => true,
        'subRight' => true,
    ),
    'environmentVariables' => [
        'basePath' => $_SERVER['DOCUMENT_ROOT'],
        'baseUrl' => strtolower((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https://' : 'http://') . $_SERVER['SERVER_NAME']),
    ],
    'siteUrl' => [
        'en_be' => strtolower((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https://' : 'http://') . $_SERVER['SERVER_NAME']),
    ],
];

switch (ENV) {
    case 'live':
        $settings['devMode'] = false;
        break;

    case 'staging':
        $settings['devMode'] = true;
        break;

    default:
        $settings['devMode'] = true;
        break;
}

return $settings;
