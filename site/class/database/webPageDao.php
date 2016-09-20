<?php
/**
 *Base class to persist data
 *
 *@package Dao
 *@author  Iasmin Mendes <mendesiasmin96@gmail.com>
 *@license MIT License
 *@link    http://eletronjun.com.br/class/database/newPageDao.php
 */

namespace dao{

    include_once __DIR__ . "/../autoload.php";

    use \configuration\Globals as Globals;
    use \exception\DatabaseException as DatabaseException;
    use \model\WebPage as WebPage;

    class WebPageDAO extends DAO
    {
        /* Class attributes */
        private $web_page_model;

        /* Exception constants */
        const INVALID_MODEL = "Modelo Inválida.";
        const WEB_PAGE_MODEL_ISNT_OBJECT = "Objeto da Página Web Inválido.";
        const NOT_UPDATE_WEB_PAGE = "Não foi possível atualizar a página web.";

        /**
         * @param WebPage $WebPageModel not null value
         */
        public function __construct($web_page_model)
        {
            parent::__construct(Globals::HOST, Globals::USER, Globals::PASSWORD, Globals::DATABASE);
            $this->setWebPageModel($web_page_model);
        }

        public static function getWebPages()
        {
            $query = "SELECT id, title FROM WEB_PAGE";
            $dao = new DAO(Globals::HOST, Globals::USER, Globals::PASSWORD, Globals::DATABASE);

            $resultSet = $dao->query($query);

            $data = array();

            for ($i = 0; $row = $resultSet->fetch_assoc(); $i++) {
                $data[$i][0] = $row['code'];
                $data[$i][1] = $row['name'];
            }

            return $data;
        }

        /**
         * Method to update data
         * @param String  $new_title
         */
        public function updateTitle($new_title)
        {
            if (!is_null($this->getNewPageModel()->getId())) {
                $query = "UPDATE WEB_PAGE SET title = '{$new_title}' WHERE id = " . $this->getWebPageModel()->getId();

                parent::query($query);

                $web_page = new WebPage(
                    $new_title,
                    $this->getWebPageModel()->getId()
                );
            } else {
                throw new WebPageException(self::NOT_UPDATE_WEB_PAGE);
            }
        }

        /**
         * Method to update data
         * @param String  $new_author
         */
        public function updateAuthor($new_author)
        {
            if (!is_null($this->getNewPageModel()->getId())) {
                $query = "UPDATE WEB_PAGE SET author = '{$new_author}', SET last_modified = NOW() WHERE id = " . $this->getWebPageModel()->getId();

                parent::query($query);

                $web_page = new WebPage(
                    $new_title,
                    $this->getWebPageModel()->getId()
                );
            } else {
                throw new WebPageException(self::NOT_UPDATE_WEB_PAGE);
            }
        }

        /**
         * Method to persist web page data
         */
        public function register()
        {
            $query = "INSERT INTO WEB_PAGE(title, author, creation_date, last_modified) VALUES('{$this->getWebPageModel()->getTitle()}', '{$this->getWebPageModel()->getAuthor()}', NOW(), NOW())";

            parent::query($query);

            $web_page = new WebPage(
                $this->getWebPageModel()->getTitle(),
                parent::insertId()
            );

            $this->setWebPageModel($web_page);

            parent::disconnect();
        }

        public function setWebPageModel($web_page_model)
        {
            if (is_object($web_page_model)) {
                if (get_class($web_page_model) == "model\WebPage") {
                    $this->web_page_model = $web_page_model;
                } else {
                    throw new DatabaseException(self::INVALID_MODEL);
                }
            } else {
                throw new DatabaseException(self::CATEGORY_MODEL_ISNT_OBJECT);
            }
        }

        public function getWebPageModel()
        {
            return $this->web_page_model;
        }
    }
}
