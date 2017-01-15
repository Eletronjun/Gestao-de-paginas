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
        public function __construct($member_model)
        {
            parent::__construct(Globals::HOST, Globals::USER, Globals::PASSWORD, Globals::DATABASE);
            $this->setMemberModel($member_model);
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

        /**
         * Method to update member data
         * @param Member  $new_member     object member with the new data
         */
        public function update($new_member)
        {
            $query = "UPDATE MEMBERS SET 
                email = '{$new_member->getEmail()}',
                member_name = '{$new_member->getName()}', 
                nick = '{$new_member->getNick()}', 
                sex = '{$new_member->getSex()}', 
                registration = '{$new_member->getRegister()}', 
                birthdate = '{$new_member->getBirthdate()}',
                phone = '{$new_member->getPhone()}',
                rg = '{$new_member->getRg()}',
                cpf = '{$new_member->getCpf()}',
                course = '{$new_member->getCourse()}',
                period = '{$new_member->getPeriod()}',
                address = '{$new_member->getAddress()}',
                code_directorate = {$new_member->getDirectorate()},
                code_office = {$new_member->getOffice()},
                image = '{$new_member->getImage()}'";
            if ($new_member->getPassword() == null) {
                $query .= "password = '{$new_member->getPassword()}'";
            } else {
                //Nothing to do.
            }

            $query .= " WHERE email = '{$this->getMemberModel()->getEmail()}'";

            parent::query($query);
            $this->setMemberModel($new_member);
            parent::disconnect();
        }

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
        public static function findMember($email)
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
                course,
                period,
                address,
                password,
                image,
                code_directorate,
                code_office
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
                    $row['course'],
                    $row['period'],
                    $row['address'],
                    $row['code_directorate'],
                    $row['code_office'],
                    $row['password'],
                    $row['image']
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

        public function getMemberModel()
        {
            return $this->member_model;
        }
    }
}
