<?php
    require_once __DIR__ . "/class/autoload.php";

    use \utilities\Date as Date;
    use \html\Page as Page;
    use \html\CommunityMenu as CommunityMenu;
    use \dao\WebPageDao as WebPageDao;
    use \dao\CategoryDao as CategoryDao;
    use \model\WebPage as WebPage;
    use \configuration\Globals as Globals;


try {

    Page::startHeader("1º EletronDay");
    Page::styleSheet("eletronday");
    Page::styleSheet("galery");
    Page::JavaScript("galery");
    Page::closeHeader();

    $menu = new CommunityMenu();
    $menu->construct();

?>
    <main>

      <div id="page_title">
        <h1>1° Eletron<span class="green_font">Day</span></h1>
        <img src="res/img/Circuito.png">
      </div>

      <section>
        <figure class="left"><img src="res/img/EletronDay1.png"></figure>
        <h2>Engenharia Eletrônica</h2>
        <p>A EletronJun tem o orgulho de anunciar o EletronDay. EletronDay é um evento feito para a comunidade acadêmica e possui como intuito evidenciar características inerentes ao curso de Engenharia Eletrônica. O evento é GRATUITO, pois a Eletronjun irá bancar todos os custos. Considerem isso como um presente da Eletronjun para nós alunos.</p>
        <p>Para animar mais ainda, teremos sorteios de prêmios, como a camisa da Eletronjun e coffee break gratuito para todos os inscritos! Teremos diversas atrações/mini-cursos: Arduíno Básico, MSP 430, Eletrônica Básica, Matlab Express. Teremos também a mesa redonda, em que os alunos já formados em Engenharia Eletrônica e os formandos irão evidenciar o que acharam do curso, suas expectativas para o mercado futuro, entre outros assuntos. Chamamos de mesa redonda, porque não haverá palestra, será um bate papo mesmo em que todos poderão expor suas opiniões.</p>
        <p>Teremos a presenças dos ilustres professores em workshops: Adson Rocha, Euler Garcia, Andrade Marcelino, Diogo Caetano.</p>
      </section>


      <section class="galery">
        <h4>Galeria de Fotos</h4>

        <div class="photo effect" style="display:block">
          <figure  style="background-image: url(res/img/eletronday1_1.jpg)">
            <div class="number">1 / 4</div>
          </figure>
        </div>

        <div class="photo effect">
          <figure  style="background-image: url(res/img/eletronday1_2.jpg)">
            <div class="number">2 / 4</div>
          </figure>
        </div>

        <div class="photo effect">
          <figure  style="background-image: url(res/img/eletronday1_3.jpg)">
            <div class="number">3 / 4</div>
            <figcaption>Equipe EletronJun</figcaption>
          </figure>
        </div>

        <div class="photo effect">
          <figure  style="background-image: url(res/img/eletronday1_4.jpg)">
            <div class="number">4 / 4</div>
            <figcaption>Comissão Organizadora e Participantes</figcaption>
          </figure>
        </div>

        <a class="prev" onclick="nextPhoto(-1)">&#10094;</a>
        <a class="next" onclick="nextPhoto(1)">&#10095;</a>

        <div class="dots_group">
          <span class="dot active" onclick="currentPhoto(1)"></span>
          <span class="dot" onclick="currentPhoto(2)"></span>
          <span class="dot" onclick="currentPhoto(3)"></span>
          <span class="dot" onclick="currentPhoto(4)"></span>
        </div>

      </section>
    </main>

<?php
} catch (Exception $msg) {
    echo "<h1>Página não encontrada</h1>";
    echo "<p>Desculpe-nos, mas essa publicação não existe ou foi retirada do ar.</p>";
}
Page::footer();
?>
