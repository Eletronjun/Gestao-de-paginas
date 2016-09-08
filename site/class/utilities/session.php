<?php
/**
 *Base class to persist data
 *
 *@package Utilities
 *@author  Vinicius Pinheiro <viny-pinheiro@hotmail.com>
 *@license MIT License
 *@link    http://eletronjun.com.br/class/utilities/session.php
 */

namespace utilities{

    include_once __DIR__ . "/../autoload.php";

    use \dao\DAO as DAO;
    use \configuration\Globals as Globals;
    use \exception\SessionException as SessionException;

    /**
     * @codeCoverageIgnore
     */
    class Session extends \dao\DAO
    {
        
        const INVALID_USER = 'Usuário inválido';
        const INVALID_PASSWORD = 'Senha inválida';
        const INATIVE_USER = 'Usuário ainda não ativo, contate a equipe de Gestão de Pessoas e Processos';

        /**
         * Method to initialize a session
         */
        public function __construct()
        {
            session_start();
        }
    
        /**
         * Method to destroy a session
         */
        public function disconnect()
        {
            $_SESSION["loggin"] == 0;
            session_destroy();
        }
    
        /**
         * Method to verify if the user has permission to access private area
         *  create a session cookie loggin, define 1 to loggin or 0 to loggout
         *
         * @param string $email    email to find im database
         * @param string $password password from email param in database
         */
        public function initSession($email, $password)
        {
            //Database select data
            parent::__construct(Globals::HOST, Globals::USER, Globals::PASSWORD, Globals::DATABASE);
            $query = "SELECT isActivity,password from MEMBERS WHERE email = '{$email}'";
            $result_set = parent::query($query);

            //Save result of consult
            $line_result = $result_set->fetch_assoc();

            //Close connection with database
            parent::disconnect();

            //Verify if consult found user
            if (count($line_result) != 0) {
                //Verify if password is correct
                if (crypt($password, $line_result['password']) == $line_result['password']) {
                    //Verify if member is activity
                    if ($line_result['isActivity'] == "y") {
                        $_SESSION["loggin"] = 1;
                        $_SESSION["email"] = $email;
                    } else {
                        $_SESSION["loggin"] = 0;
                        throw new SessionException(self::INATIVE_USER);
                    }
                } else {
                    throw new SessionException(self::INVALID_PASSWORD);
                }
            } else {
                $_SESSION["loggin"] = 0;
                throw new SessionException(self::INVALID_USER);
            }
        }
    
        /**
         * Method using in all private pages to verify if user can loader page
         */
        public function verifyIfSessionIsStarted()
        {
            if (isset($_SESSION["loggin"])) {
                if ($_SESSION["loggin"] == 0) {
                    $this->redirectMemberNoLogged();
                } else {
                    //Nothing to do
                }
            } else {
                $this->redirectMemberNoLogged();
            }
        }
    
        /**
         * method with the messenger if member no has permission to access the page
         */
        private function redirectMemberNoLogged()
        {
            echo "<script>alert('Faça Login');";
            echo "location.href =\"" .PROJECT_ROOT . "login.php\"</script>";
        }
    }
}
