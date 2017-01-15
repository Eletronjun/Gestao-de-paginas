<?php
    require_once __DIR__ . "/../class/autoload.php";

    use \html\Page as Page;
    use \html\AdministratorMenu as AdministratorMenu;
    use \html\FindCategories as FindCategories;
    use \configuration\Globals as Globals;
    use \utilities\Session as Session;

    $session = new Session();
    $session->verifyIfSessionIsStarted();

    Page::startHeader("Solicitações Pendentes");
    Page::styleSheet("user");
    Page::styleSheet("form");
    Page::closeHeader();

    $menu = new AdministratorMenu();
    $menu->construct();
?>

<!--Conteúdo da página-->
<main>
</main>
<?php
    Page::footer();
    Page::closeBody();
?>
