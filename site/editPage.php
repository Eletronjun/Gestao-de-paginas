<?php

    require_once __DIR__ . "/class/autoload.php";

    use \html\Page as Page;
    use \html\Menu as Menu;
    use \configuration\Globals as Globals;
    use \utilities\Session as Session;

    $session = new Session();
    $session->verifyIfSessionIsStarted();

    Page::header(Globals::ENTERPRISE_NAME);

    Menu::startMenu();
        Menu::startItem();
        Menu::addItem(PROJECT_ROOT . "#", "Páginas");
            Menu::initSubItem();
                Menu::addItem(PROJECT_ROOT . "category.php", "Gerenciar de Categoria");
                Menu::addItem(PROJECT_ROOT . "newPage.php", "Nova Página");
                Menu::addItem(PROJECT_ROOT . "pages.php", "Gerenciar Páginas");
            Menu::endSubItem();
        Menu::endItem();
    Menu::endMenu();
?>

<!--Conteúdo da página-->
<div id="update"></div>
<div id="content" style="text-align: left;">
    <article>

        <h1>Edição de Página </h1>
        <?php
          echo "class/utilities/formPage.php?code={$_GET['pages']}" . "<br>";
        ?>
        <form action="controller/updatePage.php" method="POST">
          <?php required_once("class/utilities/formPage.php?code={$_GET['pages']}");?>
          <input type="submit" value="Atualizar">
        </form>

    </article>
</div>
<?php
    Page::footer();
    Page::closeBody();
?>
