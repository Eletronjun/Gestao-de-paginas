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
?>
  <main style="margin-top: 2rem;">
    <section class="left" style="margin-bottom:3.125rem">
      <h2>Cadastro de novo membro!</h2>
    </section>

    <form name="update" action="../controller/registerMember.php" method="POST" enctype="multipart/form-data">
      <div class="flex">
        <div class="set_flex padding_right">
          <fieldset>
            <label>Nome Completo</label>
            <input type="text" name="name" placeholder="João da Silva">
            <label>NickName</label>
            <input type="text" name="nick" placeholder="Joao Silva">
            <label>Sexo</label><br>
            <select name="sex">
                <?php
                echo "<option value = 'F'>" . MEMBER::$SEX['F'] . "</option>";

                echo "<option value = 'M'>" . MEMBER::$SEX['M'] . "</option>";
                ?>
            </select><br>
            <label>Data de Nascimento</label>
            <input type="date" name="birthdate" placeholder="1995-05-05">
            <label>RG (numero orgaoEmissor/estado)</label>
            <input type="text" name="rg" placeholder="111111111-1 SSP/DF">
            <label>CPF</label>
            <input type="text" name="cpf" placeholder="11111111111">
          </fieldset>
          
          <fieldset>
            <label>Matrícula</label>
            <input type="text" name="registration" placeholder="14/0011111">
            <label>Curso</label>
            <select name="course">
                <option value="">Nenhum</option>
                <?php

                for ($i=0; $i < count(Member::$COURSE); $i++) {
                    echo "<option value='" . Member::$COURSE[$i] . "'>" . Member::$COURSE[$i] . "</option>";
                }

                ?>
            </select>
          </fieldset>

            <fieldset>
                <label>Atualizar imagem</label>
                <input type="file" text="Nova Foto" name="image">
            </fieldset>

        </div>
        <div class="set_flex padding_left">

          <fieldset>
            <label>Senha</label>
            <input type="password" name="password">
            <label>Confirmação de Senha</label>
            <input type="password" name="password_confirm">
          </fieldset>

          <fieldset>
            <label>Diretoria</label><br>
            <select name="directorate">
            <?php

            for ($i=0; $i < count(Member::$DIRECTORATE); $i++) {
                echo "<option value='" . ($i+1) . "'>" . Member::$DIRECTORATE[$i] . "</option>";
            }

            ?>
            </select><br>
            <label>Cargo</label><br>
            <select name="office">
            <?php

            for ($i=0; $i < count(Member::$OFFICE); $i++) {
                echo "<option value='" . ($i+1) . "'>" . Member::$OFFICE[$i] . "</option>";
            }

            ?>
            </select><br>
          </fieldset>
          
          <fieldset>
            <label>Endereço</label>
            <input type="text" name="address" placeholder="Quadra 10 lote 21 Setor X Gama-DF">
          </fieldset>
          
          <fieldset>
            <label>E-mail</label>
            <input type="email" name="email" placeholder="example@example.com">
            <label>Telefone</label>
            <input type="text" name="phone" placeholder="(61)99999-9999">
          </fieldset>

          <fieldset>
            <label>Semestre</label>
            <select name="period">
            <option value="">Nenhum</option>
                <?php
                for ($i=1; $i < 17; $i++) {
                    echo "<option value='{$i}'" . ">{$i}</option>";
                }
                ?>
            </select>
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
