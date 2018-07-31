<?php

namespace Solspace\Freeform\Library\Database;

use Solspace\Freeform\Library\Composer\Components\AbstractField;
use Solspace\Freeform\Library\Composer\Components\Form;

interface FieldHandlerInterface
{
    /**
     * Perform actions with a field before validation takes place
     *
     * @param AbstractField $field
     * @param Form          $form
     */
    public function onBeforeValidate(AbstractField $field, Form $form);

    /**
     * Perform actions with a field after validation takes place
     *
     * @param AbstractField $field
     * @param Form          $form
     */
    public function onAfterValidate(AbstractField $field, Form $form);
}