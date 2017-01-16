<?php
/**
 *Class for exceptions for member
 *
 *@package Exception
 *@author  Vinicius Pinheiro <viny-pinheiro@hotmail.com>
 *@license MIT License
 *@link    http://eletronjun.com.br/class/exception/memberException.php
 */
namespace exception{

    /**
     * @codeCoverageIgnore
     */
    class MemberException extends \Exception
    {
        public function __construct($message, $code = 0, Exception $previous = null)
        {
            parent::__construct($message, $code, $previous);
        }

        public function __toString()
        {
            return $this->message;
        }
    }
}
