<?php
/**
 * Freeform for Craft
 *
 * @package       Solspace:Freeform
 * @author        Solspace, Inc.
 * @copyright     Copyright (c) 2008-2018, Solspace, Inc.
 * @link          https://solspace.com/craft/freeform
 * @license       https://solspace.com/software/license-agreement
 */

namespace Craft;

use Solspace\Freeform\Library\DataObjects\FormTemplate;

class Freeform_SettingsService extends BaseApplicationComponent
{
    /** @var Freeform_SettingsModel */
    private static $settingsModel;

    /**
     * @return string|null
     */
    public function getPluginName()
    {
        return $this->getSettingsModel()->pluginName;
    }

    /**
     * @return bool
     */
    public function isSpamProtectionEnabled()
    {
        return (bool) $this->getSettingsModel()->spamProtectionEnabled;
    }

    /**
     * @return bool
     */
    public function isSpamBlockLikeSuccessfulPost()
    {
        return (bool) $this->getSettingsModel()->spamBlockLikeSuccessfulPost;
    }

    /**
     * @return string
     */
    public function getFieldDisplayOrder()
    {
        return $this->getSettingsModel()->fieldDisplayOrder;
    }

    /**
     * @return string
     */
    public function getFormTemplateDirectory()
    {
        return $this->getSettingsModel()->formTemplateDirectory;
    }

    /**
     * @return string
     */
    public function getSolspaceFormTemplateDirectory()
    {
        return CRAFT_PLUGINS_PATH . 'freeform/templates/_defaultFormTemplates';
    }

    /**
     * Mark the tutorial as finished
     */
    public function finishTutorial()
    {
        $plugin = craft()->plugins->getPlugin('freeform');
        if (craft()->plugins->savePluginSettings($plugin, ['showTutorial' => false])) {
            return true;
        }

        return false;
    }

    /**
     * @return FormTemplate[]
     */
    public function getSolspaceFormTemplates()
    {
        $templateDirectoryPath = $this->getSolspaceFormTemplateDirectory();

        $templates = [];
        foreach (IOHelper::getFiles($templateDirectoryPath) as $file) {
            if (@is_dir($file)) {
                continue;
            }

            $templates[] = new FormTemplate($file);
        }

        return $templates;
    }

    /**
     * @return FormTemplate[]
     */
    public function getCustomFormTemplates()
    {
        $templates = [];
        foreach ($this->getSettingsModel()->listTemplatesInFormTemplateDirectory() as $path => $name) {
            $templates[] = new FormTemplate($path);
        }

        return $templates;
    }

    /**
     * @return bool
     */
    public function isDbEmailTemplateStorage()
    {
        $settings = $this->getSettingsModel();

        return !$settings->emailTemplateDirectory || $settings->emailTemplateStorage == Freeform_SettingsModel::EMAIL_TEMPLATE_STORAGE_DB;
    }

    /**
     * @return bool
     */
    public function isFooterScripts()
    {
        return (bool) $this->getSettingsModel()->footerScripts;
    }

    /**
     * @return bool
     */
    public function isFormSubmitDisable()
    {
        return (bool) $this->getSettingsModel()->formSubmitDisable;
    }

    /**
     * @return bool
     */
    public function isRecaptchaEnabled()
    {
        return (bool) $this->getSettingsModel()->recaptchaEnabled;
    }

    /**
     * @return Freeform_SettingsModel
     */
    public function getSettingsModel()
    {
        if (null === self::$settingsModel) {
            /** @var FreeformPlugin $plugin */
            $plugin              = craft()->plugins->getPlugin('freeform');
            self::$settingsModel = $plugin->getSettings();
        }

        return self::$settingsModel;
    }

    /**
     * @return array
     */
    public function getNavigation()
    {
        $navigation = [
            'hd'                   => ['heading' => 'Settings'],
            'license'              => ['title' => 'License'],
            'general'              => ['title' => 'General Settings'],
            'formatting-templates' => ['title' => 'Formatting Templates'],
            'email-templates'      => ['title' => 'Email Templates'],
            'statuses'             => ['title' => 'Statuses'],
            'demo-templates'       => ['title' => 'Demo Templates'],
            'spamhd'               => ['heading' => 'Spam'],
            'spam'                 => ['title' => 'Spam Settings'],
            'recaptcha'            => ['title' => 'reCAPTCHA'],
            'hdapi'                => ['heading' => 'API Integrations'],
            'mailing-lists'        => ['title' => 'Mailing Lists'],
            'crm'                  => ['title' => 'CRM'],
        ];

        if (!class_exists('Solspace\Freeform\Library\Pro\Fields\RecaptchaField')) {
            unset($navigation['recaptcha']);
        }

        return $navigation;
    }
}
