<?php
/**
 * Larapack DD plugin for Craft CMS
 */

namespace Craft;

class DdPlugin extends BasePlugin
{
    public function init()
    {
        require_once __DIR__ . '/vendor/autoload.php';
    }

    public function getName()
    {
         return 'DD';
    }

    public function getDescription()
    {
        return Craft::t('DD');
    }

    public function getVersion()
    {
        return '1.0.0';
    }

    public function getSchemaVersion()
    {
        return '1.0.0';
    }

    public function getDeveloper()
    {
        return 'Statik';
    }

    public function getDeveloperUrl()
    {
        return 'https://www.statik.be';
    }

    public function getReleasesFeed()
    {
        return 'https://raw.githubusercontent.com/statikbe/craft-dd/master/releases.json';
    }


    public function addTwigExtension()
    {
        Craft::import('plugins.dd.twigextensions.DdTwigExtension');
        return new DdTwigExtension();
    }

}
