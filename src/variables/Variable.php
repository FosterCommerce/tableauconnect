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
            $plugin->link->authorize();
            $url = "{$url}/trusted/{$token}";
        }
        $url = "${url}/views/$view?embed=y";

        return $url;
    }

    public function renderVisualization($view, $options)
    {
        $plugin = Plugin::getInstance();
        return $plugin->visualization->render($view, $options);
        // $settings = $plugin->settings;
        // $url = $settings->tableauServerUrl;
        // if ($settings->requireAuthorization) {
        //     $plugin->link->authorize();
        //     $url = "{$url}/trusted/{$token}";
        // }
        // $url = "${url}/views/$view?embed=y";

        // return $url;
    }

    public function baseUrl()
    {
        return Plugin::getInstance()->settings->tableauServerUrl;
    }
}
