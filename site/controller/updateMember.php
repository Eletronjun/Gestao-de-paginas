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

try {
    $member_dao = new MemberDAO(MemberDao::findMember($session->getEmail()));
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
        $password
    );

    $member_dao->update($member_update);
} catch (Exception $msg) {
    echo $msg;
}
