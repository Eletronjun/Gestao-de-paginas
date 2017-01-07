<?php
    require_once __DIR__ . "/../class/autoload.php";

    use \utilities\Session as Session;
    use \html\Page as Page;
    use \html\AdministratorMenu as AdministratorMenu;
    use \configuration\Globals as Globals;

    Page::startHeader(Globals::ENTERPRISE_NAME);
    Page::styleSheet("form");
    Page::styleSheet("user");
    Page::closeHeader();

    $session = new Session();
    $session->verifyIfSessionIsStarted();

    $menu = new AdministratorMenu();
    $menu->construct();


?>
<main>
  <h1></h1>
  <section class="left" style="margin-bottom:3.125rem">
    <h2>Bem-vindo à EletronJun!</h2>
    <p style="font-size:1.5625rem;margin-top:-1.7rem;">Camila Ferrer</p>
  </section>

  <?php
    echo "<div id=\"user_img\" style=\"background-image:url('../res/img/eletronday1_1.jpg')\">
    </div>";
  ?>

  <form>
    <div class="double_column">
      <fieldset>
        <label>Nome Completo</label>
        <input type="text">
        <label>NickName</label>
        <input type="text">
        <label>Sexo</label><br>
        <select>
          <option>Feminino</option>
          <option>Masculino</option>
        </select><br>
        <label>Data de Nascimento</label>
        <input type="date">
        <label>RG</label>
        <input type="text">
        <label>CPF</label>
        <input type="text">
      </fieldset>
      <fieldset>
        <label>Senha</label>
        <input type="password">
        <label>Confirmação de Senha</label>
        <input type="password">
      </fieldset>
      <fieldset>
        <label>Matrícula</label>
        <input type="text">
        <label>Curso</label>
        <input type="text">
        <label>Semestre</label>
        <input type="text">
      </fieldset>
      <fieldset>
        <label>Diretoria</label><br>
        <select>
          <option>Presidência</option>
          <option>Administrativo e Financeiro</option>
          <option>Gestão de Pessoa e Projetos</option>
          <option>Marketing</option>
          <option>Projetos</option>
        </select><br>
        <label>Cargo</label><br>
        <select>
          <option>Acessor</option>
          <option>Gerente</option>
          <option>Diretor</option>
          <option>Presidente</option>
        </select><br>
      </fieldset>
      <fieldset>
        <label>Telefone</label>
        <input type="text">
        <label>E-mail</label>
        <input type="email">
      </fieldset>
      <fieldset>
        <label>CEP</label>
        <input type="text">
        <label>Logradouro</label>
        <input type="text">
        <label>Bairro</label>
        <input type="text">
        <label>Número</label>
        <input type="text">
        <label>Cidade</label>
        <input type="text">
        <label>Estado</label>
        <input type="text">
        <label>Complemento</label>
        <input type="text">
      </fieldset>
    </div>
    <input type="submit" value="Salvar">
  </form>
</main>

<?php
    Page::footer();
    Page::closeBody();
?>
