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
  <main>
    <h1>Gerenciar Usuários</h1>

    <div style="margin-top:4.375rem;margin-bottom:3.125rem"><button onclick="location.href='registerMember.php';">Novo</button></div>

    <table id="user_table">
      <tr>
          <th class="col_1"><h3>Nome Usuário</h3></th>
          <th class="col_2"><h3>Editar</h3></th>
          <th class="col_2"><h3>Remover</h3></th>
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
                  <a href='../controller/removeMember.php?email={$members[$i]->getemail()}'
                      OnClick=\"return confirm('AÇÃO IRREVERSIVEL!\\nDeseja realmente remover os dados de\\n{$name}');\" >
                  <img src='" . IMG_PATCH . "Lixeira_Usuario.png' alt='Exluir' />
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
