<?php
namespace faizavel\mvc\exception;

class ForbiddenException extends \Exception
{
    protected $message = 'You do not have permission to access this page';
    protected $code = 403;
    public function __construct($message = null, $code = 0, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->message = $message ?? $this->message;
        $this->code = $code ?? $this->code;

    }
}