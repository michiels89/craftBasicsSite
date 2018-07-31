<?php
/**
 * Larapack DD plugin for Craft CMS
 */

namespace Craft;

class DdService extends BaseApplicationComponent
{
    public function d($debug = null)
    {
        return d($debug);
    }

    public function dd($debug = null)
    {
        return dd($debug);
    }
}
