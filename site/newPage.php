<?php
    require_once realpath('.') . "/class/autoload.php";

    use \utilities\Session as Session;
    use \html\Page as Page;
    use \html\Menu as Menu;
    use \configuration\Globals as Globals;

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

    Page::header(Globals::ENTERPRISE_NAME);
?>
    <h1>Nova Página</h1>
    <form method="POST" action="controller/savePage.php">
        <label>Autor</label><br>
        <input type="text" id="author" name="author" required><br><br>
        <label>Categoria</label><br>
        <select name="category" id="select_update">
            <?php include 'controller/findCategory.php'; ?>
        </select><br><br>
        <label>Título</label><br>
        <input type="text" id="title" name="title" required><br><br>
        <textarea rows="20" cols="80" id="postage" name="postage"></textarea><br><br>
        <input type="submit" value="Salvar">
    </form>
<?php
    Page::footer();
    Page::closeBody();
?>
