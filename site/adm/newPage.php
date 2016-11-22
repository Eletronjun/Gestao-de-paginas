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
  <main>
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
          <label>Imagem</label>
          <input type="file" name="imageFile">
          <label>Referências</label><br>
          <textarea rows="4" cols="80" id="reference" maxlenght="300" name="reference" required="true">
            </textarea><br><br>
          <label>Autor</label><br>
          <input type="text" id="author" name="author" required><br><br>



          <div style='width:100%;text-align:center;'>
            <label class='center'>Oculto?</label><br><br>
            <input class='center' type='radio' name='isActivity' value='n' checked="">Sim
            <input class='center' type='radio' name='isActivity' value='y'>Não;
          </div>
          <br>
        </fieldset>
        <input type="submit" value="Salvar">
    </form>
  </main>

<?php
    Page::footer();
    Page::closeBody();
?>
