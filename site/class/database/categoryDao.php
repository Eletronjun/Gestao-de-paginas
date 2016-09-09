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
            $query = "SELECT code, name FROM CATEGORY";
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
         * Method to persist category data
         */
        public function register()
        {
            $query = "INSERT INTO CATEGORY(name) VALUES('{$this->getCategoryModel()->getName()}')";

            parent::query($query);

            $category = new Category(
                $this->getCategoryModel()->getName(),
                parent::insertId()
            );

            $this->setCategoryModel($category);

            parent::disconnect();
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
