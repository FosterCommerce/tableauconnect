<?php
namespace fostercommerce\tableauconnect\variables;

use fostercommerce\tableauconnect\Plugin;

class Variable
{
    public function embedUrl($view)
    {
        $plugin = Plugin::getInstance();
        $settings = $plugin->settings;
        $url = $settings->tableauServerUrl;
        if ($settings->requireAuthorization) {
            $token = $plugin->link->authorize();
            $url = "{$url}/trusted/{$token}";
        }
        $url = "${url}/views/$view?embed=y";

        return $url;
    }

    public function renderVisualization($view, $options)
    {
        $plugin = Plugin::getInstance();
        $settings = $plugin->settings;
        if ($settings->requireAuthorization) {
            $token = $plugin->link->authorize();
            $view = "trusted/{$token}/views/{$view}";
        } else {
            $view = "views/{$view}";
        }

        return $plugin->visualization->render($view, $options);
    }

    public function baseUrl()
    {
        return Plugin::getInstance()->settings->tableauServerUrl;
    }
}
