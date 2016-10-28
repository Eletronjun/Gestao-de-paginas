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

  <h1></h1>
  <h2>Últimas Publicações</h2>
  <?php
    $last_publications = WebPageDao::returnLast3();
  ?>
    <section class="last_publications">
      <div id="first">
        <ul>
          <a href="publications.php?code=<?php echo $last_publications[0][0]?>">
            <li>
              <?php
                if(strlen($last_publications[0][1]) <= 24)
                  echo "<h2>{$last_publications[0][1]}</h2>";
                else{
                  $length_title = 23/(strlen($last_publications[0][1])*0.45);
                  echo "<h2 style=\"font-size:{$length_title}rem\">{$last_publications[0][1]}</h2>";
                }
              ?>
               <?php
                 if(strlen($last_publications[0][2]))
                   echo $last_publications[0][2] . "...</p>";
               ?>
            </li>
            <li>
                <img class="top" src="res/file/<?php echo $last_publications[0][3]?>" alt=""/>
            </li>
          </a>
        </ul>
      </div>

      <ul>
        <a href="publications.php?code=<?php echo $last_publications[1][0]?>">
          <li>
            <?php
              if(strlen($last_publications[1][1]) <= 24)
                echo "<h2>{$last_publications[1][1]}</h2>";
              else{
                $length_title = 23/(strlen($last_publications[1][1])*0.45);
                echo "<h2 style=\"font-size:{$length_title}rem\">{$last_publications[1][1]}</h2>";
              }
            ?>
             <?php
               if(strlen($last_publications[1][2]))
                 echo $last_publications[1][2] . "...</p>";
             ?>
          </li>
          <li>
              <img class="top" src="res/file/<?php echo $last_publications[1][3]?>" alt=""/>
          </li>
        </a>
      </ul>

      <ul>
        <a href="publications.php?code=<?php echo $last_publications[2][0]?>">
          <li>
            <?php
            if(strlen($last_publications[2][1]) <= 24)
              echo "<h2>{$last_publications[2][1]}</h2>";
            else{
              $length_title = 23/(strlen($last_publications[2][1])*0.45);
              echo "<h2 style=\"font-size:{$length_title}rem\">{$last_publications[2][1]}</h2>";
            }
            ?>
            <?php
              if(strlen($last_publications[2][2]))
                echo $last_publications[2][2] . "...</p>";
            ?>
          </li>
          <li>
              <img class="top" src="res/file/<?php echo $last_publications[2][3]?>" alt=""/>
          </li>
        </a>
      </ul>
    </section>

  <?php
  echo "<div class=\"category_banner\">";
    foreach (CategoryDao::returnActiveCategories() as $code => $name) {
        $data = WebPageDao::returnLast3byCategory($code);
        if(!$data[0]){
          // Nothing do
        }
        else{
          echo "<section>";
          echo "<h2>{$name}</h2>";
          foreach ($data as $list) {
              echo "<a href=\"publications.php?code={$list[0]}\">
                      <div><img src=\"res/file/{$list[3]}\" alt=\"\"></div>
                      <p class=\"title\">{$list[1]}</p><br>";

                    if(strlen($list[2]))
                      echo  "{$list[2]}...</p>";

                    echo "</a>";
          }
          echo "</section>";
        }
        }
  echo "</div>";
echo "</div>";
Page::footer();
Page::closeBody();

?>
