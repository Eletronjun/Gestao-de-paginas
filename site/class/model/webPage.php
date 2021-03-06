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
        private $references; //References used in content
        private $image; //image path or null if not exists
        private $form; //Google Docs form link or null if not exists
        private $video; //Video link or null if not exists
        private $is_activity; // y or n only

        //Exception messengers
        const NULL_TITLE = "O título não pode ser nulo.";
        const TITLE_LARGER = "O título não pode ter mais que 100 caracteres.";
        const NULL_AUTHOR = "Autor não pode ser nulo.";
        const AUTHOR_LARGER = "Nome não pode ter mais que 100 caracteres.";
        const NO_CATEGORY_ID = "Categoria não identificada.";
        const NO_NUMERIC_ID = "Id deve ser um número.";
        const CHARACTER_LIMIT_EXCEEDED = "O limite do conteúdo é 5000 caracteres.";
        const REFERENCES_LARGER = "O campo referência não pode ter mais que 300 caracteres.";
        const FORMS_LARGER = "O campo formulário não pode ter mais que 300 caracteres.";
        const VIDEO_LARGER = "A url não pode ter mais que 300 caracteres.";
        const INVALID_ACTIVITY = "O campo que verifica se é ativo recebe apenas y para verdadeiro e n para falso";

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
         * @param string    $image          imagePath
         * @param string    $references     References used in content
         * @param string    $is_activity    y or n only
         */
        public function __construct($title, $author, $id_category, $content = null, $code = null, $creation_date = null, $last_modified = null, $image = null, $references = null, $is_activity = 'y', $form = null, $video = null)
        {
            $this->setTitle($title);
            $this->setAuthor($author);
            $this->setContent($content);
            $this->setCreationDate($creation_date);
            $this->setLastModified($last_modified);
            $this->setCode($code);
            $this->setCategory($id_category);
            $this->setImage($image);
            $this->setReferences($references);
            $this->setIsActivity($is_activity);
            $this->setForm($form);
            $this->setVideo($video);
        }

        public function setTitle($title)
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

        public function setAuthor($author)
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

        public function setCategory($id_category)
        {
            if ($id_category != null) {
                $this->id_category = $id_category;
            } else {
                throw new WebPageException(self::NO_CATEGORY_ID);
            }
        }

        public function getCategory()
        {
            return $this->id_category;
        }

        public function setContent($content)
        {
            if (strlen($content) <= 5000) {
                $this->content = $content;
            } else {
                throw new WebPageException(self::CHARACTER_LIMIT_EXCEEDED);
            }
        }

        public function getContent()
        {
            return $this->content;
        }

        public function setCreationDate($creation_date)
        {

            if ($creation_date != null) {
                $this->creation_date = $creation_date;
            } else {
                date_default_timezone_set('America/Sao_Paulo');
                $this->creation_date = getdate();
            }
        }

        public function getCreationDate()
        {
            return $this->creation_date;
        }

        public function setLastModified($last_modified)
        {

            if ($last_modified != null) {
                $this->last_modified = $last_modified;
            } else {
                date_default_timezone_set('America/Sao_Paulo');
                $this->last_modified = getdate();
            }
        }

        public function getLastModified()
        {
            return $this->last_modified;
        }

        public function setCode($code)
        {
            $this->code = $code;
        }

        public function getCode()
        {
            return $this->code;
        }

        public function setImage($image)
        {
            $this->image = $image;
        }

        public function getImage()
        {
            return $this->image;
        }


        public function setReferences($references)
        {
            if (strlen($references) <= 300) {
                $this->references = $references;
            } else {
                throw new WebPageException(self::REFERENCES_LARGER);
            }
        }

        public function getReferences()
        {
            return $this->references;
        }

        public function setIsActivity($is_activity)
        {
            $is_activity = strtolower($is_activity);
            if ($is_activity == "y" || $is_activity == "n") {
                $this->is_activity = $is_activity;
            } else {
                throw new WebPageException(self::INVALID_ACTIVITY);
            }
        }

        public function getIsActivity()
        {
            return $this->is_activity;
        }

        public function setForm($form)
        {
            if (strlen($form) <= 300) {
                $this->form = $form;
            } else {
                throw new WebPageException(self::FORM_LARGER);
            }
        }

        public function getForm()
        {
            return $this->form;
        }
        public function setVideo($video)
        {
            if (strlen($video) <= 300) {
                $this->video = $video;
            } else {
                throw new WebPageException(self::VIDEO_LARGER);
            }
        }

        public function getVideo()
        {
            return $this->video;
        }
    }
}
