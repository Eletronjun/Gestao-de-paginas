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

  <main>
    <div id="category_title">
      <h1><?php echo CategoryDao::findCategory($_GET['code'])->getName(); ?></h1>
      <img src="res/img/Circuito.png">
    </div>

    <table>
    <tr>
        <td>Título</td>
        <td>Data de Publicação</td>
    </tr>
    <?php

    $data = WebPageDao::returnLast3byCategory($_GET['code']);
    if(!$data[0]){
      // Nothing do
    }
    else{
      echo "<section class=\"category_banner_2\">";
      foreach ($data as $list) {
          echo "<a href=\"publications.php?code={$list[0]}\">
                  <figure><img src=\"res/file/{$list[3]}\" alt=\"\"></figure>
                  <p class=\"title\">{$list[1]}</p><p class=\"date\">";
                  echo Date::formatDate($list[4]) . "</p>";

                if(strlen($list[2]))
                  echo  "{$list[2]}...</p>";

                echo "</a>";
      }
      echo "</section>";
    }

    $allPublications = WebPageDao::returnByCategory($_GET['code']);
    for ($i=0; $i < count($allPublications); $i++) {
        echo "<tr> <td>";
        echo "<a href=\"publications.php?code={$allPublications[$i]->getCode()}\">".
            "{$allPublications[$i]->getTitle()}</a></td>";
        echo "<td><i>{$allPublications[$i]->getLastModified()}</i></td>";
        //echo $allPublications[$i] . "</td></tr>";
    }

    ?>
    </table>

  </main>

<?php
} catch (Exception $msg) {
    echo "<h1>Página não encontrada</h1>";
    echo "<p>Desculpe-nos, mas essa publicação não existe ou foi retirada do ar.</p>";
}

Page::footer();
?>
