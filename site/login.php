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
    <div id="content">
      <img src="res/img/Etron.png" style="max-width:230px; display:block; float:left; margin-top:2rem"/>
      <form action="controller/initSession.php" method="POST" style="display:block; float:left; margin-left:5rem;">
          <h1>Bem-vindo de volta!</h1><br><br>
            <fieldset style="width:20rem">
              <label>Email</label><br>
              <input type="text" id="email" name="email" required><br><br>
              <label>Senha</label><br>
              <input type="password" id="password" name="password" required><br><br>
            </fieldset>
          <input type="submit" value="Logar" style="margin-top: 1.875rem"/>
      </form>
  </div>
<?php
    Page::footer();
    Page::closeBody();
?>
