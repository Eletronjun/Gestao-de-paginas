<?php
    //Globals
    require_once(__DIR__ . '/configuration/globals.php');

    //Dao
    require_once(__DIR__ . '/database/dao.php');
    
    //Html
    require_once(__DIR__ . '/html/page.php');
    require_once(__DIR__ . '/html/menu.php');
    
    //Utilities
    require_once(__DIR__ . '/utilities/session.php');
    
    //Exception
    require_once(__DIR__ . '/exception/pageException.php');
    require_once(__DIR__ . '/exception/sessionException.php');
    require_once(__DIR__ . '/exception/databaseException.php');
