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

    $member = MemberDao::findMember($_GET['email']);
?>
<main>
  <h1></h1>
  <section>
    <h2>Dados cadastrados por <?php echo $member->getNick();?></h2>
  </section>

    <?php
      echo "<div id=\"user_img\" style=\"background-image:url('../res/member_image/{$member->getImage()}')\">
      </div>";
    ?>

  <form name="approve" action="../controller/updateMember.php?gpp=" method="POST" enctype="multipart/form-data">
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
        <label>Matrícula</label>
        <input type="text" name="registration" value="<?php echo $member->getRegister();?>">
      </fieldset>
        <fieldset>
            <label>Atualizar imagem</label>
            <input type="file" text="Nova Foto" name="image">
        </fieldset>

    </div>
    <div class="set_flex padding_left">

      <fieldset>
        <label>Diretoria</label><br>
        <select name="directorate">
        <?php

        for ($i=0; $i < count(Member::$DIRECTORATE); $i++) {
            echo "<option value='" . ($i+1) .
              (($i+1 == $member->getDirectorate()) ? "' selected" : "'") .
              ">" . Member::$DIRECTORATE[$i] . "</option>";
        }

        ?>
        </select><br>
        <label>Cargo</label><br>
        <select name="office">
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
        <input type="email" name="email" value="<?php echo $member->getEmail();?>" readonly>
        <label>Telefone</label>
        <input type="text" name="phone" value="<?php echo $member->getPhone();?>">
      </fieldset>

      <fieldset>

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

        <label>Semestre</label>
        <select name="period">
        <option value="">Nenhum</option>
            <?php
            for ($i=1; $i < 17; $i++) {
                echo "<option value='{$i}'" .
                (($i == $member->getPeriod()) ? " selected" : "") .
                ">{$i}</option>";
            }
            ?>
        </select>
      </fieldset>
    </div>

  </div>
    <input type="submit" value="Atualizar">
  </form>
</main>

<?php
    Page::footer();
    Page::closeBody();
?>