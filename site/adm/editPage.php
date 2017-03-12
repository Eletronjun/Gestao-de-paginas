<?php
    require_once __DIR__ . "/../class/autoload.php";

    use \html\Page as Page;
    use \html\AdministratorMenu as AdministratorMenu;
    use \html\Forms as Forms;
    use \configuration\Globals as Globals;
    use \utilities\Session as Session;

    $session = new Session();
    $session->verifyIfSessionIsStarted();

    Page::startHeader("Editar Página");
    Page::styleSheet("user");
    Page::styleSheet("form");
    echo "<script src=\"../css/ckeditor/ckeditor.js\"></script>";
    Page::closeHeader();

    $menu = new AdministratorMenu();
    $menu->construct();
?>

<!--Conteúdo da página-->
<div id="update"></div>

  <main style="text-align: left;">

      <h1>Edição de Página </h1>
      <form action="<?php echo PROJECT_ROOT;?>controller/updatePage.php" method="POST" enctype="multipart/form-data">
        <fieldset>
            <?php Forms::updatePageForm($_GET['pages']); ?>
        </fieldset>
        <input type="hidden" value="<?php echo $_GET['pages']?>" id="page_code">
        <input type="submit" value="Atualizar">
      </form>

  </main>

<?php
    Page::footer();
    Page::closeBody();
?>
