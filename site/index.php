<?php
    require_once __DIR__ . "/class/autoload.php";

    use \utilities\Session as Session;
    use \html\Page as Page;
    use \html\CommunityMenu as CommunityMenu;
    use \dao\WebPageDao as WebPageDao;
    use \dao\CategoryDao as CategoryDao;
    use \model\WebPage as WebPage;
    use \configuration\Globals as Globals;

    Page::header(Globals::ENTERPRISE_NAME);

    $menu = new CommunityMenu();
    $menu->construct();

?>

<div id="content">
  <h1>Eletronjun - Engenharia Eletrônica Jr.</h1>

  <h2>Últimas Publicações</h2>
  <?php
    $last_publications = WebPageDao::returnLast3();

      echo "
      <section id=\"last_publications\">
        <div id=\"one_last_publication\">
          <a href=\"publications.php?code={$last_publications[0][0]}\">
            <img src=\"res/file/{$last_publications[0][3]}\" /></a>
        </div>";
      echo "
        <div class=\"two_last_publication\">
          <a href=\"publications.php?code={$last_publications[1][0]}\">
            <img src=\"res/file/{$last_publications[1][3]}\" />
          </a>
        </div>";
      echo "
        <div class=\"two_last_publication\">
          <a href=\"publications.php?code={$last_publications[2][0]}\">
            <img src=\"res/file/{$last_publications[2][3]}\" />
          </a>
        </div>
        </section>";
  /*$arr = WebPageDao::returnLast3();
  while(list($code, $title, $content, $image) = each($arr)){
    echo "$code $title $image<br>";
  }*/
  foreach (CategoryDao::returnActiveCategories() as $code => $name) {
      echo "<p><strong>{$name}</strong></p>";
      $hasPage = false;
      foreach (WebPageDao::returnLast5byCategory($code) as $pageCode => $title) {
          $hasPage = true;
          echo "<a href=\"publications.php?code={$pageCode}\">{$title}</a><br>";
      }
      if (!$hasPage) {
          echo "Não há Publicações";
      } else {
          //Nothing to do
      }
  }
echo "</div id=\"content\">";
Page::footer();
Page::closeBody();

?>

<style>
  #last_publications section{
    width: 50.5rem;
    max-width: 808px;
  }
  #last_publications img{
    width: 25rem;
    height: auto;
    display: block;
    float: left;
  }
  .two_last_publication{
    height: 12.25rem;
    width: 25rem;
    overflow: hidden;
    float: left;
    margin-left: 0.5rem;
    margin-bottom: 0.5rem;
  }
</style>
