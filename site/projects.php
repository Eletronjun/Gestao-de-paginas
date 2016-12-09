<?php
    require_once __DIR__ . "/class/autoload.php";

    use \html\Page as Page;
    use \html\CommunityMenu as CommunityMenu;
    use \configuration\Globals as Globals;

    Page::startHeader(Globals::ENTERPRISE_NAME);
    Page::styleSheet("projects");
    Page::closeHeader();

    $menu = new CommunityMenu();
    $menu->construct();

?>

<main>

  <div id="page_title">
    <h1>Projetos</h1>
    <img src="res/img/Circuito.png">
  </div>

  <section id="main_project">
    <figure><img src="res/img/Projetos.jpg"></figure>
    <p>A EletronJun procura sempre se envolver em projetos de engenharia, que possibilitem aos membros não somente adiquirir conhecimento, mas também se preparar para o mercado de trabalho, colocando na prática o que é aprendido em um curso de engenharia.</p>
    <p>Conheça um pouco mais dos nossos projetos abaixo.</p>
  </section>

  <section class="project_banner">

    <figure><img src="res/img/video_aulas.png"></figure>
    <h5>Video-aulas</h5>
    <p>O projeto de vídeo-aulas surge como complemento à criação do canal EletronJun, onde serão expostos vídeos didáticos e entrevistas com figuras importantes dentro do curdo de Engenharia Eletrônica da <abbr title="Faculdade do Gama">FGA</abbr> e especialistas em demais áreas de tecnologia e eletrônica.</p>
    <p>Assim, as vídeo-aulas propôem disseminar conhecimento prático e teórico em eletrônica de forma a permitir que leigos na área possam realizar sem dificuldades as atividades propostas e construir um conhecimento sólido sobre eletrônica. Finalmente, as vídeo-aulas servirão como complemento para aulas presenciais ministradas pela EletronJun.</p>
  </section>

  <section class="project_banner">
    <figure><img src="res/img/impressora_3d.png"></figure>
    <h5>Impressora 3d</h5>
    <p>A EletronJun conta com uma impressora 3D, modelo Mendel Prusa, com ela fornecemos a facilidade de imprimir projetos e adquirir acessórios personalizados tanto a clientes internos e externos a nossa comunidade acadêmica. Atualmente, nossa equipe está trabalhando na manuntenção do nosso equipamento para melhorar nossa qualidade de impressão.</p>
    <p>Em breve, disponibilizaremos um catálogo de peças com acessórios personalizados e um espaço para enviarem seus projetos para levantar o orçamento.</p>
  </section>

</main>
<?php
Page::footer();
Page::closeBody();

?>
