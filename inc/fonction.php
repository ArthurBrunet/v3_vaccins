<?php 
function br(){
    echo('<br>');
}

function debug($a){
    echo('<pre>');
    print_r($a);
    echo('</pre>');
}

function veriftext($error,$data,$key,$min,$max,$empty = true)
{
    if(!empty($data)) {
        if(strlen($data) <$min) {
          $error[$key] = 'min '.$min.' caracteres';
        }elseif(strlen($data) >$max) {
          $error[$key] = 'max '.$max.' caracteres';
        }
    } else {
      if($empty) {
        $error[$key] = 'veuillez renseigner ce champ';
      }
  
    }
  
    return $error;
  }
  