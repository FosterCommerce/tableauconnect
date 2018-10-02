<?php
namespace fostercommerce\tableauconnect\exceptions;

class TableauAuthorizationException extends \Exception
{
    function __construct($username)
    {
        parent::__construct("Tableau authorization failed for {$username}");
    }
}