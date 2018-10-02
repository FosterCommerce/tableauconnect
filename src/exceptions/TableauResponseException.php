<?php
namespace fostercommerce\tableauconnect\exceptions;

class TableauResponseException extends \Exception
{
    function __construct($e)
    {
        parent::__construct('Unknown response from Tableau server', 0, $e);
    }
}