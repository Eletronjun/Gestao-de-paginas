<?php
/**
 *Base class to remove member data
 *
 *@author  Vinicius Pinheiro <viny-pinheiro@hotmail.com>
 *@license MIT License
 *@link    http://eletronjun.com.br/controller/updateMember.php
 */
require_once __DIR__ . "/../class/autoload.php";

use \model\Member as Member;
use \dao\MemberDAO as MemberDAO;
use \exception\MemberException as MemberException;
use \exception\DatabaseException as DatabaseException;
use \configuration\Globals as Globals;
use \utilities\Session as Session;

$session = new Session();
$session->verifyIfSessionIsStarted();

//Declair and remove espaces

try {
    $email = $_GET['email'];

    $member = new MemberDAO(MemberDAO::findMember($email));
    $img_name = $member->getMemberModel()->getImage();
    $member->remove();

    unlink(UPLOAD_ROOT . "../member_image/" . $img_name);
    
    echo "<script>alert('O membro foi removido do sistema com sucesso'); location.href='" . PROJECT_ROOT .
    "adm/users.php'; </script>";
} catch (Exception $msg) {
    $msg = addslashes($msg);
    echo "<script>alert('{$msg}'); location.href='" . PROJECT_ROOT .
    "adm/users.php'; </script>";
}
