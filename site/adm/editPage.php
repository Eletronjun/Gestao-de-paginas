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
<<<<<<< HEAD
  <main style="text-align: left;">

      <h1>Edição de Página </h1>
      <form action="<?php echo PROJECT_ROOT;?>controller/updatePage.php" method="POST">
        <fieldset>
          <?php Forms::updatePageForm($_GET['pages']); ?>
        </fieldset>
        <input type="hidden" value="<?php echo $_GET['pages']?>" id="page_code">
        <input type="button" value="Excluir Imagem" id="delete_image">
        <input type="submit" value="Atualizar">
      </form>

  </main>

<?php
    Page::footer();
    Page::closeBody();
?>

<script type="text/javascript">
$(document).ready(function(){

  $('#delete_image').click(function(){
    if(confirm("A imagem será apagada, continuar?")) {
      $.ajax({
        url: '../controller/deleteImage.php?code=' + $('#page_code').val(),
        success: function(data){
           alert(data);
        }
      });
    } else {
      //Nothing do
    }
    });
  });

</script>
