<?php
/**
 *Class for exceptions for web page
 *
 *@package Exception
 *@author  Iasmin Mendes <mendesiasmin96@gmail.com>
 *@license MIT License
 *@link    http://eletronjun.com.br/class/exception/webPageException.php
 */
namespace exception{

    /**
     * @codeCoverageIgnore
     */
    class WebPageException extends \Exception
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
