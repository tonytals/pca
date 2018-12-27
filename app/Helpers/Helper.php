<?php

/*
 *  FUNÇÃO PARA FORMATAR STRINGS
 */
if (! function_exists('mascara')) {
    function mascara($mask, $str){

    $str = str_replace(" ","",$str);

    for($i=0;$i<strlen($str);$i++){
        $mask[strpos($mask,"#")] = $str[$i];
    }

    return $mask;

  }
}
