<?php
##################################
/*********************************
 *  utils.php - Utility Functions 
 *********************************/
##################################

/*
* Returns value in array at specified index, if the index
* does not exist, this functon returns null.
*/
function get_val($index, $arr=null){

  if($arr == null){
    $arr = $_REQUEST;
  }// end if alternate array is null

  return isset($arr[$index]) ? $arr[$index] : null;
}// end function get_val()

/*
* Returns the current PHP page name
*/
function current_page(){
  return basename($_SERVER['PHP_SELF']);
}// end function current_page()