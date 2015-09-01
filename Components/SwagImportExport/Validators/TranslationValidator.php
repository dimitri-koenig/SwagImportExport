<?php

namespace Shopware\Components\SwagImportExport\Validators;

use Shopware\Components\SwagImportExport\Utils\SnippetsHelper;
use Shopware\Components\SwagImportExport\Exception\AdapterException;

class TranslationValidator extends Validator
{
    //TODO: check which other fields are required
    private $requiredFields = array(
        'objectType',
        'name',
    );

    private $snippetData = array(
        'objectType' => array(
            'adapters/translations/object_type_not_found',
            'Object type is required.'
        ),
        'name' => array(
            'adapters/translations/element_name_not_found',
            'Please provide name'
        ),
    );

    public function checkRequiredFields($record)
    {
        foreach ($this->requiredFields as $key) {
            if (isset($record[$key])) {
                continue;
            }

            list($snippetName, $snippetMessage) = $this->snippetData[$key];

            $message = SnippetsHelper::getNamespace()->get($snippetName, $snippetMessage);
            throw new AdapterException($message);
        }
    }
}