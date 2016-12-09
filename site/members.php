<?php
    require_once __DIR__ . "/class/autoload.php";

    use \html\Page as Page;
    use \html\CommunityMenu as CommunityMenu;

    Page::startHeader("Membros");
    Page::styleSheet("members");
    Page::closeHeader();

    $menu = new CommunityMenu();
    $menu->construct();

?>

<main>

  <div id="page_title">
    <h1>Membros</h1>
    <img src="res/img/Circuito.png"><br>
  </div>

  <div id="organization_chart">
    <div class="flex">
      <figure class="president set_flex">
        <img src="res/img/Presidente_Organizacional.png">
      </figure>
      <figure class="president set_flex">
        <img src="res/img/Presidente_Institucional.png">
      </figure>
    </div>
    <div class="flex">
      <figure class="director set_flex">
        <img src="res/img/Diretor_ADM.png">
      </figure>
      <figure class="director set_flex">
        <img src="res/img/Diretor_GPP.png">
      </figure>
      <figure class="director set_flex">
        <img src="res/img/Diretor_Marketing.png">
      </figure>
      <figure class="director set_flex">
        <img src="res/img/Diretor_Projetos.png">
      </figure>
    </div>
  </div>

  <div class="flex acessor">
    <div class="set_flex">
      <p><strong>Acessores Administrativos Financeiros</strong></p>
      <p>Nome do Acessor</p>
      <p>Nome do Acessor</p>
      <p>Nome do Acessor</p>
      <p>Nome do Acessor</p>
      <p>Nome do Acessor</p>
      <p>Nome do Acessor</p>
      <p>Nome do Acessor</p>
      <p>Nome do Acessor</p>
      <p>Nome do Acessor</p>
      <p>Nome do Acessor</p>
    </div>
    <div class="set_flex">
      <p><strong>Acessores de Gestão de Pessoas e Processos</strong></p>
      <p>Nome do Acessor</p>
      <p>Nome do Acessor</p>
      <p>Nome do Acessor</p>
      <p>Nome do Acessor</p>
      <p>Nome do Acessor</p>
      <p>Nome do Acessor</p>
      <p>Nome do Acessor</p>
      <p>Nome do Acessor</p>
      <p>Nome do Acessor</p>
      <p>Nome do Acessor</p>
    </div>
    <div class="set_flex">
      <p><strong>Acessores de Marketing</strong></p>
      <p>Nome do Acessor</p>
      <p>Nome do Acessor</p>
      <p>Nome do Acessor</p>
      <p>Nome do Acessor</p>
      <p>Nome do Acessor</p>
      <p>Nome do Acessor</p>
      <p>Nome do Acessor</p>
      <p>Nome do Acessor</p>
      <p>Nome do Acessor</p>
      <p>Nome do Acessor</p>
    </div>
    <div class="set_flex">
      <p><strong>Acessores de Projetos</strong></p>
      <p>Nome do Acessor</p>
      <p>Nome do Acessor</p>
      <p>Nome do Acessor</p>
      <p>Nome do Acessor</p>
      <p>Nome do Acessor</p>
      <p>Nome do Acessor</p>
      <p>Nome do Acessor</p>
      <p>Nome do Acessor</p>
      <p>Nome do Acessor</p>
      <p>Nome do Acessor</p>
    </div>
  </div>

  <figure id="team">
  </figure>

</main>
<?php
Page::footer();
Page::closeBody();

?>
