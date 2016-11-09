<?php
    require_once __DIR__ . "/class/autoload.php";

    use \html\Page as Page;
    use \html\CommunityMenu as CommunityMenu;
    use \model\WebPage as WebPage;
    use \configuration\Globals as Globals;

    Page::header(Globals::ENTERPRISE_NAME);

    $menu = new CommunityMenu();
    $menu->construct();

?>

<main>

  <h1></h1>
  <figure id="img_error">
    <img src="res/img/erro404.jpg">
  </figure>

</main>

<?php
Page::footer();
Page::closeBody();

?>
