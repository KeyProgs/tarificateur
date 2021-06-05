<?php
/**
 * Created by PhpStorm.
 * User: ACS
 * Date: 07/11/2018
 * Time: 17:08
 */

namespace App\Helpers;


class Helper {
   public static function getDateFormat($date) {
      if($date != null) {
         $date_parts = explode('-', $date);
         return $date_parts[2] . '/' . $date_parts[1] . '/' . $date_parts[0];
      } else {
         return null;//''
      }
   }


   public static function setDateFormat($date) {
      if($date != null) { //''
         $date_parts = explode('/', $date);
         return $date_parts[2] . '-' . $date_parts[1] . '-' . $date_parts[0];
      } else {
         return null; //''
      }
   }
}