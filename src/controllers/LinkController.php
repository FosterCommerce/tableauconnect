<?php
namespace fostercommerce\tableauconnect\controllers;

use fostercommerce\tableauconnect\TableauConnect;

use Craft;
use craft\web\Controller;
use yii\web\HttpException;
use fostercommerce\tableauconnect\Plugin;
use fostercommerce\tableauconnect\exceptions\TableauAuthorizationException;


class LinkController extends Controller
{
    //TODO: remove this
    public $enableCsrfValidation = false;
    protected $allowAnonymous = true;

    // TODO: do we evenz need this? We will have a template component which can
    // be loaded into any twig template and that will call the service
    public function actionIndex()
    {
        $this->requirePostRequest();

        try {
            $token = Plugin::getInstance()->link->authorize();
            return $this->asJson([
                'token' => $token,
            ]);
        } catch (TableauAuthorizationException $e) {
            throw new HttpException(401, $e->getMessage());
        }
    }
}
