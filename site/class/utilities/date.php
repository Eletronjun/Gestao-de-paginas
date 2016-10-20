<?php
/**
 * Utility to set the default date format
 *
 *@package Utilities
 *@author  Iasmin Mendes <mendesiasmin96@gmail.com>
 *@license MIT License
 *@link    http://eletronjun.com.br/class/utilities/date.php
 */

namespace utilities{

  class Date{

    public function formatDate($date)
    {
      if($date){
        setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');
        return strftime('%d de %B de %Y', strtotime(substr($date, 0, 10)));
      }
    }
  }
}

?>
