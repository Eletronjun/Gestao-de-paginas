<?php
    require_once __DIR__ . "/../class/autoload.php";

    use \utilities\Session as Session;
    use \html\Page as Page;
    use \html\AdministratorMenu as AdministratorMenu;
    use \configuration\Globals as Globals;
    use \dao\MemberDao as MemberDao;
    use \model\Member as Member;

    Page::startHeader(Globals::ENTERPRISE_NAME);
    Page::styleSheet("form");
    Page::styleSheet("user");
    Page::closeHeader();

    $session = new Session();
    $session->verifyIfSessionIsStarted();

    $menu = new AdministratorMenu();
    $menu->construct();

    $members = MemberDao::allMembers();
?>
  <main style="margin-top: 2rem;">
    <section>
      <h1>Gerenciar Usuários</h1>
    </section>
    <section>
        <button onclick="location.href='registerMember.php';">Novo</button>
    </section>
    <section>
    <table>
        <tr>
            <th><h2>Nome Usuário</h2></th>
            <th><h2>Editar</h2></th>
            <th><h2>Remover</h2></th>
        </tr>
        <?php
        for ($i=0; $i < count($members); $i++) {
            $name = (strlen($members[$i]->getName()) > 50) ?
                substr($members[$i]->getName(), 0, 50) . "..." :
                $members[$i]->getName();
            echo "<tr>
                <td>{$name}</td>
                <td class='center'>
                    <a href='updateMember.php?email={$members[$i]->getemail()}'>
                    <img src='" . IMG_PATCH . "Caneta.png' alt='Editar' />
                    </a>
                </td>
                <td class='center'>
                    <a href='removeMember.php?email={$members[$i]->getemail()}'>
                    <img src='" . IMG_PATCH . "Lixeira_Usuario.png' alt='Editar' />
                    </a>
                </td>
            </tr>";
        }
        ?>
    </table>
  </main>
<?php
    Page::footer();
    Page::closeBody();
?>
