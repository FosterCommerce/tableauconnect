<?php
namespace fostercommerce\tableauconnect;

use craft\web\twig\variables\CraftVariable;
use fostercommerce\tableauconnect\models\Settings;
use fostercommerce\tableauconnect\variables\Variable;
use yii\base\Event;

use Craft;

class Plugin extends \craft\base\Plugin
{
    public function init()
    {
        parent::init();

        Event::on(CraftVariable::class, CraftVariable::EVENT_INIT, function (Event $event) {
            $variable = $event->sender;
            $variable->set('tableauconnect', Variable::class);
        });
    }

    protected function createSettingsModel()
    {
        return new Settings();
    }

    protected function settingsHtml(): string
    {
        return Craft::$app->view->renderTemplate(
            'tableauconnect/settings',
            [
                'settings' => $this->getSettings()
            ]
        );
    }
}
