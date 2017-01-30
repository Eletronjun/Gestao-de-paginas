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

    $member = MemberDao::findMember($session->getEmail());
?>
<main>
  <h1></h1>
  <section class="left" style="margin-bottom:3.125rem">
    <h2>Bem-vindo à EletronJun!</h2>
    <p style="font-size:1.5625rem;margin-top:-1.7rem;"><?php echo $member->getNick();?></p>
  </section>

    <?php
      echo "<div id=\"user_img\" style=\"background-image:url('../res/member_image/{$member->getImage()}')\">
      </div>";
    ?>

  <form name="update" action="../controller/updateMember.php" method="POST" enctype="multipart/form-data" class="double_column">
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
        <label>Matrícula</label>
        <input type="text" name="registration" value="<?php echo $member->getRegister();?>">
        <label>Curso</label>
        <select name="course">
            <option value="">Nenhum</option>
            <?php

            for ($i=0; $i < count(Member::$COURSE); $i++) {
                echo "<option value='" . Member::$COURSE[$i] .
                    ((Member::$COURSE[$i] == $member->getCourse()) ? "' selected" : "'") .
                    ">" . Member::$COURSE[$i] . "</option>";
            }

            ?>
        </select>
      </fieldset>
        <fieldset>
            <label>Atualizar imagem</label>
            <input type="file" text="Nova Foto" name="image">
        </fieldset>

      <fieldset>
        <label>Senha</label>
        <input type="password" name="password">
        <label>Confirmação de Senha</label>
        <input type="password" name="password_confirm">
      </fieldset>

      <fieldset>
        <label>Diretoria</label><br>
        <select name="directorate" disabled="disabled">
        <?php

        for ($i=0; $i < count(Member::$DIRECTORATE); $i++) {
            echo "<option value='" . ($i+1) .
              (($i+1 == $member->getDirectorate()) ? "' selected" : "'") .
              ">" . Member::$DIRECTORATE[$i] . "</option>";
        }

        ?>
        </select><br>
        <label>Cargo</label><br>
        <select name="office" disabled="disabled">
        <?php

        for ($i=0; $i < count(Member::$OFFICE); $i++) {
            echo "<option value='" . ($i+1) .
              (($i+1 == $member->getOffice()) ? "' selected" : "'") .
              ">" . Member::$OFFICE[$i] . "</option>";
        }

        ?>
        </select><br>
      </fieldset>

      <fieldset>
        <label>Endereço</label>
        <input type="text" name="address" value="<?php echo $member->getAddress();?>">
      </fieldset>

      <fieldset>
        <label>E-mail</label>
        <input type="email" name="email" value="<?php echo $member->getEmail();?>">
        <label>Telefone</label>
        <input type="text" name="phone" value="<?php echo $member->getPhone();?>">
      </fieldset>

      <fieldset>
        <label>Semestre</label>
        <select name="period">
        <option value="null">Nenhum</option>
            <?php
            for ($i=1; $i < 17; $i++) {
                echo "<option value='{$i}'" .
                (($i == $member->getPeriod()) ? " selected" : "") .
                ">{$i}</option>";
            }
            ?>
        </select>
      </fieldset>
    <input type="submit" value="Salvar">
  </form>
</main>

<?php
    Page::footer();
    Page::closeBody();
?>
