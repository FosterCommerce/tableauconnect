<?php
namespace fostercommerce\tableauconnect\services;

use Craft;
use craft\base\Component;
use craft\web\View;
use craft\helpers\Template;
use fostercommerce\tableauconnect\Plugin;

class Visualization extends Component
{
    private $settings = null;

    public function __construct()
    {
        $this->settings = Plugin::getInstance()->settings;
    }

    public function render($view, $options = array())
    {
        // Prevent potential clashes if a use has multiple
        // visualizations in a template.
        $prefix = Craft::$app->security->generateRandomString(8);

        $callbacks = array();
        if (isset($options['onFirstInteractive'])) {
            $onFirstInteractive = $options['onFirstInteractive'];
            unset($options['onFirstInteractive']);
            $callbacks['onFirstInteractive'] = $onFirstInteractive;
        }

        if (isset($options['onFirstVizSizeKnown'])) {
            $onFirstVizSizeKnown = $options['onFirstVizSizeKnown'];
            unset($options['onFirstVizSizeKnown']);
            $callbacks['onFirstVizSizeKnown'] = $onFirstVizSizeKnown;
        }

        $params = [
            'prefix' => $prefix,
            'tableauView' => $view,
            'settings' => $this->settings,
            'options' => $options,
            'callbacks' => $callbacks,
        ];

        $oldMode = Craft::$app->view->getTemplateMode();
        Craft::$app->view->setTemplateMode(View::TEMPLATE_MODE_CP);
        $html = Craft::$app->view->renderTemplate('tableauconnect/visualization', $params);
        Craft::$app->view->setTemplateMode($oldMode);
        return Template::raw($html);
    }
}
