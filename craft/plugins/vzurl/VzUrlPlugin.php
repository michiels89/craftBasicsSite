<?php
namespace Craft;

/**
 * VZ URL plugin
 */
class VzUrlPlugin extends BasePlugin
{
    public function getName()
    {
        return 'VZ URL';
    }

    public function getVersion()
    {
        return '1.1.1';
    }

    public function getSchemaVersion()
    {
        return '1.2';
    }

    public function getDeveloper()
    {
        return 'Eli Van Zoeren';
    }

    public function getDeveloperUrl()
    {
        return 'http://elivz.com';
    }

    public function getDocumentationUrl()
    {
        return 'https://github.com/elivz/VzUrl-Craft/blob/master/README.md';
    }

    public function getReleaseFeedUrl()
    {
        return 'https://raw.githubusercontent.com/elivz/VzUrl-Craft/master/changelog.json';
    }
}
