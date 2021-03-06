<?php
    require_once __DIR__ . "/class/autoload.php";

    use \utilities\MemberContact as MemberContact;
    use \html\Page as Page;
    use \html\CommunityMenu as CommunityMenu;
    use \dao\MemberDao as MemberDao;
    use \model\Member as Member;

    Page::startHeader("Membros");
    Page::styleSheet("members");
    Page::closeHeader();

    $menu = new CommunityMenu();
    $menu->construct();

    //Offices
    const ORGANIZATIONAL = 1;
    const INSTITUTIONAL = 2;
    const DIRECTOR = 3;
    const MANAGER = 4;
    const ASSESSOR = 5;

    //Directorates
    const ADM = 1;
    const GPP = 2;
    const MARKETING = 3;
    const PROJECTS = 4;
    const PRESIDENCY = 5;

?>

<main>

  <?php Page::pageTitle("Membros");?>

  <?php try { ?>
  <section id="organization_chart">
    <div>
      <?php

        echo "<section class=\"memberContact\">";
        $members = MemberDao::getMembersByOffice(ORGANIZATIONAL, PRESIDENCY);
        if(isset($members[0])) {
          MemberContact::memberContact($members[0]);
        }  else {
          MemberContact::memberContactNull("Presidente Organizacional");
        }
        echo "</section>";

        echo "<section class=\"memberContact\">";
        $members = MemberDao::getMembersByOffice(INSTITUTIONAL, PRESIDENCY);
        if(isset($members[0])) {
          MemberContact::memberContact($members[0]);
        }  else {
          MemberContact::memberContactNull("Presidente Institucional");
        }
        echo "</section>";

      ?>
    </div>
    <figure><img src="res/img/Organograma.png"></figure>
    <div>
      <?php

        echo "<section class=\"memberContact\">";
        $members = MemberDao::getMembersByOffice(DIRECTOR, ADM);
        if(isset($members[0])) {
          MemberContact::memberContact($members[0], "Administrativo Financeiro");
        } else {
          MemberContact::memberContactNull("Diretor Administrativo Financeiro");
        }
        echo "</section>";

        echo "<section class=\"memberContact\">";
        $members = MemberDao::getMembersByOffice(DIRECTOR, GPP);
        if(isset($members[0])) {
          MemberContact::memberContact($members[0], "de Gestão de Pessoas e Processos");
        } else {
          MemberContact::memberContactNull("Diretor de Gestão de Pessoas e Processos");
        }
        echo "</section>";

        echo "<section class=\"memberContact\">";
        $members = MemberDao::getMembersByOffice(DIRECTOR, MARKETING);
        if(isset($members[0])) {
          MemberContact::memberContact($members[0], "de Marketing");
        }  else {
          MemberContact::memberContactNull("Diretor de Marketing");
        }
        echo "</section>";

        echo "<section class=\"memberContact\">";
        $members = MemberDao::getMembersByOffice(DIRECTOR, PROJECTS);
        if(isset($members[0])) {
          MemberContact::memberContact($members[0], "de Projetos");
        }   else {
          MemberContact::memberContactNull("Diretor de Projetos");
        }
        echo "</section>";

      ?>
    </div>
    <div>
      <?php

        echo "<section class=\"advisors\">";
        echo "<strong>Acessores<br>Administrativos Financeiros</strong>";
        $members = MemberDao::getMembersByOffice(MANAGER, ADM);
        foreach($members as $member){
          echo "<p>{$member->getNick()}</p>";
        }
        $members = MemberDao::getMembersByOffice(ASSESSOR, ADM);
        foreach($members as $member){
          echo "<p>{$member->getNick()}</p>";
        }
        echo "</section>";

        echo "<section class=\"advisors\">";
        echo "<strong>Acessores de Gestão de<br>Pessoas e Processos</strong>";
        $members = MemberDao::getMembersByOffice(MANAGER, GPP);
        foreach($members as $member){
          echo "<p>{$member->getNick()}</p>";
        }
        $members = MemberDao::getMembersByOffice(ASSESSOR, GPP);
        foreach($members as $member){
          echo "<p>{$member->getNick()}</p>";
        }
        echo "</section>";

        echo "<section class=\"advisors\">";
        echo "<strong>Acessores<br>de Marketing</strong>";
        $members = MemberDao::getMembersByOffice(MANAGER, MARKETING);
        foreach($members as $member){
          echo "<p>{$member->getNick()}</p>";
        }
        $members = MemberDao::getMembersByOffice(ASSESSOR, MARKETING);
        foreach($members as $member){
          echo "<p>{$member->getNick()}</p>";
        }
        echo "</section>";

        echo "<section class=\"advisors\">";
        echo "<strong>Acessores<br>de Projetos</strong>";
        $members = MemberDao::getMembersByOffice(MANAGER, PROJECTS);
        foreach($members as $member){
          echo "<p>{$member->getNick()}</p>";
        }
        $members = MemberDao::getMembersByOffice(ASSESSOR, PROJECTS);
        foreach($members as $member){
          echo "<p>{$member->getNick()}</p>";
        }
        echo "</section>";

      ?>
    </div>
  </section>

  <figure id="team">
    <img src="res/img/team_eletronjun2017.jpg">
  </figure>

<?php
  } catch (Exception $msg) {
  echo "<script>alert(\"{$msg}\");</script>";
}
?>

</main>
<?php
Page::footer();
Page::closeBody();

?>
