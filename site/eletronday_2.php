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
        <h1>2° Eletron<span class="green_font">Day</span></h1>
        <img src="res/img/Circuito.png">
      </div>

      <section>
        <figure class="left"><img src="res/img/EletronDay2.png"></figure>
        <h2>Engenharia e Biomédica</h2>
        <p>O 2º EletronDay veio com tudo, trazendo como tema principal para a vida dos graduandos Engenharia e Biomédica. Contando com um excelente repertório de palestras sobre os diversos ramos desta área, as oportunidades do meio acadêmico e a experiência de quem vivencia esse mercado de trabalho. Além de Workshops de Phyton e Machine Learning, modalidades essenciais para quem pretende atuar na área. Fechando o seu ponto alto em uma maravilhosa Mesa Redonda com quem realmente entende do assunto.</p>
        <p>A EletronJun agradece em especial a todo o corpo de formidáveis profisionais que se dispuseram a nos prestigiar com seus conhecimentos durante o evento.</p>
        <p>A todos aqueles que participaram, o nosso Muito Obrigado.</p>
      </section>

      <br>

      <section class="galery">
        <h4>Galeria de Fotos</h4>

        <div class="photo effect" style="display:block">
          <figure  style="background-image: url(res/img/eletronday2_abertura.jpg)">
            <div class="number">1 / 7</div>
            <figcaption>Abertura do Evento</figcaption>
          </figure>
        </div>

        <div class="photo effect">
          <figure  style="background-image: url(res/img/eletronday2_biomedica.jpg)">
            <div class="number">2 / 7</div>
            <figcaption>Palestra - Biomédica no Meio Acadêmico</figcaption>
          </figure>
        </div>

        <div class="photo effect">
          <figure  style="background-image: url(res/img/eletronday2_workshopPython.jpg)">
            <div class="number">3 / 7</div>
            <figcaption>Workshop de Introdução a Linguagem Python</figcaption>
          </figure>
        </div>

        <div class="photo effect">
          <figure  style="background-image: url(res/img/eletronday2_palestramercado.jpg)">
            <div class="number">4 / 7</div>
            <figcaption>Workshop de Introdução a Linguagem Python</figcaption>
          </figure>
        </div>

        <div class="photo effect">
          <figure  style="background-image: url(res/img/eletronday2_palestramercado2.jpg)">
            <div class="number">5 / 7</div>
            <figcaption>Workshop de Introdução a Linguagem Python</figcaption>
          </figure>
        </div>

        <div class="photo effect">
          <figure  style="background-image: url(res/img/eletronday2_mesaRedonda.jpg)">
            <div class="number">6 / 7</div>
            <figcaption>Mesa Redonda</figcaption>
          </figure>
        </div>

        <div class="photo effect">
          <figure  style="background-image: url(res/img/eletronday2_mesaRedonda2.jpg)">
            <div class="number">7 / 7</div>
            <figcaption>Mesa Redonda</figcaption>
          </figure>
        </div>

        <a class="prev" onclick="nextPhoto(-1)">&#10094;</a>
        <a class="next" onclick="nextPhoto(1)">&#10095;</a>

        <div class="dots_group">
          <span class="dot active" onclick="currentPhoto(1)"></span>
          <span class="dot" onclick="currentPhoto(2)"></span>
          <span class="dot" onclick="currentPhoto(3)"></span>
          <span class="dot" onclick="currentPhoto(4)"></span>
          <span class="dot" onclick="currentPhoto(5)"></span>
          <span class="dot" onclick="currentPhoto(6)"></span>
          <span class="dot" onclick="currentPhoto(7)"></span>
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
