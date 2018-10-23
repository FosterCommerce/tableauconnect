<?php
namespace fostercommerce\tableauconnect\variables;

use yii\web\HttpException;
use fostercommerce\tableauconnect\Plugin;
use fostercommerce\tableauconnect\exceptions\TableauAuthorizationException;

class Variable
{
    private $token = null;

    public function canView()
    {
        $plugin = Plugin::getInstance();
        $requireAuthorization = $plugin->settings->requireAuthorization;
        if ($requireAuthorization && !$this->token) {
            try {
                $this->token = $plugin->link->authorize();
            } catch (TableauAuthorizationException $e) {
                return false;
            } catch (HttpException $e) {
                if ($e->statusCode === 401) {
                    return false;
                }
                throw $e;
            } catch (TableauResponseException $e) {
                throw new HttpException(400, $e->getMessage(), 0, $e);
            }
        }
        return true;
    }

    public function embedUrl($view)
    {
        $plugin = Plugin::getInstance();
        $settings = $plugin->settings;
        $requireAuthorization = $settings->requireAuthorization;
        $url = $settings->tableauServerUrl;
        if ($this->canView() && $requireAuthorization) {
            $url = "{$url}/trusted/{$this->token}";
        } else {
            throw new HttpException(401, 'Not authorized to view visualization');
        }

        $url = "${url}/views/$view?embed=y";

        return $url;
    }

    public function renderVisualization($view, $options)
    {
        $plugin = Plugin::getInstance();
        $requireAuthorization = $plugin->settings->requireAuthorization;
        if ($this->canView() && $requireAuthorization) {
            $view = "trusted/{$this->token}/views/{$view}";
        } elseif (!$requireAuthorization) {
            $view = "views/{$view}";
        } else {
            throw new HttpException(401, 'Unauthorized to view visualization');
        }

        return $plugin->visualization->render($view, $options);
    }

    public function baseUrl()
    {
        return Plugin::getInstance()->settings->tableauServerUrl;
    }
}
