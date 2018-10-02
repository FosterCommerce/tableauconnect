<?php

namespace fostercommerce\tableauconnect\bundles;

use craft\web\AssetBundle;
use fostercommerce\tableauconnect\Plugin;

class TableauAsset extends AssetBundle
{
    public function init()
    {
        $serverUrl = Plugin::getInstance()->settings->tableauServerUrl;
        $this->js = ["{$serverUrl}/javascripts/api/tableau-2.min.js"];
        parent::init();
    }
}
