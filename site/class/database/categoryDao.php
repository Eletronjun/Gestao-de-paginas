<?php
/**
 *Base class to persist data
 *
 *@package Dao
 *@author  Vinicius Pinheiro <viny-pinheiro@hotmail.com>
 *@license MIT License
 *@link    http://eletronjun.com.br/class/database/categoryDAO.php
 */

namespace dao{

    include_once __DIR__ . "/../autoload.php";

    use \configuration\Globals as Globals;
    use \exception\DatabaseException as DatabaseException;
    use \model\Category as Category;

    class CategoryDAO extends DAO
    {
        /* Class attributes */
        private $category_model;

        /* Exception constants */
        const INVALID_MODEL = "Modelo Inválida.";
        const CATEGORY_MODEL_ISNT_OBJECT = "Objeto de Categoria Inválido.";
        const NOT_UPDATE_CATEGORY = "Não é possivel atualizar categoria pois não há código.";
        const NOT_EXISTS_CATEGORY = "Categoria não encontrada.";

        /**
         * @param Category $categoryModel not null value
         */
        public function __construct($category_model)
        {
            parent::__construct(Globals::HOST, Globals::USER, Globals::PASSWORD, Globals::DATABASE);
            $this->setCategoryModel($category_model);
        }

        public static function getCategories()
        {
            $query = "SELECT code, name, isActivity, description, layout FROM CATEGORY";

            $dao = new DAO(Globals::HOST, Globals::USER, Globals::PASSWORD, Globals::DATABASE);

            $resultSet = $dao->query($query);

            $data = array();

            for ($i = 0; $row = $resultSet->fetch_assoc(); $i++) {
                $data[$i][0] = $row['code'];
                $data[$i][1] = $row['name'];
                $data[$i][2] = $row['isActivity'];
                $data[$i][3] = $row['layout'];
                $data[$i][4] = $row['description'];
            }

            return $data;
        }

        /**
         * Method to update data
         * @param String  $new_name
         */
        public function update($new_name, $new_layout, $new_description)
        {
            if (!is_null($this->getCategoryModel()->getId())) {
                $query = "UPDATE CATEGORY SET name = '{$new_name}', layout = '{$new_layout}', description = '{$new_description}' WHERE code = " . $this->getCategoryModel()->getId();

                parent::query($query);

                $category = new Category(
                    $new_name,
                    $this->getCategoryModel()->getId()
                );
            } else {
                throw new DatabaseException(self::NOT_UPDATE_CATEGORY);
            }
        }

        /**
         * Method to persist category data
         */
        public function register()
        {
            $query = "INSERT INTO CATEGORY(name,description,layout) VALUES('
            {$this->getCategoryModel()->getName()}','{$this->getCategoryModel()->getDescription()}',
            '{$this->getCategoryModel()->getLayout()}')";

            parent::query($query);

            $category = new Category(
                $this->getCategoryModel()->getName(),
                $this->getCategoryModel()->getDescription(),
                parent::insertId()
            );

            $this->setCategoryModel($category);

            parent::disconnect();
        }

        /**
         * Method to update in database activity
         * @param int   $isEnable   0 to disable or 1 to enable
         */
        public function updateActivity($isEnable)
        {
            $is_activity = ($isEnable == 1) ? 'y' : 'n';
            $id = $this->getCategoryModel()->getId();

            $query = "UPDATE CATEGORY SET isActivity = '{$is_activity}' WHERE code = " . $id;
            parent::query($query);

            $category = new Category(
                $this->getCategoryModel()->getName(),
                $this->getCategoryModel()->getDescription(),
                $this->getCategoryModel()->getId(),
                $is_activity
            );

            $this->setCategoryModel($category);

            parent::disconnect();
        }

        /**
         * Method to find and return only active categories
         * @return array code of category => name of category
        */
        public static function returnActiveCategories()
        {

            $query = "SELECT code, name FROM CATEGORY WHERE isActivity = 'y'";
            $dao = new DAO(Globals::HOST, Globals::USER, Globals::PASSWORD, Globals::DATABASE);

            $resultSet = $dao->query($query);

            $data = array();

            for ($i = 0; $row = $resultSet->fetch_assoc(); $i++) {
                $data[$row['code']] = $row['name'];
            }

            return $data;
        }

        /**
         * Method to find a category using his code
         * @param   int     $code   only number values
         * @return  Category        category data
         */
        public static function findCategory($code)
        {
            $query = "SELECT code, name, description, isActivity,layout FROM CATEGORY WHERE code = {$code}";
            $dao = new DAO(Globals::HOST, Globals::USER, Globals::PASSWORD, Globals::DATABASE);

            $resultSet = $dao->query($query);

            $category = null;

            if ($row = $resultSet->fetch_assoc()) {
                $category = new Category(
                    $row['name'],
                    $row['description'],
                    $row['code'],
                    $row['isActivity'],
                    $row['layout']
                );
            } else {
                throw new DatabaseException(self::NOT_EXISTS_CATEGORY);
            }

            return $category;
        }

        public function remove()
        {
            $query = "DELETE FROM CATEGORY WHERE code = {$this->getCategoryModel()->getId()}";

            parent::query($query);
        }

        public function setCategoryModel($category_model)
        {
            if (is_object($category_model)) {
                if (get_class($category_model) == "model\Category") {
                    $this->category_model = $category_model;
                } else {
                    throw new DatabaseException(self::INVALID_MODEL);
                }
            } else {
                throw new DatabaseException(self::CATEGORY_MODEL_ISNT_OBJECT);
            }
        }

        public function getCategoryModel()
        {
            return $this->category_model;
        }
    }
}
