<?php
    require_once __DIR__ . "/../class/autoload.php";

    use \utilities\Session as Session;
    use \html\Page as Page;
    use \html\AdministratorMenu as AdministratorMenu;
    use \configuration\Globals as Globals;
    use \dao\MemberDao as MemberDao;
    use \model\Member as Member;

    Page::startHeader(Globals::ENTERPRISE_NAME);
    Page::styleSheet("form");
    Page::styleSheet("user");
    Page::closeHeader();

    $session = new Session();
    $session->verifyIfSessionIsStarted();

    $menu = new AdministratorMenu();
    $menu->construct();

    $member = MemberDao::findCategory($session->getEmail());
?>
<main>
  <h1></h1>
  <section class="left" style="margin-bottom:3.125rem">
    <h2>Bem-vindo à EletronJun!</h2>
    <p style="font-size:1.5625rem;margin-top:-1.7rem;"><?php echo $member->getNick();?></p>
  </section>

    <?php
      echo "<div id=\"user_img\" style=\"background-image:url('../res/img/eletronday1_1.jpg')\">
      </div>";
    ?>

  <form>
    <div class="flex">
    <div class="set_flex padding_right">
      <fieldset>
        <label>Nome Completo</label>
        <input type="text" name="name" value="<?php echo $member->getName();?>">
        <label>NickName</label>
        <input type="text" name="nick" value="<?php echo $member->getNick();?>">
        <label>Sexo</label><br>
        <select name="sex">

            <?php
            echo "<option value = 'F' ";
            if ('F' == $member->getSex()) {
                echo "selected";
            } else {
                //Nothing to do.
            }
            echo ">" . MEMBER::$SEX['F'] . "</option>";

            echo "<option value = 'M' ";
            if ('M' == $member->getSex()) {
                echo "selected";
            } else {
                //Nothing to do.
            }
            echo ">" . MEMBER::$SEX['M'] . "</option>";
            ?>
        </select><br>
        <label>Data de Nascimento</label>
        <input type="date" name="birthdate" value="<?php echo $member->getBirthdate();?>">
        <label>RG (numero orgaoEmissor/estado)</label>
        <input type="text" name="rg" value="<?php echo $member->getRg();?>">
        <label>CPF</label>
        <input type="text" name="cpf" value="<?php echo $member->getCpf();?>">
      </fieldset>
      <fieldset>
        <label>Senha</label>
        <input type="password">
        <label>Confirmação de Senha</label>
        <input type="password">
      </fieldset>
      <fieldset>
        <label>Matrícula</label>
        <input type="text" name="registration" value="<?php echo $member->getRegister();?>">
        <label>Curso</label>
        <input type="text" name="course" value="<?php echo $member->getCourse();?>">
        <label>Semestre</label>
        <input type="text">
      </fieldset>
    </div>
    <div class="set_flex padding_left">
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
        <input type="text" name="phone" value="<?php echo $member->getPhone();?>">
        <label>E-mail</label>
        <input type="email" name="email" value="<?php echo $member->getEmail();?>">
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
  </div>
    <input type="submit" value="Salvar">
  </form>
</main>

<?php
    Page::footer();
    Page::closeBody();
?>
