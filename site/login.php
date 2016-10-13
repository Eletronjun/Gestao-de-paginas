<?php
    require_once __DIR__ . "/class/autoload.php";
    use \html\Page as Page;
    use \configuration\Globals as Globals;

    Page::header(Globals::ENTERPRISE_NAME);
?>
    <form action="controller/initSession.php" method="POST">
        <label>Email</label><br>
        <input type="text" id="email" name="email" required><br><br>
        <label>Senha</label><br>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" value="Login"/>
    </form>
<?php
    Page::footer();
    Page::closeBody();
?>