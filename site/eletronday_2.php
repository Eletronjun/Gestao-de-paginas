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
    Page::closeHeader();

    $menu = new CommunityMenu();
    $menu->construct();

?>
    <main>

      <div id="page_title">
        <h1>#° Eletron<span class="green_font">Day</span></h1>
        <img src="res/img/circuito_maior.png">
      </div>

      <section>
        <figure class="left"><img src="res/img/EletronDay2.png"></figure>
        <h2>Engenharia e Biomédica</h2>
        <p>O 2º EletronDay veio com tudo, trazendo como tema principal para a vida dos graduandos Engenharia e Biomédica. Contando com um excelente repertório de palestras sobre os diversos ramos desta área, as oportunidades do meio acadêmico e a experiência de quem vivencia esse mercado de trabalho. Além de Workshops de Phyton e Machine Learning, modalidades essenciais para quem pretende atuar na área. Fechando o seu ponto alto em uma maravilhosa Mesa Redonda com quem realmente entende do assunto.</p>
        <p>A EletronJun agradece em especial a todo o corpo de formidáveis profisionais que se dispuseram a nos prestigiar com seus conhecimentos durante o evento.</p>
        <p>A todos aqueles que participaram, o nosso Muito Obrigado.</p>
      </section>

      <br>
    </main>

<?php
} catch (Exception $msg) {
    echo "<h1>Página não encontrada</h1>";
    echo "<p>Desculpe-nos, mas essa publicação não existe ou foi retirada do ar.</p>";
}
Page::footer();
?>
