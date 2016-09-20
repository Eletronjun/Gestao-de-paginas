<?php
/**
 *Class for processing framework with HTML standards.
 *
 *@package Model
 *@author  Iasmin Mendes <mendesiasmin96@gmail.com>
 *@license MIT License
 *@link    http://eletronjun.com.br/class/model/webPage.php
 */
namespace model{

    include_once __DIR__ . "/../autoload.php";

    use \configuration\Globals as Globals;
    use \exception\WebPageException as WebPageException;

    class WebPage
    {
        
        /* Class attributes */
        private $title; //page title, not null value
        private $author; //member of the email that created the page
        private $id_category; //category code, code must exist in the database
        private $code; //web page code, only numbers
        private $creation_date; //Date and time to create a page in format yyyy-MM-dd hh:mm:ss,
                    //if receive null command 'now()' is used
        private $last_modified; //Date and time of last page modifier in format yyyy-MM-dd hh:mm:ss,
                    //if receive null command 'now()' is used
        private $content; //Content of the page.

        //Exception messengers
        const NULL_TITLE = "O título não pode ser nulo.";
        const TITLE_LARGER = "O título não pode ter mais que 100 caracteres.";
        const NULL_AUTHOR = "Autor não pode ser nulo.";
        const AUTHOR_LARGER = "Nome não pode ter mais que 100 caracteres.";
        const NO_CATEGORY_ID = "Categoria não identificada.";
        const NO_NUMERIC_ID = "Id deve ser um número.";

        /**
         * Method to create a category instance
         *
         * @param string    $title          page title, not null value
         * @param string    $author         athor's name, not null value
         * @param int       $id_category    category code, code must exist in the database
         * @param date      $creation_date  Date and time to create a page in format yyyy-MM-dd hh:mm:ss,if receive null command 'now()' is used
         * @param date      $last_modified  Date and time to create a page in format yyyy-MM-dd hh:mm:ss,if receive null command 'now()' is used
         * @param string    $content        Content of the page.
         * @param int       $code           web page code, only numbers
         */
        public function __construct($title, $author, $id_category, $creation_date = null, $last_modified = null, $content = null, $code = null)
        {
            $this->setTitle($title);
            $this->setAuthor($author);
            //$this->setCategory($id_category);
            //$this->setId($id);
        }

        private function setTitle($title)
        {
            $title = trim($title);

            if ($title != null) {
                if (strlen($title) <= 100) {
                    $this->title = $title;
                } else {
                    throw new WebPageException(self::TITLE_LARGER);
                }
            } else {
                throw new WebPageException(self::NULL_TITLE);
            }
        }

        public function getTitle()
        {
            return $this->title;
        }

        private function setAuthor($author)
        {
            $author = trim($author);

            if ($author != null) {
                if (strlen($author) <= 100) {
                    $this->author = $author;
                } else {
                    throw new WebPageException(self::AUTHOR_LARGER);
                }
            } else {
                throw new WebPageException(self::NULL_AUTHOR);
            }
        }

        public function getAuthor()
        {
            return $this->author;
        }

        private function setId($id)
        {
            if (is_null($id)) {
                $this->id = $id;
            } else {
                if (is_numeric($id)) {
                    $this->id = $id;
                } else {
                    throw new WebPageException(self::NO_NUMERIC_ID);
                }
            }
        }

        public function getId()
        {
            return $this->id;
        }

        /*TESTAR CATEGORIA NO BANCO DE DADOS*/
    }
}
