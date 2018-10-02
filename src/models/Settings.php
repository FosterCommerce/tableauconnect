<?php
namespace fostercommerce\tableauconnect\models;

use Craft;
use craft\base\Model;

class Settings extends Model
{
    public $tableauServerUrl = null;
    public $requireAuthorization = true;

    public function rules()
    {
        return [
            ['tableauServerUrl', 'required'],
            ['tableauServerUrl', 'url'],
            ['requireAuthorization', 'boolean'],
        ];
    }
}
