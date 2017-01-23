<?php
    require_once __DIR__ . "/class/autoload.php";

    use \html\Page as Page;
    use \html\CommunityMenu as CommunityMenu;
    use \dao\WebPageDao as WebPageDao;
    use \dao\CategoryDao as CategoryDao;
    use \model\WebPage as WebPage;
    use \configuration\Globals as Globals;

    Page::startHeader(Globals::ENTERPRISE_NAME);
    Page::styleSheet("index");
    Page::closeHeader();

    $menu = new CommunityMenu();
    $menu->construct();

?>

<main>

  <h1></h1>
  <h2>Últimas Publicações</h2>
    <?php
    $last_publications = WebPageDao::returnLast3();
    ?>
      <section class="last_publications">
        <ul class="publication" id="first_publication">
          <a href="controller/generatePublication.php?code=<?php echo $last_publications[0][0];?>">
            <li>
              <figure>
              <?php
              if(strlen($last_publications[0][4]) > 0) {
                echo "<img src=\"http://i1.ytimg.com/vi/{$last_publications[0][4]}/hqdefault.jpg\">";
              } else if(strlen($last_publications[0][3]) > 0) {
                echo "<img src=\"res/file/{$last_publications[0][3]}\">";
              }
              ?>
            </figure>
            </li>
            <li>
                <?php
                if (strlen($last_publications[0][1]) <= 24) {
                    echo "<h2>{$last_publications[0][1]}</h2>";
                } else {
                    $length_title = 23/(strlen($last_publications[0][1])*0.45);
                    echo "<h2 style=\"@media only screen and (min-width:700px){font-size:{$length_title}rem}\">{$last_publications[0][1]}</h2>";
                }
                ?>
                <?php
                if (strlen($last_publications[0][2]) > 3) {
                  echo "<p>" . substr(strip_tags($last_publications[0][2]), 0, 100) . "...</p>\n";
                }
                ?>
            </li>
          </a>
        </ul>
        <div>
        <ul class="publication">
          <a href="controller/generatePublication.php?code=<?php echo $last_publications[1][0];?>">
            <li>
              <figure>
              <?php
              if(strlen($last_publications[1][4]) > 0) {
                echo "<img src=\"http://i1.ytimg.com/vi/{$last_publications[1][4]}/hqdefault.jpg\">";
              } else if(strlen($last_publications[1][3]) > 0) {
                echo "<img src=\"res/file/{$last_publications[1][3]}\">";
              }
              ?>
            </figure>
            </li>
            <li>
                <?php
                if (strlen($last_publications[1][1]) <= 24) {
                  echo "<h2>{$last_publications[1][1]}</h2>";
                } else {
                    $length_title = 23/(strlen($last_publications[1][1])*0.45);
                    echo "<h2 style=\"@media only screen and (min-width:700px){font-size:{$length_title}rem}\">{$last_publications[1][1]}</h2>";
                }
                ?>
                <?php
                if (strlen($last_publications[1][2]) > 3) {
                  echo "<p>" . substr(strip_tags($last_publications[1][2]), 0, 100) . "...</p>\n";
                }
                ?>
            </li>
          </a>
        </ul>
        <ul class="publication">
          <a href="controller/generatePublication.php?code=<?php echo $last_publications[2][0];?>">
            <li>
              <figure>
              <?php
              if(strlen($last_publications[2][4]) > 0) {
                echo "<img src=\"http://i1.ytimg.com/vi/{$last_publications[2][4]}/hqdefault.jpg\" class=\"video_image\">";
              } else if(strlen($last_publications[2][3]) > 0) {
                echo "<img src=\"res/file/{$last_publications[2][3]}\">";
              }
              ?>
              </figure>
            </li>
            <li>
                <?php
                if (strlen($last_publications[2][1]) <= 24) {
                    echo "<h2>{$last_publications[2][1]}</h2>";
                } else {
                    $length_title = 23/(strlen($last_publications[2][1])*0.45);
                    echo "<h2 style=\"@media only screen and (min-width:700px){font-size:{$length_title}rem}\">{$last_publications[2][1]}</h2>";
                }
                ?>
                <?php
                if (strlen($last_publications[2][2]) > 3) {
                    echo "<p>" . substr(strip_tags($last_publications[2][2]), 0, 100) . "...</p>\n";

                }
                ?>
            </li>
          </a>
        </ul>
        </div>
      </section>

      <div class="category_banner">
      <?php
        $flag_float = true;
        foreach (CategoryDao::returnActiveCategories() as $code => $name) {
          $data = WebPageDao::returnLast3byCategory($code);
          if (!$data[0]) {
            // Nothing do
          } else {
              echo "<section>";
              echo "<a href=\"categories.php?code={$code}\"><h2>{$name}</h2></a>";
              foreach ($data as $list) {
                  echo "<a href=\"controller/generatePublication.php?code={$list[0]}\">
                        <figure>";
                        if(strlen($list[5]) > 0) {
                          echo "<img src=\"http://i1.ytimg.com/vi/{$list[5]}/mqdefault.jpg\">";
                        } else if(strlen($list[3]) > 0) {
                          echo "<img src=\"res/file/{$list[3]}\">";
                        }
                        echo "</figure>
                        <div><p class=\"title\">{$list[1]}</p><br>";

                  if (strlen($list[2])) {
                      echo "<p>" . substr(strip_tags($list[2]), 0, 100) . "...</p></div>\n";
                  }
                  echo "</a>";
              }
              echo "</section>\n";
          }
        }
      ?>
      </div>

<?php
    echo "</main>";
    Page::footer();
    Page::javaScript("mainBanner");
    Page::closeBody();

?>
