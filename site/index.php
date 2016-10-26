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

<style>
  .last_publications section{
    width: 50.5rem;
    max-width: 808px;
  }
  .last_publications ul {
    position:relative;
    height: 12.25rem;
    width: 25rem;
    overflow:hidden;
    float:left;
    background-color:#111F1E;
    list-style: none;
    margin-left: 0.5rem;
    margin-bottom: 0.5rem;
    border: solid #111F1E 0.1rem;
    border-radius: 1rem;
  }
  .last_publications img {
    position:absolute;
    left:0;
    bottom:-6.125rem;
    cursor:pointer;
    width: 100%;
    height: auto;
    margin: -3rem 0;
    -webkit-transition:bottom .3s ease-in-out;
    -moz-transition:bottom .3s ease-in-out;
    -o-transition:bottom .3s ease-in-out;
    transition:bottom .3s ease-in-out
  }
  .last_publications img.top:hover {
    bottom:-17rem;
    padding-top:17rem;
  }
  .last_publications #first ul {
    height: 25rem;
    width: 25rem;
    margin: 0;
  }
  .last_publications #first img {
    bottom:0;
    margin: 0;
  }
  .last_publications #first img.top:hover {
    bottom:-7rem;
    padding-top:7rem;
  }
  .last_publications h2, .last_publications p{
    margin: 0.5rem 0 0 0.5rem;
    padding: 0;
    color: #fff;
  }
  .last_publications p{
    font-size: 0.9rem;
    max-height: 3rem;
    margin-right: 0.5rem;
  }

  .category_banner {
    margin: 1.875rem 0;
  }

  .category_banner h2{
    margin-bottom: 0.375rem;
  }
  .category_banner section{
    width:45%;
    margin-left:2.5%;
    float:left;
    height:20rem;
  }
  .category_banner div{
    width:4.6875rem;
    height:4.6875rem;
    display:block;
    float:left;
    margin:0;
    padding:0;
  }
  .category_banner img{
    width:4.6875rem;
    height:auto;
  }
  .category_banner p{
    text-indent:0;
    margin:0;
    padding:0;
    display:block;
    float:left;
    max-width:75%;
    font-size:0.8rem;
    margin-left:0.5rem;
  }
  .category_banner .title{
    font-weight:bold;
    font-size:1rem;
  }
  .category_banner a,
  .category_banner a:hover,
  .category_banner a:active,
  .category_banner a:visited{
    color:inherit;
    text-decoration:none;
    display:table;
    width:24rem;
    margin:0.325rem;
    text-align:left;
  }
</style>

<div id="content">

  <h1></h1>
  <h2>Últimas Publicações</h2>
  <?php
    $last_publications = WebPageDao::returnLast3();
  ?>
    <section class="last_publications">
      <div id="first">
        <ul>
            <li>
               <h2><?php echo $last_publications[0][1]?></h2>
               <?php echo $last_publications[0][2]?></p>
            </li>
            <li>
              <a href="publications.php?code=<?php echo $last_publications[0][0]?>">
                <img class="top" src="res/file/<?php echo $last_publications[0][3]?>" alt=""/>
              </a>
            </li>
        </ul>
      </div>

      <ul>
        <li>
           <h2><?php echo $last_publications[1][1]?></h2>
           <?php echo $last_publications[1][2]?></p>
        </li>
        <li>
          <a href="publications.php?code=<?php echo $last_publications[1][0]?>">
            <img class="top" src="res/file/<?php echo $last_publications[1][3]?>" alt=""/>
          </a>
        </li>
      </ul>

      <ul>
        <li>
           <h2><?php echo $last_publications[2][1]?></h2>
           <?php echo $last_publications[1][2]?></p>
        </li>
        <li>
          <a href="publications.php?code=<?php echo $last_publications[2][0]?>">
            <img class="top" src="res/file/<?php echo $last_publications[2][3]?>" alt=""/>
          </a>
        </li>
      </ul>
    </section>

  <?php
  /*$arr = WebPageDao::returnLast3();
  while(list($code, $title, $content, $image) = each($arr)){
    echo "$code $title $image<br>";
  }*/
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
                      echo  "{$list[2]}</p>";

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
