<?php
    require_once __DIR__ . "/class/autoload.php";

    use \html\Page as Page;
    use \html\CommunityMenu as CommunityMenu;

    Page::header("Processo Seletivo 2016");

    $menu = new CommunityMenu();
    $menu->construct();

?>

<main>

  <div id="page_title">
    <h1>Etron</h1>
    <img src="res/img/Circuito.png"><br>
  </div>

  <figure class="left" style="margin-right:4.375rem;">
    <img src="res/img/Etron.png">
  </figure>

  <br><br><br>
  <p>Você faz parte da história da EletronJun. Com sua ajuda, o Mascote Oficial da empresa foi decidido e é com muito prazer que apresentamos o ganhador das votações, o Etron!</p>

  <p>As votações foram bem acirradas, mas no final o Etron conseguiu ganhar o carinho do público. Obrigado pela participação de todos nessa etapa importante da nossa história!</p>

  <p>O Etron é um Tachyglossus aculeatus, conhecidos popurlamente como equidina e se assemelha exteriormente a um Ouriço, com o corpo coberto de espinhos e pelagem crespa, e vive na Austrália e Nova Guiné. A equidna é o primeiro animal terrestre com sistema eletrorreceptivo, habilidade biológica em detectar impulsos elétricos.</p>

  <p>Existem algumas equidnas que ficaram famosas, como o Knucles de games Sonic the Hedgehog, a mascote Millie das olimpíadas de 2000 também era uma equidna e na moeda de cinco centavos do dólar australiano pode ser encontrado o desenho de uma equidna.</p>


</main>
<?php
Page::footer();
Page::closeBody();

?>
