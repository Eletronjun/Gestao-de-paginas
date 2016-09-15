<?php
    require_once realpath('.') . "/class/autoload.php";
    use \html\Page as Page;
    use \configuration\Globals as Globals;

    Page::header(Globals::ENTERPRISE_NAME);
?>
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