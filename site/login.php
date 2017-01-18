<?php
    require_once __DIR__ . "/class/autoload.php";
    use \html\Page as Page;
    use \html\CommunityMenu as CommunityMenu;
    use \configuration\Globals as Globals;

    Page::startHeader(Globals::ENTERPRISE_NAME);
    Page::styleSheet("form");
    Page::styleSheet("login");
    Page::closeHeader();

    $menu = new CommunityMenu();
    $menu->construct();

?>
    <main>
      <figure  id="etron"><img src="res/img/Etron.png"></figure>
      <form action="controller/initSession.php" method="POST">
          <h1>Bem-vindo de volta!</h1>
            <fieldset>
              <label>Email</label><br>
              <input type="text" id="email" name="email" required><br><br>
              <label>Senha</label><br>
              <input type="password" id="password" name="password" required><br><br>
            </fieldset>
          <input type="submit" value="Logar"/>
      </form>
  </main>
<?php
    Page::footer();
    Page::closeBody();
?>
