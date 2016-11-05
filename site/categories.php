<?php
    require_once __DIR__ . "/class/autoload.php";

    use \utilities\Session as Session;
    use \html\Page as Page;
    use \utilities\Date as Date;
    use \html\CommunityMenu as CommunityMenu;
    use \dao\WebPageDao as WebPageDao;
    use \dao\CategoryDao as CategoryDao;
    use \model\WebPage as WebPage;
    use \configuration\Globals as Globals;

    Page::header(Globals::ENTERPRISE_NAME);

    $menu = new CommunityMenu();
    $menu->construct();

try {
?>

  <main id="category">
    <div id="category_title">
      <h1><?php echo CategoryDao::findCategory($_GET['code'])->getName(); ?></h1>
      <img src="res/img/Circuito.png">
    </div>

    <?php

    $data = WebPageDao::returnLast3byCategory($_GET['code']);
    if(!$data[0]){
      // Nothing do
    }
    else{
      echo "<section class=\"category_banner_2\">";
      foreach ($data as $list) {
          echo "<a href=\"publications.php?code={$list[0]}\" class=\"clean_link\">
                  <figure><img src=\"res/file/{$list[3]}\" alt=\"\"></figure>
                  <p class=\"title\">{$list[1]}</p><p class=\"date\">";
                  echo Date::formatDate($list[4]) . "</p>";

                if(strlen($list[2]))
                  echo  "{$list[2]}...</p>";

                echo "</a>";
      }
      echo "</section>";
    }

?>
    <h2>Postagens Antigas</h2>
    <table class="category_table">
    <tr class="title">
        <td class="col_1">Título</td>
        <td class="col_2">Resumo</td>
        <td class="col_3">Data de Publicação</td>
    </tr>

<?php
    $allPublications = WebPageDao::returnByCategory($_GET['code']);
    for ($i=0; $i < count($allPublications); $i++) {
        echo "<tr> <td class=\"col_1\">";
        echo "<a href=\"publications.php?code={$allPublications[$i]->getCode()}\" class=\"clean_link\">".
            "{$allPublications[$i]->getTitle()}</a></td>";
        echo "<td <td class=\"col_2\">" . substr($allPublications[$i]->getContent(), 0, 200) ."...</p></td>";
        echo "<td <td class=\"col_3\">" . Date::formatDate($allPublications[$i]->getLastModified()) ."</td></tr>";
    }
    ?>
    </table>

  </main>

<?php
} catch (Exception $msg) {
    echo "<main><h1>Página não encontrada</h1>";
    echo "<p>Desculpe-nos, mas essa publicação não existe ou foi retirada do ar.</p></main>";
}

Page::footer();
?>
