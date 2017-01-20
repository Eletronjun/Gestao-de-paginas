<?php
    require_once __DIR__ . "/class/autoload.php";

    use \utilities\Session as Session;
    use \html\Page as Page;
    use \html\CommunityMenu as CommunityMenu;
    use \dao\WebPageDao as WebPageDao;
    use \dao\CategoryDao as CategoryDao;
    use \model\WebPage as WebPage;
    use \configuration\Globals as Globals;

    Page::startHeader(Globals::ENTERPRISE_NAME);
    Page::styleSheet("enterprise");
    Page::closeHeader();

    $menu = new CommunityMenu();
    $menu->construct();

?>

<main id="enterprise">

  <div id="page_title">
    <h1>Eletron<span class="green_font">Jun</span></h1>
    <img src="res/img/Circuito.png"><br>
  </div>

  <section>
    <h3 style="text-align:center;">Quem somos?</h3>

    <p>Com o intuito de aplicar e repassar os conhecimentos adquiridos academicamente ao mercado de trabalho, de gerar uma visão empreendedora em estudantes universitários e suprir as necessidades do campus Gama da Universidade de Brasília, surgiu a ideia da criação de uma empresa júnior capaz de desenvolver projetos em grupo, aplicar cursos preparatórios para os estudantes e para o público em geral e trazer mais conhecimento para os graduandos.</p>

    <p>A EletronJun - Engenharia Eletrônica Júnior foi criada em 2013, por alunos do curso de Engenharia Eletrônica da Universidade de Brasília, e, desde então, vem aumentando seus horizontes e crescendo cada vez mais como empresa. Com diversos projetos voltados tanto para a universidade quanto para o mercado, a EletronJun pretende alcançar, cada vez mais, um maior número de pessoas com suas ideias.</p>

    <p>A empresa busca sempre integrar a comunidade do Gama em suas iniciativas, além de propor parcerias com o campo industrial regional, almejando tornar mais acessível o conhecimento a toda a comunidade e desenvolver o meio acadêmico-científico com o auxílio empresarial.</p>
  </section>

  <section id="enterprise_links">
    <div>
      <div>
        <h4>
          <a href="etron.php">Conheça nosso<br>Mascote</a>
        </h4>
      </div>
    </div>
    <div>
      <div>
        <h4>
          <a href="members.php">Membros</a>
        </h4>
      </div>
    </div>
    <div>
        <h4>
          <a href="<?php echo PROJECT_ROOT ?>res/doc/Manual_de_Identidade_Visual_2016.pdf">Manual de<br>Identidade Visual</a>
        </h4>
    </div>
  </section>

  <section id="section_logo">
    <div>
      <h3>Missão</h3>
      <p>Atender com excelência às demandas de nossos clientes a partir do desenvolvimento e oferta de produtos e serviços que contribuam para a melhoria da qualidade de vida das pessoas, atuando na área de engenharia eletrônica de forma sustentável.</p>
    </div>
    <figure>
      <img src="res/img/enterprise_ci.png">
    </figure>
    <div>
      <h3>Valores</h3>
      <p>A EletronJun sempre busca trazer ao seu ambiente de trabalho valores como ética, transparência,
      proatividade, comprometimento, união, objetividade e meritocracia visando atingir a qualidade em
      todos os nossos projetos e processos.</p>
    </div>
  </section>

  <section>
    <h3>Movimento Empresa Junior</h3>
    <p>Composto por universitários integrantes das empresas juniores, empresas cuja gestão e
    organização são exercidas por estudantes, o Movimento Empresa Júnior (MEJ) é um dos maiores
    movimentos jovens e estudantis do mundo.</p>
    <p>O MEJ surgiu na França, em 1967. Criado por estudantes da ESSCS - L’École Supérieure des
    Sciences Economiques et Commerciales, em Paris, com o sentimento da necessidade de conhecimento
    de estratégias e ferramentas que viriam a utilizar no mercado de trabalho. Assim, fundaram a
    Junior ESSEC Conseil, uma associação de estudantes com os mesmos princípios de colocar em
    prática seus conhecimentos acadêmicos.</p>
    <p>No Brasil, a primeira empresa júnior foi fundada em 1988, em São Paulo. Hoje, nosso país
    tem a maior concentração de empresas juniores do planeta, preparando cada vez mais estudantes
    para o pós-universidade e contribuindo com, segundo dados de 2013 da Concentro, R$ 9,5 milhões
    para o PIB nacional.</p>
    <p>A participação em empresas juniores proporciona aos estudantes conhecimento prático
    relacionado à área que estudam, incentivando a inovação e o empreendedorismo e, assim,
    preparando estudantes universitários para as demandas do mercado de trabalho.</p>
    <p>O MEJ tem impacto positivo também na sociedade, através de empresas juniores fornecendo
    serviços de boa qualidade com preços acessíveis, dos quais toda a arrecadação é utilizada
    apenas para a manutenção e crescimento da empresa. Compromisso com resultados, transparência
    e sinergia são alguns dos valores que sustentam o Movimento, capaz de transformar
    universitários em empreendedores a partir do aprendizado por projetos, por gestão e por
    cultura empreendedora.</p>
  </section>

  <h3 style="padding-top:2rem;">Parceiros</h3>
  <!--The margin-top attributes were calculated individually for each logo-->
  <section class="partner">
      <figure>
        <a href="http://www.zenitaerospace.com"><img src="res/img/Zenit.png"></a>
      </figure>

      <figure>
        <a href="http://www.matrizenergia.com"><img src="res/img/Matriz.png"></a>
      </figure>

      <figure>
        <a href="http://www.facebook.com/Orcestra.Ej"><img src="res/img/orc_estra.png"></a>
      </figure>
      <figure>
        <a href="http://www.fga.unb.br/lei"><img src="res/img/LEI.png"></a>
      </figure>
      <figure>
        <a href="http://www.facebook.com/engrenaengenharia"><img src="res/img/engrena.png"></a>
      </figure>
      <figure>
        <a href="http://www.facebook.com/labprofga"><img src="res/img/LabPro.png"></a>
      </figure>
  </section>

</main>
<?php
Page::footer();
Page::closeBody();

?>
