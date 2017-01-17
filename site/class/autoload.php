<?php
    //Globals
    require_once __DIR__ . '/configuration/globals.php';

    //Dao
    require_once __DIR__ . '/database/dao.php';
    require_once __DIR__ . '/database/categoryDao.php';
    require_once __DIR__ . '/database/webPageDao.php';
    require_once __DIR__ . '/database/memberDao.php';

    //Model
    require_once __DIR__ . '/model/category.php';
    require_once __DIR__ . '/model/webPage.php';
    require_once __DIR__ . '/model/member.php';

    //Html
    require_once __DIR__ . '/html/page.php';
    require_once __DIR__ . '/html/menu.php';
    require_once __DIR__ . '/html/administratorMenu.php';
    require_once __DIR__ . '/html/communityMenu.php';
    require_once __DIR__ . '/html/findCategory.php';
    require_once __DIR__ . '/html/findPage.php';
    require_once __DIR__ . '/html/forms.php';

    //Utilities
    require_once __DIR__ . '/utilities/session.php';
    require_once __DIR__ . '/utilities/date.php';
    require_once __DIR__ . '/utilities/memberContact.php';

    //Exception
    require_once __DIR__ . '/exception/pageException.php';
    require_once __DIR__ . '/exception/webPageException.php';
    require_once __DIR__ . '/exception/sessionException.php';
    require_once __DIR__ . '/exception/databaseException.php';
    require_once __DIR__ . '/exception/categoryException.php';
    require_once __DIR__ . '/exception/memberException.php';
