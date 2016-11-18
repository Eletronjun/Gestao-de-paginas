<?php
    require_once __DIR__ . "/../class/autoload.php";

    use \utilities\Session as Session;
    use \html\Page as Page;
    use \html\AdministratorMenu as AdministratorMenu;
    use \html\FindCategories as FindCategories;
    use \configuration\Globals as Globals;

    Page::startHeader("Categorias");
    Page::styleSheet("form");
    Page::closeHeader();

    $session = new Session();
    $session->verifyIfSessionIsStarted();

    $menu = new AdministratorMenu();
    $menu->construct();
?>

<!--Conteúdo da página-->
<main>

      <h1>Gerência de Categorias</h1>

      <form style="display:block; float:right; width:30%;" class="check-table">
        <h2></h2>
        <fieldset>
          <div id="enable"></div>
          <table id="enableCategory">
          <tr>
              <th>Categoria</th>
              <th>Ativa</th>
          </tr>
                <?php FindCategories::getCheckboxTable(); ?>
          </table>
        </fieldset>
      </form>

      <div style="display:block; float:left; width:55%;">
        <div id="register"></div>
        <form>
            <h2>Nova Categoria</h2>
            <fieldset>
              <label>Nome:</label><br>
              <input type="text" name="category" id="new_category" size="50%" maxlength="50" required>
              <label>Descrição:</label><br>
              <textarea name="description" id="description" maxlength="200" rows="5" cols="50"></textarea><br>
            </fieldset>
            <input type="button" name="submit" value="Salvar" id="register_button">
        </form>

        <hr>

        <div id="update"></div>
        <form>
          <h2>Atualizar Categoria</h2>
          <fieldset>
            <label>Cadastradas</label><br>
            <select name="categories" id="select_update">
            <?php FindCategories::getOptions(); ?>
            </select><br>
            <label>Novo Nome:</label><br>
            <input type="text" name="category" id="update_category" size="50%" required>
          </fieldset>
          <input type="button" name="submit" value="Salvar" id="update_button">
        </form>
      </div>
</main>
<?php
    Page::footer();
?>

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
