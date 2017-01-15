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

$email = addslashes($_POST['email']);
$registration = addslashes($_POST['registration']);
$name = addslashes($_POST['name']);
$sex = addslashes($_POST['sex']);
$nick = addslashes($_POST['nick']);
$password = addslashes($_POST['password']);
$password_confirm = addslashes($_POST['password_confirm']);
$birthdate = addslashes($_POST['birthdate']);
$rg = addslashes($_POST['rg']);
$cpf = addslashes($_POST['cpf']);
$phone = addslashes($_POST['phone']);
$course = addslashes($_POST['course']);
$period = addslashes($_POST['period']);
$address = addslashes($_POST['address']);
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
    $member_dao = new MemberDAO(MemberDao::findMember($session->getEmail()));
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
        $member_dao->getMemberModel()->getDirectorate(),
        $member_dao->getMemberModel()->getOffice(),
        $password,
        $image_name
    );

    $member_dao->update($member_update);

    if ($old_image != $member_update->getImage() && $member_update->getImage() != "default.png") {
        unlink(UPLOAD_ROOT . "../member_image/" . $old_image);
    } else {
        //Nothing to do
    }
    

    echo "<script>alert('Dados Alterados'); location.href='" . PROJECT_ROOT . "adm';</script>";
} catch (Exception $msg) {
    if (file_exists(UPLOAD_ROOT . "../member_image/" . $image_name)) {
        unlink(UPLOAD_ROOT . "../member_image/" . $image_name);
    }
    echo "<script>alert('{$msg}'); history.go(-1); </script>";
}
