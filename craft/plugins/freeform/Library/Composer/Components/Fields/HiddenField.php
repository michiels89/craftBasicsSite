<?php
/**
 * Freeform for Craft
 *
 * @package       Solspace:Freeform
 * @author        Solspace, Inc.
 * @copyright     Copyright (c) 2008-2016, Solspace, Inc.
 * @link          https://solspace.com/craft/freeform
 * @license       https://solspace.com/software/license-agreement
 */

namespace Solspace\Freeform\Library\Composer\Components\Fields;

use Solspace\Freeform\Library\Composer\Components\Fields\Interfaces\NoRenderInterface;
use Solspace\Freeform\Library\Composer\Components\Fields\Interfaces\SingleValueInterface;
use Solspace\Freeform\Library\Composer\Components\Fields\Traits\SingleValueTrait;
use Solspace\Freeform\Library\Composer\Components\Validation\Constraints\LengthConstraint;

class HiddenField extends TextField implements NoRenderInterface
{
    const MAXIMUM_FIELD_LENGTH = 250;

    /**
     * Return the field TYPE
     *
     * @return string
     */
    public function getType()
    {
        return self::TYPE_HIDDEN;
    }

    /**
     * @return string
     */
    public function getInputHtml()
    {
        $attributes = $this->getCustomAttributes();

        return '<input '
            . $this->getAttributeString('name', $this->getHandle())
            . $this->getAttributeString('type', $this->getType())
            . $this->getAttributeString('class', $attributes->getClass())
            . $this->getAttributeString('id', $this->getIdAttribute())
            . $this->getAttributeString('value', $this->getValue(), false)
            . $attributes->getInputAttributesAsString()
            . '/>';
    }
}
