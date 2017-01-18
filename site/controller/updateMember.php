<?php
/**
 *Base class to persist data
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
if (!isset($_GET['gpp'])) {
    $member_dao = new MemberDAO(MemberDao::findMember($session->getEmail()));
} else {
    $member_dao = new MemberDAO(MemberDao::findMember(addslashes($_POST['email'])));
}

$email = addslashes($_POST['email']);
$registration = addslashes($_POST['registration']);
$name = addslashes($_POST['name']);
$sex = addslashes($_POST['sex']);
$nick = addslashes($_POST['nick']);
$password = (!isset($_GET['gpp'])) ?
    addslashes($_POST['password']) :
    $member_dao->getMemberModel()->getPassword();
$password_confirm = (!isset($_GET['gpp'])) ?
    addslashes($_POST['password_confirm']) :
    $member_dao->getMemberModel()->getPassword();
$birthdate = addslashes($_POST['birthdate']);
$rg = addslashes($_POST['rg']);
$cpf = addslashes($_POST['cpf']);
$phone = addslashes($_POST['phone']);
$course = addslashes($_POST['course']);
$period = addslashes($_POST['period']);
$address = addslashes($_POST['address']);
$directorate = (isset($_GET['gpp'])) ?
    addslashes($_POST['directorate']) :
    $member_dao->getMemberModel()->getDirectorate();
$office = (isset($_GET['gpp'])) ?
    addslashes($_POST['office']) :
    $member_dao->getMemberModel()->getOffice();
$image_name = null;

try {
    if ($password != $password_confirm) {
        throw new Exception("Senhas diferem!");
    }
    if (!empty($_FILES["image"]["type"])) {
        date_default_timezone_set("Brazil/East"); //Define TimeZone
        $ext = strtolower(substr($_FILES['image']['name'], -4)); //Get extension of file
        $image_name = md5(date("Y.m.d-H.i.s")) . $ext; //Define a new name for file
          //Verify if mime-type is image
        if (eregi("^image\/(pjpeg|jpeg|png|gif|bmp)$", $_FILES['image']["type"])) {
            move_uploaded_file($_FILES['image']['tmp_name'], UPLOAD_ROOT . "../member_image/" . $image_name); //Save upload of file
        } else {
            throw new Exception("O arquivo precisa ser uma imagem.");
        }
    } else {
        //Nothing to do.
    }
    $old_image = $member_dao->getMemberModel()->getImage();
    $password = ($password == null) ? $member_dao->getMemberModel()->getPassword() : $password;
    $member_update = new Member(
        $email,
        $name,
        $nick,
        $sex,
        $registration,
        $birthdate,
        $phone,
        $rg,
        $cpf,
        $course,
        $period,
        $address,
        $directorate,
        $office,
        $password,
        $image_name
    );
    $member_dao->update($member_update);
    

    if ($old_image != $member_update->getImage() && $member_update->getImage() != "default.png") {
        unlink(UPLOAD_ROOT . "../member_image/" . $old_image);
    } else {
        //Nothing to do
    }
    

    echo "<script>alert('Dados Alterados'); location.href='" . PROJECT_ROOT .
    "adm/updateMember.php?email={$email}'; </script>";
} catch (Exception $msg) {
    if (file_exists(UPLOAD_ROOT . "../member_image/" . $image_name) && $image_name != null) {
        unlink(UPLOAD_ROOT . "../member_image/" . $image_name);
    }
    $msg = addslashes($msg);
    echo "<script>alert('{$msg}'); location.href='" . PROJECT_ROOT .
    "adm/updateMember.php?email={$email}'; </script>";
}
