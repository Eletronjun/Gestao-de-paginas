<?php
    require_once __DIR__ . "/class/autoload.php";

    use \html\Page as Page;
    use \html\CommunityMenu as CommunityMenu;
    use \configuration\Globals as Globals;

    Page::startHeader("Processo Seletivo 2015");
    Page::closeHeader();

    $menu = new CommunityMenu();
    $menu->construct();

?>

<main>

  <div id="page_title">
    <h1>Processos Seletivos</h1>
    <img src="res/img/Circuito.png"><br>
  </div>

  <a href="selective_process2015.php">2015</a>
  <a href="selective_process2016.php">2016</a>
</main>
<?php
Page::footer();
Page::closeBody();

?>
