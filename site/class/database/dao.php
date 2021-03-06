<?php
/**
 *Base class to persist data
 *
 *@package Dao
 *@author  Vinicius Pinheiro <viny-pinheiro@hotmail.com>
 *@license MIT License
 *@link    http://eletronjun.com.br/class/database/dao.php
 */

namespace dao{

    include_once __DIR__ . "/../autoload.php";

    use \exception\DatabaseException as DatabaseException;

    class DAO
    {
        /* Class attributes */
        private $host;
        private $user;
        private $password;
        private $database;
        private $connection;
    
        /* Exception messengers */
    
        const WRONG_QUERY = "Query não foi compilada com sucesso.";
        const CONNECTION_FAILED = "Falha na conexão.";
        const INVALID_HOST = "Host inválido.";
        const NULL_HOST = "Host não pode ser vazio ou nulo.";
        const NULL_USER = "User não pode ser vazio ou nulo.";
        const NULL_DATABASE = "Database não pode ser vazio ou nulo.";
    
        /**
         * Sets necessary attributes to dao class
         *
         * @param $host string with not null value and the host of database
         * @param $user string with not null value and the user of database server
         * @param $passwoord string with not null value and the user password's
         * @param $database string with not null value and the name of schema in database server
         */
        protected function __construct($host, $user, $password, $database)
        {
            $this->setHost($host);
            $this->setUser($user);
            $this->setPassword($password);
            $this->setDatabase($database);
        }
    
        /**
         * Method to open and execute a new query in database
         *
         * @param  $query DML, DTL or DQL for database
         * @return resultset for the query
         */
        protected function query($query)
        {
            $this->connection();
        
            $resultset = $this->connection->query($query, MYSQLI_USE_RESULT);
        
            if ($resultset) {
                return $resultset;
            } else {
                throw new DatabaseException(self::WRONG_QUERY . $this->connection->error);
            }
        }
    
        /**
         * Mehod to close connection with database server
         */
        protected function disconnect()
        {
        
            $this->connection->close();
        }
    
        /**
         * Method to return the inserted id by auto_increment, return 0 if
         *   not used an insert on table with auto_increment
         */
        protected function insertId()
        {
            return $this->connection->insert_id;
        }
    
        /**
         * Method to try open a new connection
         */
        protected function connection()
        {
            $this->connection = new \mysqli($this->host, $this->user, $this->password, $this->database);
            $this->connection->set_charset("utf8");
        }

        private function setHost($host)
        {
            if ($host != null && $host != "") {
                if (filter_var($host, FILTER_VALIDATE_URL) || filter_var($host, FILTER_VALIDATE_IP)) {
                    $this->host = $host;
                } else {
                    throw new DatabaseException(self::INVALID_HOST);
                }
            } else {
                throw new DatabaseException(self::NULL_HOST);
            }
        }

        private function setUser($user)
        {
            if ($user != null && $user != "") {
                $this->user = $user;
            } else {
                throw new DatabaseException(self::NULL_USER);
            }
        }
    
        private function setDatabase($database)
        {
            if ($database != null && $database != "") {
                $this->database = $database;
            } else {
                throw new DatabaseException(self::NULL_DATABASE);
            }
        }

        private function setPassword($password)
        {
            $this->password = $password;
        }
    }
}
