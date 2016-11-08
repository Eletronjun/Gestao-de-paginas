<?php
    require_once __DIR__ . "/class/autoload.php";
    use \html\Page as Page;
    use \html\CommunityMenu as CommunityMenu;
    use \configuration\Globals as Globals;

    Page::header(Globals::ENTERPRISE_NAME);

    $menu = new CommunityMenu();
    $menu->construct();

?>
    <main style="margin-top: 2rem;">
      <img src="res/img/Etron.png" style="max-width:230px; display:block; float:left; margin-top:2rem"/>
      <form action="controller/initSession.php" method="POST" style="width: auto; display:block; float:left; margin-left:5rem;">
          <h1>Bem-vindo de volta!</h1>
            <fieldset style="width:20rem">
              <label>Email</label><br>
              <input type="text" id="email" name="email" required><br><br>
              <label>Senha</label><br>
              <input type="password" id="password" name="password" required><br><br>
            </fieldset>
          <input type="submit" value="Logar" style="margin-top: 1.875rem"/>
      </form>
  </main>
<?php
    Page::footer();
    Page::closeBody();
?>
