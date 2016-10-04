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
<div id="delete"></div>
<div id="content" style="text-align: left;">
    <article>

        <h1>Gerência de Páginas</h1>
        <form method="GET">
            <label>Páginas Atuais</label><br>
            <select name="pages" id="select_page">
              <?php include 'controller/findPage.php'; ?>
            </select><br>
            <input type="button" name="submit" value="Excluir" id="delete_button">
            <input type="button" name="submit" value="Editar" id="edit_button" onclick="location.href = 'editPage.php?code=78'">
        </form>

    </article>
</div>
<?php
    Page::footer();
?>

<script type="text/javascript">
$(document).ready(function(){

    $('#delete_button').click(function(){
        $.ajax({
            url: 'controller/deletePage.php?code=' + $('#select_page').val() +
                '&title=' + $('#select_page option:selected').text(),
            success: function(data) {
                alert(data);
                $.ajax({
                    url: 'controller/findWebPages.php',
                    success: function(data){
                        $('#select_page').html(data);
                    }
                });
            },
            beforeSend: function(){
                $('#delete').html("Carregando...");
            },
            complete: function(){
                $('#delete').html("");
            },
          });
        });
    });
</script>
<?php
    Page::closeBody();
?>
