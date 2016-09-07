<?php
    require_once(realpath('.') . "/class/autoload.php");
    
    use \html\Page as Page;
    use \configuration\Globals as Globals;

    Page::header(Globals::ENTERPRISE_NAME);
?>

<h1> Hello World</h1>
    <!-- All content is here -->

<?php
    Page::footer();
    Page::closeBody();
?>