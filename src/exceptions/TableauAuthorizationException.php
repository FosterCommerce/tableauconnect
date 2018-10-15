<?php
namespace fostercommerce\tableauconnect\exceptions;

class TableauAuthorizationException extends \Exception
{
    public function __construct($username)
    {
        parent::__construct("Tableau authorization failed for {$username}");
    }
}
