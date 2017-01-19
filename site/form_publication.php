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
      <main>

        <div id="page_title">
          <h1><?php echo $category->getName(); ?></h1>
          <img src="res/img/Circuito.png">
        </div>

        <header>
          <h2><?php echo $page->getTitle(); ?></h2>
        </header>

        <section style="text-align:left;margin-bottom:3rem;width:100%;">
          <?php echo $page->getContent(); ?>
        </section>

        <iframe src="<?php echo $page->getForm(); ?>">Carregando…</iframe>

      </main>

<?php
} catch (Exception $msg) {
    echo "<h1>Página não encontrada</h1>";
    echo "<p>Desculpe-nos, mas essa publicação não existe ou foi retirada do ar.</p>";
}
  Page::footer();
  Page::closeBody();
?>
