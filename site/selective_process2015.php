<?php
    require_once __DIR__ . "/class/autoload.php";

    use \html\Page as Page;
    use \html\CommunityMenu as CommunityMenu;
    use \configuration\Globals as Globals;

    Page::startHeader("Processo Seletivo 2015");
    Page::styleSheet("short_publication");
    Page::styleSheet("selective_process");
    Page::closeHeader();

    $menu = new CommunityMenu();
    $menu->construct();

?>

<main>

  <?php Page::pageTitle("Processo Seletivo 2015");?>

  <div id="short_content" style="max-width:700px;width:100%">

    <article>
      <p>É com muita alegria que a EletronJun anuncia a relação de alunos aprovados no Processo Seletivo de 2015! Agradecemos a participação de todos. Sejam bem-vindos.</p>
    </article>

    <figure>
        <img src="res/img/processo_seletivo2015.jpg">
    </figure>
  </div>

</main>
<?php
Page::footer();
Page::closeBody();

?>
