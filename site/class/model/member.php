<?php
/**
 *Class with the model contain data from members
 *
 *@package Model
 *@author  Vinicius Pinheiro <viny-pinheiro@hotmail.com>
 *@license MIT License
 *@link    http://eletronjun.com.br/class/model/member.php
 */
namespace model{

    include_once __DIR__ . "/../autoload.php";

    use \configuration\Globals as Globals;
    use \exception\MemberException as MemberException;

    class Member
    {
        //Constants
        public static $DIRECTORATE = array('Marketing','Administrativo/Financeiro',
                    'Gestão de Pessoas e Processos', 'Projeto', 'Presidencia');
        public static $OFFICE = array("Diretor", "Gerente", "Presidente", "Acessor");
        public static $SEX = array('F' => 'Feminino', 'M' =>'Masculino');

        //Attributes
        private $email;         //primary indentifier for a member. Not null value
        private $registration;  //secundary indentifier for a member. Not null value and mask XX/XXXXXXX
        private $name;          //full name of member, not null value
        private $sex;           //Only F to Female or M to Male
        private $nick;          //Visual name. Not null value
        private $password;      //password to access data
        private $birthdate;     //birthdate of member. Mask mm-dd-yyyy or dd/mm/yyyy
        private $rg;            //Receive null or rg number
        private $rg_agency;     //emissor and state
        private $cpf;           //cpf number. valid verificaton number and receive only numbers
        private $phone;         //contact number
        private $isActivity;    //Only y to active or n to inative
        private $image;         //image name
        private $address;       //Object Address only
        private $directorate;   //ENUM directorate only
        private $office;        //ENUM office only

        //Exceptions messenger
        const INVALID_EMAIL = "Email ou esta nulo ou é invalido.";
        const INVALID_NAME = "Nome não pode ser nulo/vazio.";
        const INVALID_NICK = "Nick não pode ser nulo/vazio.";
        const INVALID_SEX = "Sexo inválido.";
        const NULL_REGISTER = "Matr&iacute;cula vazia!";
        const INVALID_REGISTER = "Matr&iacute;cula invalida.";
        const DATE_FORMAT = "Formato da data inv&aacute;lido.";
        const INVALID_DATE = "Data inv&aacute;lida.";
        const NULL_DATE = "Data não pode ser nula.";
        const INVALID_PHONE = "Telefone invalido.";
        const NULL_PHONE = "Telefone vazio!";

        /**
         * @param string $email         primary indentifier for a member. Not null value
         * @param string $name          full name of member, not null value
         * @param string $nick          Visual name. Not null value
         * @param string $sex           Only F to Female or M to Male
         * @param string $registration  secundary indentifier for a member. Not null value and mask XX/XXXXXXX
         * @param string $birthdate     birthdate of member. Mask mm-dd-yyyy or dd/mm/yyyy
         * @param string $phone         contact number
         */
        public function __construct($email, $name, $nick, $sex, $registration, $birthdate, $phone)
        {
            $this->setEmail($email);
            $this->setName($name);
            $this->setNick($nick);
            $this->setSex($sex);
            $this->setRegister($registration);
            $this->setBirthdate($birthdate);
            $this->setPhone($phone);
        }

        private function setEmail($email)
        {
            if (filter_var($email, FILTER_VALIDATE_EMAIL) && $email != null) {
                $this->email = $email;
            } else {
                throw new MemberException(self::INVALID_EMAIL);
            }
        }
        public function getEmail()
        {
            return $this->email;
        }

        private function setName($name)
        {
            if ($name != null) {
                $this->name = $name;
            } else {
                throw new MemberException(self::INVALID_NAME);
            }
        }
        public function getName()
        {
            return $this->name;
        }

        private function setNick($nick)
        {
            if ($nick != null) {
                $this->nick = $nick;
            } else {
                throw new MemberException(self::INVALID_NICK);
            }
        }
        public function getNick()
        {
            return $this->nick;
        }

        private function setSex($sex)
        {
            if (isset(Member::$SEX[strtoupper($sex)])) {
                $this->sex = strtoupper($sex);
            } else {
                throw new MemberException(self::INVALID_SEX);
            }
        }
        public function getSex()
        {
            return $this->sex;
        }

        private function setRegister($register)
        {
            if ($register != null) {
                if (preg_match("/^[0-1][0-9]\/0[0-9]{6}$/", $register)) {
                    $this->register = $register;
                } else {
                    throw new MemberException(self::INVALID_REGISTER);
                }
            } else {
                throw new MemberException(self::NULL_REGISTER);
            }
        }
        
        public function getRegister()
        {
            return $this->register;
        }
        private function setBirthdate($birthdate)
        {
            if ($birthdate != null && $birthdate != "") {
                //Verify if the format date respect dd/mm/yyyy
                if (preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1])\/(0[1-9]|1[0-2])\/[1-2][0-9]{3}$/", $birthdate)) {
                    // Split date in {year, month, day}
                    $date_parts = explode('/', $birthdate);
                    
                    //Verify if date is valid
                    if (checkdate($date_parts[1], $date_parts[0], $date_parts[2])) {
                        $this->birthdate = $date_parts[2] . "-" . $date_parts[1] . "-" . $date_parts[0];
                    } else {
                        throw new MemberException(self::INVALID_DATE);
                    }
                } else {
                    //Verify if the format date respect mm-dd-yyyy
                    if (preg_match("/^[1-2][0-9]{3}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $birthdate)) {
                        // Split date in {year, month, day}
                        $date_parts = explode('-', $birthdate);
                        
                        //Verify if date is valid
                        if (checkdate($date_parts[1], $date_parts[2], $date_parts[0])) {
                            $this->birthdate = $birthdate;
                        } else {
                            throw new MemberException(self::INVALID_DATE);
                        }
                    } else {
                        throw new MemberException(self::DATE_FORMAT);
                    }
                }
            } else {
                throw new MemberException(self::NULL_DATE);
            }
        }
        
        public function getBirthdate()
        {
            return $this->birthdate;
        }

        private function setPhone($phone)
        {
            if ($phone != null) {
                if (preg_match("/^\([1-9]{2}\)( |)[2-9][0-9]{4,5}(\-|)[0-9]{4}$/", $phone)) {
                    $this->phone = $phone;
                } else {
                    throw new MemberException(self::INVALID_PHONE);
                }
            } else {
                throw new MemberException(self::NULL_PHONE);
            }
        }
        
        public function getPhone()
        {
            return $this->phone;
        }
    }
}
