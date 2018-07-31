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

use Solspace\Freeform\Library\Composer\Components\AbstractField;
use Solspace\Freeform\Library\Composer\Components\Fields\Interfaces\PlaceholderInterface;
use Solspace\Freeform\Library\Composer\Components\Fields\Interfaces\SingleValueInterface;
use Solspace\Freeform\Library\Composer\Components\Fields\Traits\PlaceholderTrait;
use Solspace\Freeform\Library\Composer\Components\Fields\Traits\SingleValueTrait;
use Solspace\Freeform\Library\Composer\Components\Validation\Constraints\LengthConstraint;

class TextField extends AbstractField implements SingleValueInterface, PlaceholderInterface
{
    const MAXIMUM_FIELD_LENGTH = 100;

    use PlaceholderTrait;
    use SingleValueTrait;

    /** @var int */
    protected $maxLength;

    /**
     * Return the field TYPE
     *
     * @return string
     */
    public function getType()
    {
        return self::TYPE_TEXT;
    }

    /**
     * @return int
     */
    public function getMaxLength()
    {
        return $this->maxLength;
    }

    /**
     * @inheritDoc
     */
    public function getConstraints()
    {
        $constraints   = parent::getConstraints();
        $constraints[] = new LengthConstraint(
            null,
            $this->getMaxLength() ?: static::MAXIMUM_FIELD_LENGTH,
            $this->translate('The allowed maximum length is {{max}} characters. Current size is {{difference}} characters too long.')
        );

        return $constraints;
    }

    /**
     * Outputs the HTML of input
     *
     * @return string
     */
    protected function getInputHtml()
    {
        $attributes  = $this->getCustomAttributes();
        $classString = $attributes->getClass() . ' ' . $this->getInputClassString();

        return '<input '
            . $this->getAttributeString('name', $this->getHandle())
            . $this->getAttributeString('type', 'text')
            . $this->getAttributeString('id', $this->getIdAttribute())
            . $this->getAttributeString('class', $classString)
            . $this->getNumericAttributeString('maxlength', $this->getMaxLength())
            . $this->getAttributeString(
                'placeholder',
                $this->translate($attributes->getPlaceholder() ?: $this->getPlaceholder())
            )
            . $this->getAttributeString('value', $this->getValue(), false)
            . $this->getRequiredAttribute()
            . $attributes->getInputAttributesAsString()
            . '/>';
    }
}
