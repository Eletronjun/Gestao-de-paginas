<?php
    require_once __DIR__ . "/../class/autoload.php";

    use \html\Page as Page;
    use \html\AdministratorMenu as AdministratorMenu;
    use \html\Forms as Forms;
    use \configuration\Globals as Globals;
    use \utilities\Session as Session;

    Page::header(Globals::ENTERPRISE_NAME);

    $session = new Session();
    $session->verifyIfSessionIsStarted();
    
    $menu = new AdministratorMenu();
    $menu->construct();
?>

<!--Conteúdo da página-->
<div id="update"></div>
<div id="content" style="text-align: left;">
    <article>

        <h1>Edição de Página </h1>
        <form action="<?php echo PROJECT_ROOT;?>controller/updatePage.php" method="POST" enctype="multipart/form-data">
            <?php Forms::updatePageForm($_GET['pages']); ?>
          <input type="submit" value="Atualizar">
        </form>

    </article>
</div>
<?php
    Page::footer();
    Page::closeBody();
?>
