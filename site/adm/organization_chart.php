<?php
    require_once __DIR__ . "/../class/autoload.php";

    use \utilities\Session as Session;
    use \html\Page as Page;
    use \html\AdministratorMenu as AdministratorMenu;
    use \configuration\Globals as Globals;

    Page::startHeader("Organograma");
    Page::styleSheet("user");
    Page::styleSheet("form");
    Page::closeHeader();

    $session = new Session();
    $session->verifyIfSessionIsStarted();

    $menu = new AdministratorMenu();
    $menu->construct();


?>
<main>
  <h1></h1>
  <section class="left" style="margin-bottom:3.125rem">
    <h1>Gerenciar Organograma</h1>
    <p style="font-size:1.5625rem;margin-top:-1.7rem;">Camila Ferrer</p>
  </section>

</main>

<?php
    Page::footer();
    Page::closeBody();
?>
