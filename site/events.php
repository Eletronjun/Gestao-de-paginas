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
    <h1>Eventos</h1>
    <img src="res/img/Circuito.png">
  </div>

  <section id="courses">
    <h2>Cursos</h2>
    <ul>
      <li>
        <figure><img src="res/img/Arduino.png"></figure>
        <h3>Arduino</h3>
        <p>Neste curso será ensinado conceitos básicos das placas de Arduino, não sendo necessário ter nenhum conhecimento prévio do assunto.<br>
          <a href="#Conteudo">Conteúdo Programático</a><br>
          <a href="#Inscricoes">Inscrições</a>
        </p>
      </li>
      <li>
        <figure><img src="res/img/Java.png"></figure>
        <h3>Java</h3>
        <p>O objetivo deste curso é introduzir conceitos básicos de Java, linguagem de programação orientada a objetos.<br>
          <a href="#Conteudo">Conteúdo Programático</a><br>
          <a href="#Inscricoes">Inscrições</a>
        </p>
      </li>
      <br>
      <li>
        <figure><img src="res/img/C.png"></figure>
        <h3>C Básico</h3>
        <p>Este curso tem como objetivo apresentar os conceitos básicos da linguagem C, uma das linguagens de programação mais conhecidas.<br>
          <a href="#Conteudo">Conteúdo Programático</a><br>
          <a href="#Inscricoes">Inscrições</a>
        </p>
      </li>
      <li>
        <figure><img src="res/img/C.png"></figure>
        <h3>C Avançado</h3>
        <p>Este curso tem como objetivo ensinar técnicas e conceitos mais avançados da linguagem de programação C.<br>
          <a href="#Conteudo">Conteúdo Programático</a><br>
          <a href="#Inscricoes">Inscrições</a>
        </p>
      </li>
    </ul>
  </section>

  <section id="eletronday">
    <h2>EletronDay</h2>
    <p>Com o intuito de divulgar e tornar mais próximos os graduandos do mercado de trabalho, a EletronJun se dedica a organização do EletronDay, buscando a cada ano apresentar um dos diversos ramos que a Engenharia Eletrônica oferece para atuação. O evento conta com a contribuição de excelentes profissionais, dispostos a um papo reto sobre as vantagens e dificuldades de seguir a carreira. Além de instrução educacional a respeito de conhecimentos importantes de se ter no currículo profissional de quem pretende atuar na área. São oferecidos workshops voltados a introdução e aprimoramento das técinicas e ferramentas necessárias a cada ramo, paletras e uma excelente Mesa Redonda. Confira abaixo temas e fotos dos eventos passados.</p>

    <div style="display:table; width:auto; margin:auto; padding-top:1.25rem;">
      <a href="#eletronday_1" style="margin-right:18.75rem;">
        <figure><img src="res/img/EletronDay2.png"></figure>
        <h3>1º Eletron<span class="green_font">Day</span></h3>
      </a>
      <a href="#eletronday_2">
        <figure><img src="res/img/EletronDay2.png"></figure>
        <h3>2º Eletron<span class="green_font">Day</span></h3>
      </a>
    </div>
  </section>

</main>
<?php
Page::footer();
Page::closeBody();

?>
