<?php
    require_once __DIR__ . "/../class/autoload.php";

    use \utilities\Session as Session;
    use \html\Page as Page;
    use \html\FindCategories as FindCategories;
    use \html\AdministratorMenu as AdministratorMenu;
    use \configuration\Globals as Globals;

    Page::startHeader("Nova Página");
    Page::styleSheet("user");
    Page::styleSheet("form");
    echo "<script src=\"../css/ckeditor/ckeditor.js\"></script>";
    Page::closeHeader();

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
          <input type="text" id="title" name="title" required max="100"><br><br>
          <label>Publicação</label>
          <textarea rows="20" cols="80" id="postage" name="postage" maxlength="5000"></textarea><br><br>
          <script>CKEDITOR.replace( 'postage' );</script>
          <fieldset id="type_page">
            <input type="hidden" name="imageFile">
            <input type="hidden" name="videoLink">
            <input type="hidden" name="formLink">
            <input type="hidden" name="reference">
          </fieldset>
          <p>Autor(a): <?php echo $_SESSION['nick'];?></p><br>
          <input type="text" id="author" name="author" value="<?php echo $_SESSION['nick'];?>" hidden required>
        </fieldset>
        <fieldset>
        <label>Página Oculta</label><br>
        <input type='radio' name='isActivity' value='n' checked>Sim<span class="padding_left"></span>
        <input type='radio' name='isActivity' value='y'>Não
        </fieldset>
        <input type="submit" value="Salvar">
    </form>
  </main>

<?php
    Page::footer();
?>
  <script type="text/javascript">

  function ajaxReload(){
      $.ajax({
          url: '../controller/updateNewPageForm.php?code=' + $('#select_update').val(),
              success: function(data) {
              $('#type_page').html(data);
          }
      });
  }

  $(document).ready(function(){
      $('#select_update').click(function(){
          ajaxReload();
      });

  });
  </script>

<?php
    Page::closeBody();
?>
