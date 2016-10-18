<?php
    require_once __DIR__ . "/../class/autoload.php";

    use \html\Page as Page;
    use \html\AdministratorMenu as AdministratorMenu;
    use \html\FindCategories as FindCategories;
    use \configuration\Globals as Globals;
    use \utilities\Session as Session;

    $session = new Session();
    $session->verifyIfSessionIsStarted();

    Page::header(Globals::ENTERPRISE_NAME);

    $menu = new AdministratorMenu();
    $menu->construct();
?>

<!--Conteúdo da página-->
<div id="delete"></div>
<div id="content" style="text-align: left;">
    <article>

        <h1>Gerência de Páginas</h1>
        <form method="GET" action='editPage.php'>
            <label>Categoria</label><br>
            <select name="categories" id="select_categories">
                <option value='-1'>Selecione uma categoria</option>
                <?php FindCategories::getOptions(); ?>
            </select><br>
            <label>Título da publicação</label><br>
            <select name="pages" id="select_page">
                <option value='-1'>Selecione uma categoria primeiramente</option>
            </select><br>
            <input type="button" name="submit" value="Excluir" id="delete_button">
            <input type="submit" name="submit" value="Editar" id="edit_button">
        </form>

    </article>
</div>
<?php
    Page::footer();
?>

<script type="text/javascript">

function ajaxReload(){
    $.ajax({
        url: '../controller/findPageByCategory.php?code_category=' + $('#select_categories').val(),
            success: function(data) {
            $('#select_page').html(data);
        }
    });
}

function pageIsSelected(){
    var isValid = ($('#select_categories').val() != "-1" && $('#select_page').val() != "-1" );
    if (!isValid) {
        alert("Selecione uma categoria e uma página válida");
    }
    return isValid;
}

$(document).ready(function(){

    $('#select_categories').click(function(){
        ajaxReload();
    });

    $('form').submit(function(e){
        return pageIsSelected();
    });


    $('#delete_button').click(function(){
        if(confirm("tem certeza?") && pageIsSelected()) {
            $.ajax({
                url: '../controller/deletePage.php?code=' + $('#select_page').val() +
                    '&title=' + $('#select_page option:selected').text(),
                success: function(data) {
                    alert(data);
                    ajaxReload();
                },
                beforeSend: function(){
                    $('#delete').html("Carregando...");
                },
                complete: function(){
                    $('#delete').html("");
                },
              });
            } else {
                //Nothing to do.
            }
        });
    });
</script>
<?php
    Page::closeBody();
?>
