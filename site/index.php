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

<h1>Eletronjun - Engenharia Eletrônica Jr.</h1>

<h2>Últimas Publicações</h2>
<?php
foreach (WebPageDao::returnLast4() as $code => $title) {
    echo "<a href=\"publications.php?code={$code}\">{$title}</a><br>";
}
foreach (CategoryDao::returnActiveCategories() as $code => $name) {
    echo "<p><strong>{$name}</strong></p>";
    $hasPage = false;
    foreach (WebPageDao::returnLast5byCategory($code) as $pageCode => $title) {
        $hasPage = true;
        echo "<a href=\"publications.php?code={$pageCode}\">{$title}</a><br>";
    }
    if (!$hasPage) {
        echo "Não há Publicações";
    } else {
        //Nothing to do
    }
}

Page::footer();
Page::closeBody();

?>
