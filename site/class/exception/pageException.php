<?php
/**
 *Class for exceptions for page
 *
 *@package Exception
 *@author  Vinicius Pinheiro <viny-pinheiro@hotmail.com>
 *@license MIT License
 *@link    http://eletronjun.com.br/class/exception/pageException.php
 */


namespace exception{

    /**
     * @codeCoverageIgnore
     */
    class PageException extends \Exception
    {

        public function __construct($message, $code = 0, Exception $previous = null)
        {
            parent::__construct($message, $code, $previous);
        }

        public function __toString()
        {
            return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
        }
    }
}
