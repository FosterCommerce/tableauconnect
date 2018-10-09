<?php
namespace fostercommerce\tableauconnect\services;

use Craft;
use craft\base\Component;
use fostercommerce\tableauconnect\Plugin;
use fostercommerce\tableauconnect\exceptions\NotAuthorizedException;
use fostercommerce\tableauconnect\exceptions\TableauAuthorizationException;
use fostercommerce\tableauconnect\exceptions\TableauResponseException;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\RequestException;

class Link extends Component
{
    private $settings = null;
    private $client = null;

    public function __construct()
    {
        // TODO: add multi-site config
        $this->settings = Plugin::getInstance()->settings;
        $this->client = new Client();
    }

    public function authorize($siteId = null)
    {
        $user = Craft::$app->user->getIdentity();
        if (is_null($user)) {
            throw new NotAuthorizedException();
        }

        $postData = [
            'username' => $user->email,
            'client_ip' => Craft::$app->getRequest()->getUserIP(),
        ];

        if (!is_null($siteId)) {
            $postData['target_site'] = $siteId;
        }

        try {
            $response = $this->client->post("{$this->settings->tableauServerUrl}/trusted", $postData);
            $token = (string) $response->getBody();
        } catch (RequestException $e) {
            throw new TableauResponseException($e);
        }

        if ($token === '-1') {
            throw new TableauAuthorizationException($user->email);
        }

        return $token;
    }
}
