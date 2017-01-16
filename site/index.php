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
  <h2 style="width:20rem">Últimas Publicações</h2>
    <?php
    $last_publications = WebPageDao::returnLast3();
    ?>
      <section class="last_publications flex">
        <?php if(isset($last_publications[0][0])) {?>
        <ul class="set_flex" id="first_publication">
          <a href="controller/generatePublication.php?code=<?php echo $last_publications[0][0];?>">
            <li>
                <?php
                if (strlen($last_publications[0][1]) <= 24) {
                    echo "<h2>{$last_publications[0][1]}</h2>";
                } else {
                    $length_title = 23/(strlen($last_publications[0][1])*0.45);
                    echo "<h2 style=\"font-size:{$length_title}rem\">{$last_publications[0][1]}</h2>";
                }
                ?>
                <?php
                if (strlen($last_publications[0][2]) > 3) {
                    echo $last_publications[0][2];
                }
                ?>
            </li>
            <li>
              <?php if(strlen($last_publications[0][3]) > 0) { ?>
                <img class="top" src="res/file/<?php echo $last_publications[0][3]?>">
              <?php } ?>
            </li>
          </a>
        </ul>
        <?php } ?>
        <div class="set_flex flex flex_colunm">
          <?php if(isset($last_publications[1][0])) {?>
          <ul class="set_flex">
            <a href="controller/generatePublication.php?code=<?php echo $last_publications[1][0];?>">
              <li>
                  <?php
                  if (strlen($last_publications[1][1]) <= 24) {
                  } else {
                      $length_title = 23/(strlen($last_publications[1][1])*0.45);
                      echo "<h2 style=\"font-size:{$length_title}rem\">{$last_publications[1][1]}</h2>";
                  }
                  echo "<h2>{$last_publications[1][1]}</h2>";
                  ?>
                  <?php
                  if (strlen($last_publications[1][2]) > 3) {
                      echo $last_publications[1][2] . "...</p>";
                  }
                  ?>
              </li>
              <li>
                <?php if(strlen($last_publications[1][3]) > 0) { ?>
                  <img class="top" src="res/file/<?php echo $last_publications[1][3]?>">
                <?php } ?>
              </li>
            </a>
          </ul>
          <?php }
            if (isset($last_publications[2][0])) {
          ?>
          <ul class="set_flex">
            <a href="controller/generatePublication.php?code=<?php echo $last_publications[2][0];?>">
              <li>
                  <?php
                  if (strlen($last_publications[2][1]) <= 24) {
                      echo "<h2>{$last_publications[2][1]}</h2>";
                  } else {
                      $length_title = 23/(strlen($last_publications[2][1])*0.45);
                      echo "<h2 style=\"font-size:{$length_title}rem\">{$last_publications[2][1]}</h2>";
                  }
                  ?>
                  <?php
                  if (strlen($last_publications[2][2]) > 3) {
                      echo $last_publications[2][2] . "...</p>";
                  }
                  ?>
              </li>
              <li>
                <?php if(strlen($last_publications[2][3]) > 0) { ?>
                  <img class="top" src="res/file/<?php echo $last_publications[2][3]?>">
                <?php } ?>
              </li>
            </a>
          </ul>
          <?php
            }
          ?>
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
              echo "<section><div class=\"";
              if($flag_float){
                echo "left";$flag_float=false;
              } else {
                echo "right";
                $flag_float = true;
              }
              echo "\">";
              echo "<h2>{$name}</h2>";
              foreach ($data as $list) {
                  echo "<a href=\"controller/generatePublication.php?code={$list[0]}\">
                        <figure>";
                        if(strlen($list[3]) > 1) {
                          echo "<img src=\"res/file/{$list[3]}\">";
                        }
                        echo "</figure>
                        <p class=\"title\">{$list[1]}</p><br>";

                  if (strlen($list[2])) {
                      echo  "{$list[2]}...</p>";
                  }

                      echo "</a>";
              }
              echo "</div></section>";
          }
        }
      ?>
      </div>

<?php
    echo "</main>";
    Page::footer();
    Page::closeBody();

?>
