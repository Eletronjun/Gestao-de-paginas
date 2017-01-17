<?php
/**
 * Utility to print member's basic information
 *
 *@package Utilities
 *@author  Iasmin Mendes <mendesiasmin96@gmail.com>
 *@license MIT License
 *@link    http://eletronjun.com.br/class/utilities/memberContact.php
 */


namespace utilities{

    class MemberContact
    {

        public function memberContact($member, $directorate = NULL)
        {
          if($member){
            echo "<div style=\"background-image:url('res/member_image/{$member->getImage()}')\"></div>";
            echo "<strong>" . MemberContact::nameOffice($member);
            if($member->getDirectorate() != 5){
              echo " {$directorate}";
            }
            echo "</strong><br>";
            echo "<p>{$member->getNick()}</p>";
            echo "<p class=\"email\">{$member->getEmail()}</p>";
          }
        }

    public function nameOffice($member) {
      $office = $member->getOffice();
      switch ($office) {
        case 1:
          $nameOffice = "Presidente Organizacional";
          break;
        case 2:
          $nameOffice = "Presidente Institucional";
          break;
        case 3:
          $nameOffice = "Diretor";
          break;
        case 4:
          $nameOffice = "Gerente";
          break;
        case 5:
          $nameOffice = "Acessor";
          break;
        case 6:
          $nameOffice = "Trainee";
          break;
        default:
          $nameOffice = "Colaborador";
          break;
    }

      if($member->getSex() == "F"){
        if($office == 3 || $office == 5 || $office == 7) {
          $nameOffice = $nameOffice . "a";
        }
      }
    return $nameOffice;
    }
  }
}
