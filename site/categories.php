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
?>
    
    <h1><?php echo CategoryDao::findCategory($_GET['code'])->getName(); ?></h1>

    <table>
    <tr>
        <td>Título</td>
        <td>Data de Publicação</td>
    </tr>
    <?php
    
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

<?php
} catch (Exception $msg) {
    echo "<h1>Página não encontrada</h1>";
    echo "<p>Desculpe-nos, mas essa publicação não existe ou foi retirada do ar.</p>";
}

Page::footer();
?>

