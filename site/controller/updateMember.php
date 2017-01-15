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

$email = $_POST['email'];
$registration = $_POST['registration'];
$name = $_POST['name'];
$sex = $_POST['sex'];
$nick = $_POST['nick'];
$password = $_POST['password'];
$password_confirm = $_POST['password_confirm'];
$birthdate = $_POST['birthdate'];
$rg = $_POST['rg'];
$cpf = $_POST['cpf'];
$phone = $_POST['phone'];
$course = $_POST['course'];
$period = $_POST['period'];
$address = $_POST['address'];
$directorate = $_POST['directorate'];
$office = $_POST['office'];
$image_name = null;

try {
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
    

    echo "<script>alert('Dados Alterados'); location.href='" . PROJECT_ROOT . "adm';</script>";
} catch (Exception $msg) {
    if (file_exists(UPLOAD_ROOT . "../member_image/" . $image_name)) {
        unlink(UPLOAD_ROOT . "../member_image/" . $image_name);
    }
    echo "<script>alert('{$msg}'); history.go(-1)</script>";
}
