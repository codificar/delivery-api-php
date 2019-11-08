<?php

namespace Delivery\Exceptions;

final class DeliveryException extends \Exception
{
    /**
     * @var boolean
     */
    private $success;

    /**
     * @var string
     */
    private $error;

    /**
     * @var array
     */
    private $errors;

    /**
     * @var int
     */
    private $error_code;

    /**
     * @param boolean $success
     * @param int $error_code
     * @param string $error
     * @param array $errors
     */
    public function __construct($success, $error_code, $error = null, $errors = null)
    {
        $this->success = $success;
        $this->error = $error;
        $this->errors = $errors;
        $this->error_code = $error_code;

        $exceptionMessage = $this->buildExceptionMessage();

        parent::__construct($exceptionMessage);
    }

    /**
     * @return string
     */
    private function buildExceptionMessage()
    {
        return sprintf(
            $this->success,
            $this->error,
            $this->errors,
            $this->error_code
        );
    }

    /**
     * @return boolean
     */
    public function getSuccess()
    {
        return $this->success;
    }

    /**
     * @return string
     */
    public function getError()
    {
        return $this->error;
    }
    
    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @return int
     */
    public function getErrorCode()
    {
        return $this->error_code;
    }
}
