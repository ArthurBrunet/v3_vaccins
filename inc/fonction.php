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

  // affiche les errors dans le html
  function afficheErrors($errors,$key){
  ?>
  <span class="errors"><?php if (!empty($errors[$key])) { echo $errors[$key]; } ?></span>
  <?php
  }

  // generation token
  function generateRandomString($length = 10) {
      $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $charactersLength = strlen($characters);
      $randomString = '';
      for ($i = 0; $i < $length; $i++) {
          $randomString .= $characters[rand(0, $charactersLength - 1)];
      }
      return $randomString;
  }

  // connecter ou pas
  function isLogged(){
    if (!empty($_SESSION['v3_user'])) {
      if (!empty($_SESSION['v3_user']['v3_id'])) {
        if (!empty($_SESSION['v3_user']['v3_email'])) {
          if (!empty($_SESSION['v3_user']['v3_role'])) {
            if (!empty($_SESSION['v3_user']['v3_ip'])) {
              if ($_SESSION['v3_user']['v3_ip'] == $_SERVER['REMOTE_ADDR']) {
                return true;
              }
            }
          }
        }
      }
    }
    return false;
  }

  function isadmin(){
  if (!empty($_SESSION['v3_user'])) {
    if (!empty($_SESSION['v3_user']['v3_id'])) {
      if (!empty($_SESSION['v3_user']['v3_email'])) {
        if (!empty($_SESSION['v3_user']['v3_role'])&&$_SESSION['v3_user']['v3_role']=='admin') {
          if (!empty($_SESSION['v3_user']['v3_ip'])) {
            if ($_SESSION['v3_user']['v3_ip'] == $_SERVER['REMOTE_ADDR']) {
              return true;
            }
          }
        }
      }
    }
  }
  return false;
}

  // remplissage de Value
  function remplissageValue($post,$key){
    if (!empty($post)) {
    echo $post[$key];
    }
  }

function validateDate($date, $format = 'Y-m-d H:i:s')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}


function requestSelect($from ='',$where1 ='',$fetch =''){
  global $pdo;

$sql ="SELECT * FROM $from WHERE $where1";
    $query = $pdo->prepare($sql);
    $query->execute();
    if ($fetch == 'fetchall') {
      $request = $query->fetchall();
    }else {
      $request = $query->fetch();
    }

return $request;

}

