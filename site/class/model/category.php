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
        private $is_activity; //'y' or 'n' to register if category is visible

        /* Exception messengers */
        const NULL_NAME = "Nome não pode ser nulo.";
        const NAME_LARGER = "Nome não pode ter mais que 100 caracteres.";
        const NO_NUMERIC_ID = "Id deve ser um número.";
        const INVALID_ACTIVITY = "A category só pode ser Ativa ou Não Ativa";

        /**
         * Method to create a category instance
         *
<<<<<<< HEAD
         * @param string $name name of category, not null value
         * @param int $id   category code, only numbers or null if not exists in database
=======
         * @param string $name          name of category, not null value
         * @param int    $id            category code, only numbers or null if not exists in database
         * @param string $is_activity   'y' or 'n' to register if category is visible, default is 'y'
>>>>>>> 97ca47da03ea07c9bfa374c22a7e51418bd6e95d
         */
        public function __construct($name, $id = null, $is_activity = "y")
        {
            $this->setName($name);
            $this->setId($id);
            $this->setIsActivity($is_activity);
        }

        private function setName($name)
        {
            $name = trim($name);

            if ($name != null) {
                if (strlen($name) <= 100) {
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

        private function setIsActivity($is_activity)
        {
            if ($is_activity == 'n' || $is_activity == 'y') {
                $this->is_activity = $is_activity;
            } else {
                    throw new CategoryException(self::INVALID_ACTIVITY); // @codeCoverageIgnore
            }
        }

        public function getIsActivity()
        {
            return $this->is_activity;
        }
    }
}
