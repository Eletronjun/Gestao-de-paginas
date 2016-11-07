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

<main>

  <div id="page_title">
    <h1>Eletron<span class="green_font">Jun</span></h1>
    <img src="res/img/Circuito.png"><br>
  </div>

  <p>Com o intuito de aplicar e repassar os conhecimentos adquiridos academicamente ao mercado de trabalho, de gerar uma visão empreendedora em estudantes universitários e suprir as necessidades do campus Gama da Universidade de Brasília, surgiu a ideia da criação de uma empresa júnior capaz de desenvolver projetos em grupo, aplicar cursos preparatórios para os estudantes e para o público em geral e trazer mais conhecimento para os graduandos.</p>

  <p>A Eletronjun - Engenharia Eletrônica Júnior foi criada em 2013, por alunos do curso de Engenharia Eletrônica da Universidade de Brasília, e, desde então, vem aumentando seus horizontes e crescendo cada vez mais como empresa. Com diversos projetos voltados tanto para a universidade quanto para o mercado, a Eletronjun pretende alcançar, cada vez mais, um maior número de pessoas com suas ideias.</p>

  <p>A empresa busca sempre integrar a comunidade do Gama em suas iniciativas, além de propor parceirias com o campo industrial regional, almejando tornar mais acessível o conhecimento a toda a comunidade e desenvolver o meio acadêmico-científico com o auxílio empresarial.</p><br><br>

  <h2>Nossos Valores</h2>

  <p>A EletronJun sempre busca trazer ao seu ambiente de trabalho valores como ética, transparência, respeito a todos e aos serviços prestados. Visando atingir a qualidade em todos os nossos projetos e a Democracia no processo administrativo-decisório. Valorizando os nossos profissinais e os preparando não como indivíduos, mas como membros importantes de um coletivo, o qual escreve a nossa história.</p><br><br>


</main>
<?php
Page::footer();
Page::closeBody();

?>
