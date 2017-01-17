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
        const INVALID_DIRECTORATE = "Diretoria Inválida.";
        const INVALID_OFFICE = "Cargo Inválido.";

        /**
         * @param Member $member_model not null value
         */
        public function __construct($member_model)
        {
            parent::__construct(Globals::HOST, Globals::USER, Globals::PASSWORD, Globals::DATABASE);
            $this->setMemberModel($member_model);
        }

        /**
         * Method to update member data
         * @param Member  $new_member     object member with the new data
         */
        public function update($new_member)
        {
            $image = ($new_member->getImage() != $this->getMemberModel()->getImage()
                && $new_member->getImage() != "default.png") ?
                ",image = '{$new_member->getImage()}'"
                :
                "";
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
                code_office = {$new_member->getOffice()}
                {$image},
                password = '{$new_member->getPassword()}'
                WHERE email = '{$this->getMemberModel()->getEmail()}'";

            parent::query($query);
            $this->setMemberModel($new_member);
            parent::disconnect();
        }

        /**
         * Method to persist member data
         */
        public function register()
        {
            $query = "INSERT INTO eletronjun_db.MEMBERS 
            (email, registration, member_name, sex, nick, password, birthDate, rg, 
                cpf, phone, course, period, address, code_directorate, 
                code_office, image, isActivity) 
            VALUES
            (
             '{$this->getMemberModel()->getEmail()}',
             '{$this->getMemberModel()->getRegister()}',
             '{$this->getMemberModel()->getName()}',
             '{$this->getMemberModel()->getSex()}',
             '{$this->getMemberModel()->getNick()}',
             '{$this->getMemberModel()->getPassword()}',
             '{$this->getMemberModel()->getBirthdate()}',
             '{$this->getMemberModel()->getRg()}',
             '{$this->getMemberModel()->getCpf()}',
             '{$this->getMemberModel()->getPhone()}',
             '{$this->getMemberModel()->getCourse()}',
             '{$this->getMemberModel()->getPeriod()}',
             '{$this->getMemberModel()->getAddress()}',
             '{$this->getMemberModel()->getDirectorate()}',
             '{$this->getMemberModel()->getOffice()}',
             '{$this->getMemberModel()->getImage()}',
             'y');";

            parent::query($query);
            parent::disconnect();
        }

        /**
         * Metho to return all inactive registers
         * @return Member[] null, if not has inactive or a vector with Members object
         */
        public static function allMembers()
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
                FROM MEMBERS";
            $dao = new DAO(Globals::HOST, Globals::USER, Globals::PASSWORD, Globals::DATABASE);
            $resultSet = $dao->query($query);

            $member_model = null;

            for ($i = 0; $row = $resultSet->fetch_assoc(); $i++) {
                $member_model[$i] = new Member(
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
            }

            return $member_model;
        }


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

        public function remove()
        {
            $query = "DELETE FROM MEMBERS WHERE email = '{$this->getMemberModel()->getEmail()}'";

            parent::query($query);
        }

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

        public static function getMembersByOffice($code_office, $code_directorate)
        {

            if ($code_directorate != null) {
                if ($code_office != null) {
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
                    FROM MEMBERS WHERE code_directorate = '{$code_directorate}' and code_office = '{$code_office}' ORDER BY member_name";
                    $dao = new DAO(Globals::HOST, Globals::USER, Globals::PASSWORD, Globals::DATABASE);
                    $resultSet = $dao->query($query);

                    $data = array();

                    for ($i = 0; $row = $resultSet->fetch_assoc(); $i++) {
                        $member = new Member(
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
                        $data[$i] = $member;
                    }

                    return $data;
                } else {
                    throw new DatabaseException(self::INVALID_OFFICE);
                }
            } else {
                throw new DatabaseException(self::INVALID_DIRECTORATE);
            }
        }
    }
}
