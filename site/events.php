<?php
    require_once __DIR__ . "/class/autoload.php";

    use \utilities\Session as Session;
    use \html\Page as Page;
    use \html\CommunityMenu as CommunityMenu;
    use \dao\WebPageDao as WebPageDao;
    use \dao\CategoryDao as CategoryDao;
    use \model\WebPage as WebPage;
    use \configuration\Globals as Globals;

    Page::startHeader("Eletron Eventos");
    Page::styleSheet("events");
    Page::closeHeader();

    $menu = new CommunityMenu();
    $menu->construct();

?>

<main>

  <?php Page::pageTitle("Eventos");?>

  <section id="courses">
    <h3>Cursos</h3>
    <ul>
        <li>
          <figure><img src="res/img/Arduino.png"></figure>
          <h4>Arduino</h4>
          <p>Neste curso será ensinado conceitos básicos das placas de Arduino, não sendo necessário ter nenhum conhecimento prévio do assunto.
          </p>
        </li>
        <li>
          <figure><img src="res/img/Java.png"></figure>
          <h4>Java</h4>
          <p>O objetivo deste curso é introduzir conceitos básicos de Java, linguagem de programação orientada a objetos.
          </p>
        </li>
        <li>
          <figure><img src="res/img/C.png"></figure>
          <h4>C Básico</h4>
          <p>Este curso tem como objetivo apresentar os conceitos básicos da linguagem C, uma das linguagens de programação mais conhecidas.
          </p>
        </li>
        <li>
          <figure><img src="res/img/C.png"></figure>
          <h4>C Avançado</h4>
          <p>Este curso tem como objetivo ensinar técnicas e conceitos mais avançados da linguagem de programação C.
          </p>
        </li>
        <li>
          <figure><img src="res/img/VHDL.png"></figure>
          <h4>VHDL</h4>
          <p>Curso voltado a programação VHDL, introduzindo conceitos desde portas combinacionais à ULAs.<br>
          </p>
        </li>
    </ul>
  </section>

  <section id="eletronday">
    <h3>EletronDay</h3>
    <p>Com o intuito de divulgar e tornar mais próximos os graduandos do mercado de trabalho, a EletronJun se
    dedica a organização do EletronDay, buscando a cada ano apresentar um dos diversos ramos que a Engenharia
    Eletrônica oferece para atuação. O evento conta com a contribuição de excelentes profissionais, dispostos
    a um papo reto sobre as vantagens e dificuldades de seguir a carreira. Além de instrução educacional a
    respeito de conhecimentos importantes de se ter no currículo profissional de quem pretende atuar na área.
    São oferecidos workshops voltados a introdução e aprimoramento das técinicas e ferramentas necessárias a
    cada ramo, paletras e uma excelente Mesa Redonda. Confira abaixo temas e fotos dos eventos passados.</p>

    <div>
      <a href="eletronday_1.php">
        <figure><img src="res/img/EletronDay1.png"></figure>
        <h4>1º Eletron<span class="green_font">Day</span></h4>
      </a>
      <a href="eletronday_2.php">
        <figure><img src="res/img/EletronDay2.png"></figure>
        <h4>2º Eletron<span class="green_font">Day</span></h4>
      </a>
    </div>

  </section>


</main>
<?php
Page::footer();
Page::closeBody();

?>
