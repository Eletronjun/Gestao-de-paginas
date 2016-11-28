<?php
    require_once __DIR__ . "/../class/autoload.php";

    use \utilities\Session as Session;
    use \html\Page as Page;
    use \html\AdministratorMenu as AdministratorMenu;
    use \html\FindCategories as FindCategories;
    use \configuration\Globals as Globals;

    Page::startHeader("Categorias");
    Page::styleSheet("user");
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
              <th>Remover</th>
          </tr>
                <?php FindCategories::getCheckboxTableRemoveButton(); ?>
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
              <label>Layout Padrão:</label><br>
              <select id="layout" name="layout">
                <option value="publication">Geral</option>
                <option value="short_publication">Publicação Curta</option>
                <option value="video">Vídeo</option>
              </select>
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
            <fieldset id="update_category">
              <label>Novo Nome:</label><br>
              <input type='text' name='category' id='category_name' value='' size='50%' required>
              <label>Layout Padrão:</label><br>
              <select id='update_layout' name='update_layout'>
              </select>
            </fieldset>
          </fieldset>
          <input type="button" name="submit" value="Salvar" id="update_button">
        </form>
      </div>
</main>
<?php
    Page::footer();
?>

<script type="text/javascript">

function ajaxReload(){
    $.ajax({
        url: '../controller/findCategoryData.php?code=' + $('#select_update').val(),
            success: function(data) {
            $('#update_category').html(data);
        }
    });
}

$(document).ready(function(){

    $('#select_update').click(function(){
        ajaxReload();
    });

    $('#update_button').click(function(){
        $.ajax({
            url: '../controller/updateCategory.php?id=' + $('#select_update').val() +
                '&name=' + $('#select_update option:selected').text() +
                '&new_name=' + $('#category_name').val() +
                '&new_layout=' + $('#update_layout').val(),
            success: function(data) {
                alert(data);
                $.ajax({
                    url: '../controller/findCategory.php',
                    success: function(data){
                        $('#select_update').html(data);
                        $('#category_name').val("");
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
            url: '../controller/registerCategory.php?name=' + $('#new_category').val() +
                    '&layout=' + $('#layout').val(),
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

    $("button").live('click', function(){
        if(confirm('A operação não poderá ser desfeita.\n' +
            'Todas as páginas pertencentes a esta categoria também serão removidas.\n' +
            'Tem certeza que deseja remover a categoria ' +
             $(this).val().split("-_-")[1] +
             '?'))
        {
            $.ajax({
                url: '../controller/removeCategory.php?name=' + $(this).val().split("-_-")[1]
                +'&id=' + $(this).val().split("-")[0],
                beforeSend: function() {
                    $('#enable').html("Carregando...");
                },
                success: function(data) {
                    $('#enable').html(data);
                },
            });
        }
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
