<?php
    require_once __DIR__ . "/class/autoload.php";

    use \html\Page as Page;
    use \html\CommunityMenu as CommunityMenu;
    use \configuration\Globals as Globals;

    Page::startHeader("Processo Seletivo 2015");
    echo "<style> main figure, main img {width: 23rem;} </style>";
    Page::closeHeader();

    $menu = new CommunityMenu();
    $menu->construct();

?>

<main>

  <div id="page_title">
    <h1>Processos Seletivos</h1>
    <img src="res/img/Circuito.png"><br>
  </div>

  <div class="flex">
    <a href="selective_process2015.php" class="set_flex">
      <figure class="left">
        <img src="res/img/PS15.png">
      </figure>
    </a>

    <a href="selective_process2016.php" class="set_flex">
      <figure class="right">
        <img src="res/img/PS16.jpg">
      </figure>
    </a>
  </div>
</main>
<?php
Page::footer();
Page::closeBody();

?>
