<?php
    require_once __DIR__ . "/class/autoload.php";

    use \utilities\Date as Date;
    use \html\Page as Page;
    use \html\CommunityMenu as CommunityMenu;
    use \dao\WebPageDao as WebPageDao;
    use \dao\CategoryDao as CategoryDao;
    use \model\WebPage as WebPage;
    use \configuration\Globals as Globals;

try {
    $page = WebPageDao::getPage($_GET['code']);
    $layout = CategoryDao::findCategory($page->getCategory())->getLayout();

    Page::startHeader($page->getTitle());
    Page::styleSheet("short_publication");
    Page::closeHeader();

    $menu = new CommunityMenu();
    $menu->construct();

    if ($page->getIsActivity() == 'y') {
        // Nothing to do
    } else {
        throw new Exception("Inative Page");
    }

    $category = CategoryDao::findCategory($page->getCategory());
?>
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.8";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

      <main class="styleLink">

        <?php Page::pageTitle($category->getName());?>

        <div id="short_content">
          <header>
            <h2><?php echo $page->getTitle(); ?></h2>
            Publicado em <?php echo Date::formatDate($page->getCreationDate()); ?>
            por <?php echo $page->getAuthor(); ?>
          </header>

          <article>
            <?php echo $page->getContent(); ?>
          </article>

          <figure>
              <img src="<?php echo FILE_PATCH . $page->getImage(); ?>" alt="<?php echo $category->getName(); ?>">
          </figure>
        </div>
<!--
        <section>
          <div class="fb-like" data-href="<?php echo "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}"; ?>"
          data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
          <br>
          <div class="fb-comments" data-href="<?php echo "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}"; ?>"
           data-numposts="10" data-width="auto"></div>
        </section> -->
      </main>

<?php
} catch (Exception $msg) {
    echo "<main><h1>Página não encontrada</h1>";
    echo "<p>Desculpe-nos, mas essa publicação não existe ou foi retirada do ar.</p></main>";
}
Page::footer();
?>
