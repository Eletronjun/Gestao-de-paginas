<?php
    require_once __DIR__ . "/../class/autoload.php";

    use \utilities\Session as Session;
    use \html\Page as Page;
    use \html\FindCategories as FindCategories;
    use \html\AdministratorMenu as AdministratorMenu;
    use \configuration\Globals as Globals;
    
    Page::header(Globals::ENTERPRISE_NAME);

    $session = new Session();
    $session->verifyIfSessionIsStarted();
    
    $menu = new AdministratorMenu();
    $menu->construct();

?>
    <h1>Nova Página</h1>
    <form method="POST" action="<?php echo PROJECT_ROOT; ?>controller/savePage.php" enctype="multipart/form-data">
        <label>Autor</label><br>
        <input type="text" id="author" name="author" required><br><br>
        <label>Categoria</label><br>
        <select name="category" id="select_update">
            <?php FindCategories::getOptions(); ?>
        </select><br><br>
        <label>Título</label><br>
        <input type="text" id="title" name="title" required><br><br>
        <textarea rows="20" cols="80" id="postage" name="postage"></textarea><br><br>

        <input type="file" name="imageFile" />
        <input type="submit" value="Salvar">
    </form>
<?php
    Page::footer();
    Page::closeBody();
?>
