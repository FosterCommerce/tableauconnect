<?php
namespace fostercommerce\tableauconnect\exceptions;

class NotAuthorizedException extends \Exception
{
    function __construct()
    {
        parent::__construct("Not authorized");
    }
}