<?php
    require_once __DIR__ . "/class/autoload.php";

    use \html\Page as Page;
    use \utilities\Date as Date;
    use \html\CommunityMenu as CommunityMenu;
    use \dao\WebPageDao as WebPageDao;
    use \dao\CategoryDao as CategoryDao;
    use \model\WebPage as WebPage;
    use \configuration\Globals as Globals;

    Page::startHeader(CategoryDao::findCategory($_GET['code'])->getName());
    Page::styleSheet("category");
    Page::closeHeader();

    $menu = new CommunityMenu();
    $menu->construct();

try {
?>

  <main id="category">

    <?php Page::pageTitle(CategoryDao::findCategory($_GET['code'])->getName(), CategoryDao::findCategory($_GET['code'])->getDescription());?>

    <?php

    $data = WebPageDao::returnLast3byCategory($_GET['code']);
    if (!$data[0]) {
      // Nothing do
    } else {
      echo "<div class=\"category_banner\">\n";
      for($index = 0; $index < 3; $index++) {
        echo "  <div>\n";
          if(isset($data[$index])){
            echo "<a href=\"controller/generatePublication.php?code={$data[$index][0]}\" class=\"clean_link\">";

              echo "<figure>";
                if(CategoryDao::findCategory($_GET['code'])->getLayout() == "video"){
                  echo "<img src=\"http://i1.ytimg.com/vi/{$data[$index][5]}/default.jpg\">";
                } else {
                  if(strlen($data[$index][3]) > 1) {
                    echo "<img src=\"res/file/{$data[$index][3]}\">";
                  }
                }
              echo "</figure><span>\n";
              echo "<p class=\"title\">{$data[$index][1]}</p><p class=\"date\">";
              echo Date::formatDate($data[$index][4]) . "</p>\n";

              if (strlen($data[$index][2])) {
                  echo "<p>" . substr(strip_tags($data[$index][2]), 0, 45) . "...</p>\n";
              }
            echo "</span></a>\n";
          }
        echo "  </div>\n";
      }
      echo "</div>\n";
    }

?>
  <h2>Postagens Antigas</h2>
  <table class="category_table">
  <tr class="title">
      <td class="col_1">Título<span class="date_col"> e Data</span></td>
      <td class="col_2">Resumo</td>
      <td class="col_3">Data de Publicação</td>
  </tr>

  <?php

  $allPublications = WebPageDao::returnByCategory($_GET['code']);

  for ($i=0; $i < count($allPublications); $i++) {
    if ($allPublications[$i]->getIsActivity() == 'y') {
        echo "<tr> <td class=\"col_1\">";
        echo "<a href=\"controller/generatePublication.php?code={$allPublications[$i]->getCode()}\" class=\"clean_link\">".
          "{$allPublications[$i]->getTitle()}</a><br><span class=\"date_col\"> " . Date::formatShortDate($allPublications[$i]->getLastModified()) . "</span></td>";
        echo "<td <td class=\"col_2\">" . substr(strip_tags($allPublications[$i]->getContent()), 0, 200) ."...</p></td>";
        echo "<td <td class=\"col_3\">" . Date::formatDate($allPublications[$i]->getLastModified()) ."</td></tr>";
    }
  }
  ?>
  </table>
  </main>

<?php
} catch (Exception $msg) {
    echo $msg;
    echo "<main><h1>Página não encontrada</h1>";
    echo "<p>Desculpe-nos, mas essa publicação não existe ou foi retirada do ar.</p></main>";
}

Page::footer();
?>
