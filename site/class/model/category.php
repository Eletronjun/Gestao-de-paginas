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
        private $layout; //"publication", "short_publication", "video" or "form" to define default layout
        private $description; //Description of category

        /* Exception messengers */
        const NULL_NAME = "Nome não pode ser nulo.";
        const NAME_LARGER = "Nome não pode ter mais que 100 caracteres.";
        const NULL_DESCRIPTION = "Descrição não pode ser nulo.";
        const DESCRIPTION_LARGER = "Descrição não pode ter mais que 500 caracteres.";
        const NO_NUMERIC_ID = "Id deve ser um número.";
        const INVALID_ACTIVITY = "A categoria só pode ser Ativa ou Não Ativa";
        const INVALID_LAYOUT = "Layout padrão inválido para a categoria";

        /**
         * Method to create a category instance
         *
         * @param string    $name          name of category, not null value
         * @param string    $description   description of category
         * @param int       $id            category code, only numbers or null if not exists in database
         * @param string    $is_activity   'y' or 'n' to register if category is visible, default is 'y'
         */


        public function __construct($name, $description, $id = null, $is_activity = "y", $layout = "publication")
        {
            $this->setName($name);
            $this->setId($id);
            $this->setDescription($description);
            $this->setIsActivity($is_activity);
            $this->setLayout($layout);
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

        private function setDescription($description)
        {
            $description = trim($description);

            if ($description != null) {
                if (strlen($description) <= 500) {
                    $this->description = $description;
                } else {
                    throw new CategoryException(self::DESCRIPTION_LARGER);
                }
            } else {
                throw new CategoryException(self::NULL_DESCRIPTION);
            }
        }

        public function getDescription()
        {
            return $this->description;
        }

        private function setLayout($layout)
        {
            $layout = trim($layout);

            if ($layout != null) {
                if ($layout == "publication" || $layout == "short_publication" || $layout == "video" || $layout == "form") {
                    $this->layout = $layout;
                } else {
                    throw new CategoryException(self::INVALID_LAYOUT);
                }
            } else {
                throw new CategoryException(self::INVALID_LAYOUT);
            }
        }

        public function getLayout()
        {
            return $this->layout;
        }

        public function validateName($name)
        {
            $name = trim($name);

            if ($name != null) {
                if (strlen($name) <= 100) {
                    //Nothing do
                } else {
                    throw new CategoryException(self::NAME_LARGER);
                }
            } else {
                throw new CategoryException(self::NULL_NAME);
            }
        }

        public function validateLayout($layout)
        {
            $layout = trim($layout);

            if ($layout != null) {
                if ($layout == "publication" || $layout == "short_publication" || $layout == "video" || $layout == "form") {
                    //Nothing do
                } else {
                    throw new CategoryException(self::INVALID_LAYOUT);
                }
            } else {
                throw new CategoryException(self::INVALID_LAYOUT);
            }
        }
    }
}
