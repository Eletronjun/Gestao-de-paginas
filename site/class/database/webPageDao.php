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
        const NOT_FIND_PAGE = "Página não encontrada.";
        const INVALID_CODE = "Código inválido.";

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
            $query = "SELECT code, title, author, code_category, creation_date, last_modified, content, image, reference FROM WEB_PAGE";

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
                $data[$i][7] = $row['reference'];
                $data[$i][8] = $row['image'];
            }
            return $data;
        }

        /**
         * Method to update data
         * @param String  $new_title
         * @param String  $new_author
         * @param Int  $new_category
         * @param String  $new_postage
         * @param String  $image path of the new image or null if not change image
         */
        public function updatePage($new_title, $new_author, $new_category, $new_postage, $is_activity, $image = null, $new_reference = null)
        {
            $changeImage = ($image == null)? "" : ", image = '{$image}'";
            if (!is_null($this->getWebPageModel()->getCode())) {
                $query = "UPDATE WEB_PAGE SET title = '{$new_title}', author = '{$new_author}', code_category = {$new_category}, content = '{$new_postage}', reference = '{$new_reference}', last_modified = NOW(){$changeImage}, isActivity = '{$is_activity}' WHERE code = " . $this->getWebPageModel()->getCode();
                parent::query($query);
                if ($image != null) {
                    unlink(UPLOAD_ROOT . $this->getWebPageModel()->getImage());
                }
            } else {
                throw new WebPageException(self::NOT_UPDATE_WEB_PAGE);
            }
        }

        public function deleteImage()
        {
          $query = "UPDATE WEB_PAGE SET image = NULL, last_modified = NOW() WHERE code = " . $this->getWebPageModel()->getCode();
          parent::query($query);
        }


        /**
         * Method to persist web page data
         */
        public function register()
        {
            $query = "INSERT INTO `WEB_PAGE`(`title`, `author`, `code_category`, `creation_date`, `last_modified`, `content`, `image`, `reference`)
            VALUES ('{$this->getWebPageModel()->getTitle()}', '{$this->getWebPageModel()->getAuthor()}',
            {$this->getWebPageModel()->getCategory()}, NOW(),NOW(),'{$this->getWebPageModel()->getContent()}',
            '{$this->getWebPageModel()->getImage()}', '{$this->getWebPageModel()->getReferences()}')";

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

        /**
         * Method to find and return page, if exists
         * @param Int  $code only integer and contain code of the page to return
         * @throws WebPageException invalid code value
         * @throws WebPageException not page returned
         */
        public static function getPage($code)
        {
            if (is_numeric($code)) {
                $query = "SELECT code, title, author, code_category, creation_date, last_modified, content, image, reference,isActivity FROM WEB_PAGE WHERE code = {$code}";

                $dao = new DAO(Globals::HOST, Globals::USER, Globals::PASSWORD, Globals::DATABASE);
                $resultSet = $dao->query($query);

                if ($row = $resultSet->fetch_assoc()) {
                    return new WebPage(
                        $row['title'],
                        $row['author'],
                        $row['code_category'],
                        $row['content'],
                        $code,
                        $row['creation_date'],
                        $row['last_modified'],
                        $row['image'],
                        $row['reference'],
                        $row['isActivity']
                    );
                } else {
                    throw new DatabaseException(self::NOT_FIND_PAGE);
                }
            } else {
                throw new DatabaseException(self::INVALID_CODE);
            }
        }

        /**
         * Method to return the last 3 publications
         * @return Array code => title
         */
        public static function returnLast3()
        {
            $query = "SELECT WEB_PAGE.code, title, content, image " .
                "FROM WEB_PAGE INNER JOIN CATEGORY ON WEB_PAGE.code_category = CATEGORY.code " .
                "WHERE CATEGORY.isActivity = 'y' AND WEB_PAGE.isActivity = 'y' ORDER BY last_modified DESC LIMIT 3";
            $dao = new DAO(Globals::HOST, Globals::USER, Globals::PASSWORD, Globals::DATABASE);
            $resultSet = $dao->query($query);

            $data = array(array());

            for ($i = 0; $row = $resultSet->fetch_assoc(); $i++) {
                $data[$i][0] = $row['code'];
                $data[$i][1] = $row['title'];
                $data[$i][2] = substr($row['content'], 0, 150) . "...";
                $data[$i][3] = $row['image'];
            }

            return $data;
        }

        /**
         * Method to return the last 3 publications with a category
         * @param int $codeCategory only positive numbers and contain the code of category
         * @return Array code => title
         */
        public static function returnLast3byCategory($codeCategory)
        {
            $query = "SELECT WEB_PAGE.code, title, content, image, creation_date " .
                "FROM WEB_PAGE INNER JOIN CATEGORY ON WEB_PAGE.code_category = CATEGORY.code " .
                "WHERE code_category = {$codeCategory} ORDER BY last_modified DESC LIMIT 3";

            $dao = new DAO(Globals::HOST, Globals::USER, Globals::PASSWORD, Globals::DATABASE);
            $resultSet = $dao->query($query);

            $data = array(array());

            for ($i = 0; $row = $resultSet->fetch_assoc(); $i++) {

              $data[$i][0] = $row['code'];
              $data[$i][1] = $row['title'];
              $data[$i][2] = substr($row['content'], 0, 150);
              $data[$i][3] = $row['image'];
              $data[$i][4] = $row['creation_date'];
            }
            return $data;
        }

        /**
         * Method to return the last 4 publications
         * @return Array code => title
         */
        public static function returnLast4()
        {
            $query = "SELECT WEB_PAGE.code, title " .
                "FROM WEB_PAGE INNER JOIN CATEGORY ON WEB_PAGE.code_category = CATEGORY.code " .
                "WHERE CATEGORY.isActivity = 'y' AND WEB_PAGE.isActivity = 'y' ORDER BY last_modified DESC LIMIT 4";
            $dao = new DAO(Globals::HOST, Globals::USER, Globals::PASSWORD, Globals::DATABASE);
            $resultSet = $dao->query($query);

            $data = array();

            for ($i = 0; $row = $resultSet->fetch_assoc(); $i++) {
                $data[$row['code']] = $row['title'];
            }

            return $data;
        }

        /**
         * Method to return the last 5 publications with a category
         * @param int $codeCategory only positive numbers and contain the code of category
         * @return Array code => title
         */
        public static function returnLast5byCategory($codeCategory)
        {

            $query = "SELECT code, title FROM WEB_PAGE " .
                "WHERE code_category = {$codeCategory} AND isActivity = 'y' ORDER BY last_modified DESC LIMIT 5";

            $dao = new DAO(Globals::HOST, Globals::USER, Globals::PASSWORD, Globals::DATABASE);
            $resultSet = $dao->query($query);

            $data = array();

            for ($i = 0; $row = $resultSet->fetch_assoc(); $i++) {
                $data[$row['code']] = $row['title'];
            }

            return $data;
        }

        /**
         * Method to return all publications with a category
         * @param int $codeCategory only positive numbers and contain the code of category
         * @return Array index => publication object
         */
        public static function returnByCategory($codeCategory)
        {
            $query = "SELECT code, title,author,creation_date,last_modified,content, image,reference, isActivity FROM WEB_PAGE " .
                "WHERE code_category = {$codeCategory} ORDER BY last_modified DESC";

            $dao = new DAO(Globals::HOST, Globals::USER, Globals::PASSWORD, Globals::DATABASE);
            $resultSet = $dao->query($query);

            $data = array();

            for ($i = 0; $row = $resultSet->fetch_assoc(); $i++) {
                $data[$i] = new WebPage($row['title'], $row['author'], $codeCategory, $row['content'], $row['code'], $row['creation_date'], $row['last_modified'], $row['image'], $row['reference'], $row['isActivity']);
            }

            return $data;
        }
    }
}
