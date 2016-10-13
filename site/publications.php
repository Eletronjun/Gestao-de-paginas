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

try {
    $page = WebPageDao::getPage($_GET['code']);

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
    <h1><?php echo $category->getName(); ?></h1>

    <h2><?php echo $page->getTitle(); ?></h2>

    <hr>
    <i> Autor: <?php echo $page->getAuthor(); ?> <br>
        Publicação: <?php echo $page->getCreationDate(); ?><br>
        Última atualização: <?php echo $page->getLastModified(); ?>
    </i>
    <hr>
    <?php echo $page->getContent(); ?>
    <img src="<?php echo FILE_PATCH . $page->getImage(); ?>" alt="<?php echo $category->getName(); ?>">
    <br>

    <div class="fb-like" data-href="<?php echo "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}"; ?>" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
    <br>
    <div class="fb-comments" data-href="<?php echo "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}"; ?>" data-numposts="5"></div>

<?php
} catch (Exception $msg) {
    echo "<h1>Página não encontrada</h1>";
    echo "<p>Desculpe-nos, mas essa publicação não existe ou foi retirada do ar.</p>";
}

Page::footer();
?>

