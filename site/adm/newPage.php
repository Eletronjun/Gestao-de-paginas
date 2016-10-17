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
  <div id="content">
    <h1>Nova Página</h1>
    <form method="POST" action="<?php echo PROJECT_ROOT; ?>controller/savePage.php" enctype="multipart/form-data">
        <fieldset>
          <label>Categoria</label><br>
          <select name="category" id="select_update">
              <?php FindCategories::getOptions(); ?>
          </select><br><br>
          <label>Título</label><br>
          <input type="text" id="title" name="title" required><br><br>
          <label>Publicação</label>
          <textarea rows="20" cols="80" id="postage" name="postage"></textarea><br><br>
          <!--a href="#upload-button" class="upload-button">
            <button type="button">Selecionar Imagem</button>
            <input type="file" name="imageFile">
          </a>
          <input type="text" readOnly="true" value=""  class="upload-button"-->
          <label>Imagem</label>
          <input type="file" name="imageFile">
          <label>Referências</label><br>
          <input type="text" id="reference" name="reference"><br><br>
          <label>Autor</label><br>
          <input type="text" id="author" name="author" required><br><br>
        </fieldset>
        <input type="submit" value="Salvar">
    </form>
  </div>

<?php
    Page::footer();
    Page::closeBody();
?>
