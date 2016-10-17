<?php

    require_once __DIR__ . "/../class/autoload.php";

    use \html\Page as Page;
    use \html\AdministratorMenu as AdministratorMenu;
    use \html\FindCategories as FindCategories;
    use \configuration\Globals as Globals;
    use \utilities\Session as Session;

    Page::header(Globals::ENTERPRISE_NAME);
    
    $session = new Session();
    $session->verifyIfSessionIsStarted();
    $menu = new AdministratorMenu();
    $menu->construct();
?>

<!--Conteúdo da página-->
<div id="content" style="text-align: left;">
    <article>

        <h1>Cadastrar Nome de Categoria</h1>
        <div id="register"></div>
        <form>
            <label>Nome:</label><br>
            <input type="text" name="category" id="new_category" size="50%" maxlength="50" required>
            <input type="button" name="submit" value="Salvar" id="register_button">
        </form>

        <br><br>

        <hr>

        <h1>Atualizar Nome de Categoria</h1>
        <div id="update"></div>
        <form>
            <fieldset>
              <label>Categoria</label><br>
              <select name="categories" id="select_update">            
                <?php FindCategories::getOptions(); ?>

              </select><br>
              <label>Novo Nome:</label><br>
              <input type="text" name="category" id="update_category" size="50%" required>
              <input type="button" name="submit" value="Salvar" id="update_button">
            </fieldset>
        </form>
</div>
<?php
    Page::footer();
?>

<style type="text/css">
    table {
        margin:  auto;
        border-collapse: collapse;
    }
    table, th, td {
        border: 2px solid black;
    }
</style>

<script type="text/javascript">
$(document).ready(function(){
    $('#update_button').click(function(){
        $.ajax({
            url: '../controller/updateCategory.php?id=' + $('#select_update').val() + 
                '&name=' + $('#select_update option:selected').text() +
                '&new_name=' + $('#update_category').val(),
            success: function(data) {
                alert(data);
                $.ajax({
                    url: '../controller/findCategory.php',
                    success: function(data){
                        $('#select_update').html(data);
                        $('#update_category').val("");
                    }
                });
                $.ajax({
                    url: '../controller/findCategory.php?checkbox=yes',
                    success: function(data){
                        $('#enableCategory').html(data);
                        $('#new_category').val("");
                    }
                });
            },
            beforeSend: function(){
                $('#update').html("Carregando...");
            },
            complete: function(){
                $('#update').html("");
            },
        });
    });
    $('#register_button').click(function(){
        $.ajax({
            url: '../controller/registerCategory.php?name=' + $('#new_category').val(),
            success: function(data) {
                alert(data);
                $.ajax({
                    url: '../controller/findCategory.php',
                    success: function(data){
                        $('#select_update').html(data);
                    }
                });
                $.ajax({
                    url: '../controller/findCategory.php?checkbox=yes',
                    success: function(data){
                        $('#enableCategory').html(data);
                        $('#new_category').val("");
                    }
                });
            },
            beforeSend: function(){
                $('#register').html("Carregando...");
            },
            complete: function(){
                $('#register').html("");
            },
        });
    });

    $("input:checkbox[name='categories']").live('click',function(){
        $("input:checkbox[name='categories']").map(function()
        {
            $.ajax({
                url: '../controller/enableCategory.php?name=' + $(this).val().split("-_-")[1]
                +'&id=' + $(this).val().split("-")[0]
                    +'&is_activity=' + (($(this).is(':checked')) ? 1 : 0),
                beforeSend: function() {
                    $('#enable').html("Carregando...");
                },
                complete: function() {
                    $('#enable').html("Salvo com sucesso");
                },
            });
        });
    });
});
</script>
<?php
    Page::closeBody();
?>
