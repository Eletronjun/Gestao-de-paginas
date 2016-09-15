<?php
    //Globals
    require_once __DIR__ . '/configuration/globals.php';

    //Dao
    require_once __DIR__ . '/database/dao.php';
    require_once __DIR__ . '/database/categoryDao.php';
    require_once __DIR__ . '/database/webPageDao.php';

    //Model
    require_once __DIR__ . '/model/category.php';
    require_once __DIR__ . '/model/webPage.php';
    
    //Html
    require_once __DIR__ . '/html/page.php';
    require_once __DIR__ . '/html/menu.php';
    
    //Utilities
    require_once __DIR__ . '/utilities/session.php';
    
    //Exception
    require_once __DIR__ . '/exception/pageException.php';
    require_once __DIR__ . '/exception/sessionException.php';
    require_once __DIR__ . '/exception/databaseException.php';
    require_once __DIR__ . '/exception/categoryException.php';
