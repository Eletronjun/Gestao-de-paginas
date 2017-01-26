<?php
    require_once __DIR__ . "/class/autoload.php";

    use \html\Page as Page;
    use \html\CommunityMenu as CommunityMenu;
    use \configuration\Globals as Globals;

    Page::startHeader("Processo Seletivo 2015");
    Page::styleSheet("selective_process");
    Page::closeHeader();

    $menu = new CommunityMenu();
    $menu->construct();

?>

<main>

  <?php Page::pageTitle("Processos Seletivos");?>

  <div class="process">
    <a href="selective_process2015.php">
      <figure>
        <img src="res/img/PS15.png">
      </figure>
    </a>

    <a href="selective_process2016.php">
      <figure>
        <img src="res/img/PS16.jpg">
      </figure>
    </a>
  </div>
</main>
<?php
Page::footer();
Page::closeBody();

?>
