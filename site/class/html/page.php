<?php
/**
 * file: page.php
 * class contain html with page struture
 */
 
class Page
{
	/**
	 * Method with all meta tag and header for html page
	 * @param $title title of the page, not null value or empty
	 * @param $description string with the meta tag descritpion
	 */
	public static function header($title, $description = null)
	{
		if($title != null && $title != "")
		{
			echo "
			<!DOCTYPE html>
			<html>

			<head>
				<title>{$title}</title>
				<meta charset=\"utf-8\">
				<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
				<link rel=\"icon\" type=\"image/png\" href=\"res/favicon.png\" />
				<meta name=\"description\" content=\"{$description}\">
				<meta name=\"keywords\" content=\"EletronJun, Gama, UnB, Universidade de Brasília, FGA, eletrônica, desenvolvimento de projetos, empresa, empresa júnior\">
			</head>
			<body>";
		}
		else
		{
			throw new PageException("T&iacute;tulo inv&aacute;lido");
		}
	}
	
	/**
	 * Method to close html body
	 */
	public static function closeBody()
	{
		echo ' </body></html>';
	}
	
}

/**
 * @codeCoverageIgnore
 */
class PageException extends Exception{
	
	public function __construct($message, $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }

    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}

