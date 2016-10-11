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
        <h1>Cadastrar Nova Categoria</h1>
        <div id="register"></div>
        <form>
            <fieldset>
              <label>Nome:</label><br>
              <input type="text" name="category" id="new_category" size="50%" maxlength="50" required><br>
              <label>Descrição:</label><br>
              <textarea name="description" id="description" maxlength="200" rows="5" cols="50"></textarea><br>
              <input type="button" name="submit" value="Salvar" id="register_button">
            </fieldset>
        </form>

        <hr>

        <h1>Atualizar Categoria</h1>
        <div id="update"></div>
        <form>
            <fieldset>
              <label>Categoria</label><br>
              <select name="categories" id="select_update">
              <?php include 'controller/findCategory.php'; ?>
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

<script type="text/javascript">
$(document).ready(function(){

    $('#update_button').click(function(){
        $.ajax({
            url: 'controller/updateCategory.php?id=' + $('#select_update').val() +
                '&name=' + $('#select_update option:selected').text() +
                '&new_name=' + $('#update_category').val(),
            success: function(data) {
                alert(data);
                $.ajax({
                    url: 'controller/findCategory.php',
                    success: function(data){
                        $('#select_update').html(data);
                        $('#update_category').val("");
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
            url: 'controller/registerCategory.php?name=' + $('#new_category').val(),
            success: function(data) {
                alert(data);
                $.ajax({
                    url: 'controller/findCategory.php',
                    success: function(data){
                        $('#select_update').html(data);
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


});
</script>
<?php
    Page::closeBody();
?>
