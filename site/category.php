<?php
    require_once(__DIR__ . "/class/autoload.php");
    
    use \html\Page as Page;
    use \html\Menu as Menu;
    use \configuration\Globals as Globals;

    Page::header(Globals::ENTERPRISE_NAME);
    
    Menu::startMenu();
        Menu::startItem();
        Menu::addItem(PROJECT_ROOT . "#", "Páginas");
            Menu::initSubItem();
                Menu::addItem(PROJECT_ROOT . "category.php", "Edição de Categoria");
            Menu::endSubItem();
        Menu::endItem();
    Menu::endMenu();
?>

<h1>Edição de Categoria</h1>

<?php
    Page::footer();
    Page::closeBody();
?>