<?php
    require_once __DIR__ . "/class/autoload.php";

    use \utilities\Session as Session;
    use \html\Page as Page;
    use \html\CommunityMenu as CommunityMenu;
    use \configuration\Globals as Globals;

    Page::startHeader("Processo Seletivo 2016");
      Page::styleSheet("short_publication");
      Page::styleSheet("selective_process");
    ?>
      <!--style>

        .main section {
          margin-bottom: 2rem;
          max-width:35rem;
          width:100%;
        }

        p {
          text-align: justify;
        }

        .main figure {
          margin: auto;
          margin-bottom: 2rem;
        }

        .main ul {
          padding: 0;
          margin-top: 1rem;
          text-align: left;
        }

        @media only screen and (min-width:617px) {
          .main ul {
            -webkit-column-count: 2;
            -moz-column-count: 2;
            column-count: 2;
          }
        }

      </style-->
    <?php
    Page::closeHeader();

    $menu = new CommunityMenu();
    $menu->construct();

?>

<main>

  <?php Page::pageTitle("Processo Seletivo 2016");?>

  <div id="short_content" style="max-width:700px;width:100%">

    <article>
      <p>É com muita alegria que a EletronJun anuncia a relação de alunos aprovados no Processo Seletivo de 2016! Agradecemos a participação de todos. Sejam bem-vindos.</p>
    </article>

    <figure><img src="res/img/processo_seletivo2016.jpg"></figure>

    <section>
      <h5 class="center">Aprovados 2016</h5>
      <ul>
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
    </section>
  </div>
</main>
<?php
Page::footer();
Page::closeBody();

?>
