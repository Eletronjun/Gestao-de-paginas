<?php
    require_once __DIR__ . "/class/autoload.php";

    use \utilities\Session as Session;
    use \html\Page as Page;
    use \html\Menu as Menu;
    use \configuration\Globals as Globals;

    Page::header(Globals::ENTERPRISE_NAME);

    $session = new Session();
    $session->verifyIfSessionIsStarted();

    Menu::startMenu();
        Menu::startItem();
        Menu::addItem(PROJECT_ROOT . "#", "Páginas");
            Menu::initSubItem();
                Menu::addItem(PROJECT_ROOT . "category.php", "Edição de Categoria");
                Menu::addItem(PROJECT_ROOT . "newPage.php", "Nova Página");
            Menu::endSubItem();
        Menu::endItem();
    Menu::endMenu();
?>

<h1>Home Page</h1>

<?php
    Page::footer();
    Page::closeBody();
?>
