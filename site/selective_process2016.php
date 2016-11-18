<?php
    require_once __DIR__ . "/class/autoload.php";

    use \utilities\Session as Session;
    use \html\Page as Page;
    use \html\CommunityMenu as CommunityMenu;
    use \dao\WebPageDao as WebPageDao;
    use \dao\CategoryDao as CategoryDao;
    use \model\WebPage as WebPage;
    use \configuration\Globals as Globals;

    Page::header("Processo Seletivo 2016");

    $menu = new CommunityMenu();
    $menu->construct();

?>

<main>

  <div id="page_title">
    <h1>Processo Seletivo 2016</h1>
    <img src="res/img/Circuito.png"><br>
  </div>

  <section id="main_project">
    <figure>
      <img src="res/img/processo_seletivo2016.jpg">
    </figure>

    <p>É com muita alegria que a EletronJun anuncia a relação de alunos aprovados no Processo Seletivo de 2016! Agradecemos a participação de todos. Sejam bem-vindos.</p>
    <h5>Aprovados 2016</h5>

    <div class="flex">
      <ul class="list set_flex" style="font-size:0.9rem;">
        <li>Ana Paula Gomes Matos</li>
        <li>Breno Dantas Castro</li>
        <li>Bruno Deivid Mendes Costa</li>
        <li>Bruno Vinícius Barbosa Senise</li>
        <li>Daniel Martins C. de Medonça</li>
        <li>Edilberto Abraão Loiola Júnior</li>
        <li>Elisa Lima</li>
        <li>Erick Antonio Corrêa dos Reis</li>
        <li>Felipe Gustavo</li>
        <li>Gabriel Vinicius</li>
        <li>Gesiel dos Santos Freitas</li>
        <li>Guilherme Felix de Andrade</li>
        <li>Gustavo Queiroz Veloso</li>
        <li>Ingrid Miranda de Souza</li>
      </ul>
      <ul class="list set_flex" style="font-size:0.9rem;">
        <li>João Marcelo Martins de Lima</li>
        <li>João Vitor Rodrigues Baptista</li>
        <li>Lucas Machado de Moura e Silva</li>
        <li>Lucas Meneses Bandeira da Silva</li>
        <li>Marcos Adriano Nery de Abrantes</li>
        <li>Mateus de Oliveira Barbosa</li>
        <li>Matheus Phillipo Silvério Silva</li>
        <li>Mayara Barbosa dos Santos</li>
        <li>Mikhaelle de Carvalho Bueno</li>
        <li>Paulo Henrique M. de Carvalho F.</li>
        <li>Pedro Helias Carlos</li>
        <li>Rodrigo D. de Oliveira Jerônimo</li>
        <li>Vitor Carvalho de Almeida</li>
      </ul>
    </div>

</section>


</main>
<?php
Page::footer();
Page::closeBody();

?>
