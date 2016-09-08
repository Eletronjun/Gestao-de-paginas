<?php
/**
 *Class for processing framework with HTML standards.
 *
 *@package Model
 *@author  Vinicius Pinheiro <viny-pinheiro@hotmail.com>
 *@license MIT License
 *@link    http://eletronjun.com.br/class/model/category.php
 */
namespace model{

    include_once __DIR__ . "/../autoload.php";

    use \configuration\Globals as Globals;
    use \exception\CategoryException as CategoryException;

    class Category
    {
        
        /* Class attributes */
        private $name; //name of category, not null value
        private $id; //category code, only numbers or null if not exists in database

        /* Exception messengers */
        const NULL_NAME = "Nome não pode ser nulo.";
        const NAME_LARGER = "Nome não pode ter mais que 50 caracteres.";
        const NO_NUMERIC_ID = "Id deve ser um número.";

        /**
         * Method to create a category instance
         *
         * @param string $name name of category, not null value
         * @param string $id   category code, only numbers or null if not exists in database
         */
        public function __construct($name, $id = null)
        {
            $this->setName($name);
            $this->setId($id);
        }

        private function setName($name)
        {
            $name = trim($name);

            if ($name != null) {
                if (strlen($name) <= 50) {
                    $this->name = $name;
                } else {
                    throw new CategoryException(self::NAME_LARGER);
                }
            } else {
                throw new CategoryException(self::NULL_NAME);
            }
        }

        public function getName()
        {
            return $this->name;
        }

        private function setId($id)
        {
            if (is_null($id)) {
                $this->id = $id;
            } else {
                if (is_numeric($id)) {
                    $this->id = $id;
                } else {
                    throw new CategoryException(self::NO_NUMERIC_ID);
                }
            }
        }

        public function getId()
        {
            return $this->id;
        }
    }
}
