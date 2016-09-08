<?php
    require_once __DIR__ . "/class/autoload.php";
    
    use \html\Page as Page;
    use \html\Menu as Menu;
    use \configuration\Globals as Globals;

    Page::header(Globals::ENTERPRISE_NAME);
    
    Menu::startMenu();
        Menu::startItem();
        Menu::addItem(PROJECT_ROOT . "#", "Páginas");
            Menu::initSubItem();
                Menu::addItem(PROJECT_ROOT . "category.php", "Gerenciar de Categoria");
            Menu::endSubItem();
        Menu::endItem();
    Menu::endMenu();
?>

<!--Conteúdo da página-->
<div id="content" style="text-align: left;">
    <article>

        <h1>Cadastrar Nome de Categoria</h1>
        <div id="register"></div>
        <form>
            <label>Nome:</label><br>
            <input type="text" name="category" id="new_category" size="50%" required>
            <input type="button" name="submit" value="Salvar" id="register_button">
        </form>

    </article>
</div>
<?php
    Page::footer();
?>

<script type="text/javascript">
$(document).ready(function(){ 

    $('#register_button').click(function(){
        $.ajax({
            url: 'controller/registerCategory.php?name=' + $('#new_category').val(),
            success: function(data) {
                alert(data);
                $('#new_category').val("");
            },
            beforeSend: function(){
                $('#register').html("Carregando...");
            },
            complete: function(){
                $('#register').html("");
            },
        });
    });
    
    
});
</script>
<?php
    Page::closeBody();
?>