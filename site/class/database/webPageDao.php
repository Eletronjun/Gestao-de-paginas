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
        const NOT_DELETE_WEB_PAGE = "Não foi possível excluir a página web.";

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
            $query = "SELECT code, title, author, code_category, creation_date, last_modified, content FROM WEB_PAGE";

            $dao = new DAO(Globals::HOST, Globals::USER, Globals::PASSWORD, Globals::DATABASE);

            $resultSet = $dao->query($query);

            $data = array();

            for ($i = 0; $row = $resultSet->fetch_assoc(); $i++) {
                $data[$i][0] = $row['code'];
                $data[$i][1] = $row['title'];
                $data[$i][2] = $row['author'];
                $data[$i][3] = $row['code_category'];
                $data[$i][4] = $row['creation_date'];
                $data[$i][5] = $row['last_modified'];
                $data[$i][6] = $row['content'];
            }

            return $data;
        }

        /**
         * Method to update data
         * @param String  $new_title
         * @param String  $new_author
         * @param Int  $new_category
         * @param String  $new_postage
         */
        public function updatePage($new_title, $new_author, $new_category, $new_postage)
        {
            if (!is_null($this->getWebPageModel()->getCode())) {
                $query = "UPDATE WEB_PAGE SET title = '{$new_title}', author = '{$new_author}', code_category = {$new_category}, content = '{$new_postage}', last_modified = NOW() WHERE code = " . $this->getWebPageModel()->getCode();
                parent::query($query);
                $this->getPage();

            } else {
                throw new WebPageException(self::NOT_UPDATE_WEB_PAGE);
            }
        }


        /**
         * Method to persist web page data
         */
        public function register()
        {
            $query = "INSERT INTO `WEB_PAGE`(`title`, `author`, `code_category`, `creation_date`, `last_modified`, `content`)
            VALUES ('{$this->getWebPageModel()->getTitle()}', '{$this->getWebPageModel()->getAuthor()}',
            {$this->getWebPageModel()->getCategory()}, NOW(),NOW(),'{$this->getWebPageModel()->getContent()}')";

            parent::query($query);

            $web_page = new WebPage(
                $this->getWebPageModel()->getTitle(),
                $this->getWebPageModel()->getAuthor(),
                $this->getWebPageModel()->getCategory(),
                $this->getWebPageModel()->getContent(),
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

        /**
         * Method to delete data
         * @param Int  $code
         */
        public function delete()
        {
            if (!is_null($this->getWebPageModel()->getCode())) {
                $query = "DELETE FROM WEB_PAGE WHERE code = " . $this->getWebPageModel()->getCode();

                parent::query($query);

            } else {
                throw new WebPageException(self::NOT_UPDATE_WEB_PAGE);
            }
        }

        public function getPage()
        {
          if (!is_null($this->getWebPageModel()->getCode())) {
            $query = "SELECT code, title, author, code_category, creation_date, last_modified, content FROM WEB_PAGE WHERE code = " . $this->getWebPageModel()->getCode();

            $dao = new DAO(Globals::HOST, Globals::USER, Globals::PASSWORD, Globals::DATABASE);

            $resultSet = $dao->query($query);

            $row = $resultSet->fetch_assoc();

            $this->getWebPageModel()->setTitle($row['title']);
            $this->getWebPageModel()->setAuthor($row['author']);
            $this->getWebPageModel()->setCategory($row['code_category']);
            $this->getWebPageModel()->setCreationDate($row['creation_date']);
            $this->getWebPageModel()->setLastModified($row['last_modified']);
            $this->getWebPageModel()->setContent($row['content']);

          } else {
              throw new WebPageException(self::NOT_UPDATE_WEB_PAGE);
          }
        }
    }
}
