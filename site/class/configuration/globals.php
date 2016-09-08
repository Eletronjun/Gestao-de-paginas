<?php
/**
 *Class with the all global configuration
 *
 *@package Configuration
 *@author  Vinicius Pinheiro <viny-pinheiro@hotmail.com>
 *@license MIT License
 *@link    http://eletronjun.com.br/class/configuration/globals.php
 */
namespace configuration{

    //Defining the path of constant
    define("IMG_PATCH", "http://" . $_SERVER['HTTP_HOST'] . "/site/res/img/");
    define("PROJECT_ROOT", "http://" . $_SERVER['HTTP_HOST'] . "/site/");

    class Globals
    {
        //Constants to connect to database
        const HOST = '127.0.0.1';
        const USER = 'tp';
        const PASSWORD = '1234';
        const DATABASE = 'eletronjun_db';
    
        //Helper constants
        const ENTERPRISE_NAME = "Eletronjun - Empresa J&uacute;nior de Engenharia Eletr&ocirc;nica";

        //Const with hash to data security
        const SECURITY_HASH = '$2a$05$JD2WU824jsfhs23hu233DK$';
    }
}
