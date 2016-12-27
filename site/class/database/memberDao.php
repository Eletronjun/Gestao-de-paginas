<?php
/**
 *Base class to persist data
 *
 *@package Dao
 *@author  Vinicius Pinheiro <viny-pinheiro@hotmail.com>
 *@license MIT License
 *@link    http://eletronjun.com.br/class/database/memberDAO.php
 */

namespace dao{

    include_once __DIR__ . "/../autoload.php";

    use \configuration\Globals as Globals;
    use \exception\DatabaseException as DatabaseException;
    use \model\Member as Member;

    class MemberDAO extends DAO
    {
        /* Class attributes */
        private $member_model;

        /* Exception constants */
        const INVALID_MODEL = "Modelo Inválida.";
        const MEMBER_MODEL_ISNT_OBJECT = "Objeto de Membro Inválido.";
        const NOT_EXISTS_MEMBER = "Membro não encontrado.";

        /**
         * @param Category $categoryModel not null value
         */
        public function __construct($category_model)
        {
            parent::__construct(Globals::HOST, Globals::USER, Globals::PASSWORD, Globals::DATABASE);
            $this->setCategoryModel($category_model);
        }

        // public static function getCategories()
        // {
        //     $query = "SELECT code, name, isActivity, description, layout FROM CATEGORY";

        //     $dao = new DAO(Globals::HOST, Globals::USER, Globals::PASSWORD, Globals::DATABASE);

        //     $resultSet = $dao->query($query);

        //     $data = array();

        //     for ($i = 0; $row = $resultSet->fetch_assoc(); $i++) {
        //         $data[$i][0] = $row['code'];
        //         $data[$i][1] = $row['name'];
        //         $data[$i][2] = $row['isActivity'];
        //         $data[$i][3] = $row['layout'];
        //         $data[$i][4] = $row['description'];
        //     }

        //     return $data;
        // }

        // /**
        //  * Method to update data
        //  * @param String  $new_name
        //  */
        // public function update($new_name, $new_layout)
        // {
        //     if (!is_null($this->getCategoryModel()->getId())) {
        //         $query = "UPDATE CATEGORY SET name = '{$new_name}', layout = '{$new_layout}' WHERE code = " . $this->getCategoryModel()->getId();

        //         parent::query($query);

        //         $category = new Category(
        //             $new_name,
        //             $this->getCategoryModel()->getId()
        //         );
        //     } else {
        //         throw new DatabaseException(self::NOT_UPDATE_CATEGORY);
        //     }
        // }

        // /**
        //  * Method to persist category data
        //  */
        // public function register()
        // {
        //     $query = "INSERT INTO CATEGORY(name,description,layout) VALUES('
        //     {$this->getCategoryModel()->getName()}','{$this->getCategoryModel()->getDescription()}',
        //     '{$this->getCategoryModel()->getLayout()}')";

        //     parent::query($query);

        //     $category = new Category(
        //         $this->getCategoryModel()->getName(),
        //         $this->getCategoryModel()->getDescription(),
        //         parent::insertId()
        //     );

        //     $this->setCategoryModel($category);

        //     parent::disconnect();
        // }

        // /**
        //  * Method to update in database activity
        //  * @param int   $isEnable   0 to disable or 1 to enable
        //  */
        // public function updateActivity($isEnable)
        // {
        //     $is_activity = ($isEnable == 1) ? 'y' : 'n';
        //     $id = $this->getCategoryModel()->getId();

        //     $query = "UPDATE CATEGORY SET isActivity = '{$is_activity}' WHERE code = " . $id;

        //     parent::query($query);

        //     $category = new Category(
        //         $this->getCategoryModel()->getName(),
        //         $this->getCategoryModel()->getId(),
        //         $is_activity
        //     );

        //     $this->setCategoryModel($category);

        //     parent::disconnect();
        // }

        // /**
        //  * Method to find and return only active categories
        //  * @return array code of category => name of category
        // */
        // public static function returnActiveCategories()
        // {

        //     $query = "SELECT code, name FROM CATEGORY WHERE isActivity = 'y'";
        //     $dao = new DAO(Globals::HOST, Globals::USER, Globals::PASSWORD, Globals::DATABASE);

        //     $resultSet = $dao->query($query);

        //     $data = array();

        //     for ($i = 0; $row = $resultSet->fetch_assoc(); $i++) {
        //         $data[$row['code']] = $row['name'];
        //     }

        //     return $data;
        // }

        /**
         * Method to find a member using his email
         * @param   string     $email   only string
         * @return  Member     member model data
         */
        public static function findCategory($email)
        {
            $query = "SELECT email,
                member_name, 
                nick, 
                sex, 
                registration, 
                birthdate,
                phone,
                rg,
                cpf,
                course 
                FROM MEMBERS WHERE email = '{$email}'";
            $dao = new DAO(Globals::HOST, Globals::USER, Globals::PASSWORD, Globals::DATABASE);
            $resultSet = $dao->query($query);

            $member_model = null;

            if ($row = $resultSet->fetch_assoc()) {
                $member_model = new Member(
                    $row['email'],
                    $row['member_name'],
                    $row['nick'],
                    $row['sex'],
                    $row['registration'],
                    $row['birthdate'],
                    $row['phone'],
                    $row['rg'],
                    $row['cpf'],
                    $row['course']
                );
            } else {
                throw new DatabaseException(self::NOT_EXISTS_MEMBER);
            }

            return $member_model;
        }

        // public function remove()
        // {
        //     $query = "DELETE FROM CATEGORY WHERE code = {$this->getCategoryModel()->getId()}";

        //     parent::query($query);
        // }

        public function setMemberModel($member_model)
        {
            if (is_object($member_model)) {
                if (get_class($member_model) == "model\Member") {
                    $this->member_model = $member_model;
                } else {
                    throw new DatabaseException(self::INVALID_MODEL);
                }
            } else {
                throw new DatabaseException(self::MEMBER_MODEL_ISNT_OBJECT);
            }
        }

        public function getCategoryModel()
        {
            return $this->category_model;
        }
    }
}
