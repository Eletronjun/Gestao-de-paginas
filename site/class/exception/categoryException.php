<?php
/**
 *Class for exceptions for page
 *
 *@package Exception
 *@author  Vinicius Pinheiro <viny-pinheiro@hotmail.com>
 *@license MIT License
 *@link    http://eletronjun.com.br/class/exception/categoryException.php
 */
namespace exception{

    /**
     * @codeCoverageIgnore
     */
    class CategoryException extends \Exception
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
