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

use Solspace\Freeform\Library\Exceptions\FreeformException;

/**
 * @property string $pluginName
 * @property string $defaultView
 * @property bool   $spamProtectionEnabled
 * @property bool   $spamBlockLikeSuccessfulPost
 * @property string $formTemplateDirectory
 * @property string $emailTemplateDirectory
 * @property string $license
 * @property string $fieldDisplayOrder
 * @property bool   $showTutorial
 * @property bool   $defaultTemplates
 * @property bool   $removeNewlines
 * @property string $emailTemplateStorage
 * @property bool   $footerScripts
 * @property bool   $formSubmitDisable
 * @property bool   $recaptchaEnabled
 * @property string $recaptchaKey
 * @property string $recaptchaSecret
 */
class Freeform_SettingsModel extends BaseModel
{
    const EMAIL_TEMPLATE_STORAGE_DB   = 'db';
    const EMAIL_TEMPLATE_STORAGE_FILE = 'template';

    /**
     * @return array
     */
    public function rules()
    {
        $rules = parent::rules();

        $rules[] = ['formTemplateDirectory', 'folderExists'];
        $rules[] = [['recaptchaKey', 'recaptchaSecret'], 'validateRecaptchaItems'];

        return $rules;
    }

    /**
     * @param $attribute
     */
    public function folderExists($attribute)
    {
        $path         = $this->{$attribute};
        $absolutePath = $this->getAbsolutePath($path);

        if (!file_exists($absolutePath)) {
            $this->addError(
                $attribute,
                Craft::t("Directory '{directory}' does not exist", ['directory' => $absolutePath])
            );
        }
    }

    /**
     * If a form template directory has been set and it exists - return its absolute path
     *
     * @return null|string
     */
    public function getAbsoluteFormTemplateDirectory()
    {
        if ($this->formTemplateDirectory) {
            $absolutePath = $this->getAbsolutePath($this->formTemplateDirectory);

            return file_exists($absolutePath) ? $absolutePath : null;
        }

        return null;
    }

    /**
     * If an email template directory has been set and it exists - return its absolute path
     *
     * @return null|string
     */
    public function getAbsoluteEmailTemplateDirectory()
    {
        if ($this->emailTemplateDirectory) {
            $absolutePath = $this->getAbsolutePath($this->emailTemplateDirectory);

            return file_exists($absolutePath) ? $absolutePath : null;
        }

        return null;
    }

    /**
     * Gets the demo template content
     *
     * @param string $name
     *
     * @return string
     * @throws FreeformException
     */
    public function getDemoTemplateContent($name = 'flexbox')
    {
        $path = CRAFT_PLUGINS_PATH . "freeform/templates/_defaultFormTemplates/$name.html";
        if (!file_exists($path)) {
            throw new FreeformException(
                Craft::t('Could not get demo template content. Please contact Solspace.')
            );
        }

        return file_get_contents($path);
    }

    /**
     * Gets the default email template content
     *
     * @return string
     * @throws FreeformException
     */
    public function getEmailTemplateContent()
    {
        $path = CRAFT_PLUGINS_PATH . 'freeform/templates/_emailTemplates/default.html';
        if (!file_exists($path)) {
            throw new FreeformException(
                Craft::t('Could not get email template content. Please contact Solspace.')
            );
        }

        return file_get_contents($path);
    }

    /**
     * @return array|bool
     */
    public function listTemplatesInFormTemplateDirectory()
    {
        $templateDirectoryPath = $this->getAbsoluteFormTemplateDirectory();

        if (!$templateDirectoryPath) {
            return [];
        }

        $files = [];
        foreach (IOHelper::getFiles($templateDirectoryPath) as $file) {
            if (@is_dir($file)) {
                continue;
            }

            $files[$file] = pathinfo($file, PATHINFO_BASENAME);
        }

        return $files;
    }

    /**
     * @return array|bool
     */
    public function listTemplatesInEmailTemplateDirectory()
    {
        $templateDirectoryPath = $this->getAbsoluteEmailTemplateDirectory();

        if (!$templateDirectoryPath) {
            return [];
        }

        $files = [];
        foreach (IOHelper::getFiles($templateDirectoryPath) as $file) {
            if (@is_dir($file)) {
                continue;
            }

            $files[$file] = pathinfo($file, PATHINFO_BASENAME);
        }

        return $files;
    }

    public function validateRecaptchaItems($attribute)
    {
        if ($this->recaptchaEnabled && empty($this->$attribute)) {
            $this->addError($attribute, Craft::t('This is a required field'));
        }
    }

    /**
     * @return array
     */
    protected function defineAttributes()
    {
        return [
            'pluginName'                  => [AttributeType::String, 'default' => null],
            'formTemplateDirectory'       => [AttributeType::String, 'default' => null],
            'emailTemplateDirectory'      => [AttributeType::String, 'default' => null],
            'emailTemplateStorage'        => [AttributeType::String, 'default' => self::EMAIL_TEMPLATE_STORAGE_DB],
            'license'                     => [AttributeType::String, 'default' => null],
            'spamProtectionEnabled'       => [AttributeType::Bool, 'default' => true],
            'spamBlockLikeSuccessfulPost' => [AttributeType::Bool, 'default' => false],
            'defaultView'                 => [AttributeType::String, 'default' => FreeformPlugin::VIEW_FORMS],
            'fieldDisplayOrder'           => [
                AttributeType::Enum,
                'values'  => [
                    FreeformPlugin::FIELD_DISPLAY_ORDER_TYPE,
                    FreeformPlugin::FIELD_DISPLAY_ORDER_NAME,
                ],
                'default' => FreeformPlugin::FIELD_DISPLAY_ORDER_NAME,
            ],
            'showTutorial'                => [AttributeType::Bool, 'default' => true],
            'defaultTemplates'            => [AttributeType::Bool, 'default' => true],
            'removeNewlines'              => [AttributeType::Bool, 'default' => false],
            'footerScripts'               => [AttributeType::Bool, 'default' => true],
            'formSubmitDisable'           => [AttributeType::Bool, 'default' => true],
            'recaptchaEnabled'            => [AttributeType::Bool, 'default' => false],
            'recaptchaKey'                => [AttributeType::String, 'default' => null],
            'recaptchaSecret'             => [AttributeType::String, 'default' => null],
        ];
    }

    /**
     * @param string $path
     *
     * @return string
     */
    private function getAbsolutePath($path)
    {
        $isAbsolute = $this->isFolderAbsolute($path);

        return $isAbsolute ? $path : (CRAFT_BASE_PATH . $path);
    }

    /**
     * @param string $path
     *
     * @return bool
     */
    private function isFolderAbsolute($path)
    {
        return preg_match("/^(?:\/|\\\\|\w\:\\\\).*$/", $path);
    }
}
