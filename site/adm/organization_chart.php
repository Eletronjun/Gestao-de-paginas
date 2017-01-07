<?php
    require_once __DIR__ . "/../class/autoload.php";

    use \utilities\Session as Session;
    use \html\Page as Page;
    use \html\AdministratorMenu as AdministratorMenu;
    use \configuration\Globals as Globals;

    Page::startHeader("Organograma");
    Page::styleSheet("user");
    Page::styleSheet("form");
    echo "<script src=\"../css/ckeditor/ckeditor.js\"></script>";
    Page::closeHeader();

    $session = new Session();
    $session->verifyIfSessionIsStarted();

    $menu = new AdministratorMenu();
    $menu->construct();


?>
<main>
  <h1>Gerenciar Organograma</h1>

  <form class="flex" enctype="multipart/form-data">
    <div class="set_flex padding_right">
      <fieldset>
        <label>Presidente Organizacional:</label>
        <input type="file" name="organizationalPresident">
      </fieldset>
      <fieldset>
        <label>Diretor(a) ADM-FIN:</label>
        <input type="file" name="directorADM">
        <label>Acessores ADM-FIN:</label>
        <textarea id="advisorsADM" name="advisorsADM"></textarea><br><br>
        <script>CKEDITOR.replace( 'advisorsADM' );</script>
      </fieldset>
      <fieldset>
        <label>Diretor(a) MKT:</label>
        <input type="file" name="directorMKT">
        <label>Acessores MKT:</label>
        <textarea id="advisorsMKT" name="advisorsMKT"></textarea><br><br>
        <script>CKEDITOR.replace( 'advisorsMKT' );</script>
      </fieldset>
    </div>
    <div class="set_flex padding_left">
      <fieldset>
        <label>Presidente Institucional:</label>
        <input type="file" name="institutionalPresident">
      </fieldset>
      <fieldset>
        <label>Diretor(a) GPP:</label>
        <input type="file" name="directorGPP">
        <label>Acessores GPP:</label>
        <textarea id="advisorsGPP" name="advisorsGPP"></textarea><br><br>
        <script>CKEDITOR.replace( 'advisorsGPP' );</script>
      </fieldset>
      <fieldset>
        <label>Diretor(a) Projetos:</label>
        <input type="file" name="directorProjects">
        <label>Acessores Projetos:</label>
        <textarea id="advisorsProjects" name="advisorsProjects"></textarea><br><br>
        <script>CKEDITOR.replace( 'advisorsProjects' );</script>
      </fieldset>
    </div>
  </form>

</main>

<?php
    Page::footer();
    Page::closeBody();
?>
