<?php

$title = "Connexion";
include('inc/pdo.php');
include('inc/fonction.php');

$errors = array();
if (!islogged()) {
if (!empty($_POST['submitted'])) {
// faille xss
  $login = trim(strip_tags($_POST['login']));
  $password = trim(strip_tags($_POST['password']));


  $sql = "SELECT * FROM v3_vac_users
          WHERE email = :login";
          $query = $pdo->prepare($sql);
          $query->bindvalue(':login',$login);
          $query->execute();
      $user = $query->fetch();

      debug($user);

  if (!empty($user)) {

    if (password_verify($password,$user['password'])) {
      if (count($errors) == 0) {
        $_SESSION['v3_user'] = array(
          'v3_id' => $user['id'], 'v3_email' => $user['email'], 'v3_role' => $user['role'], 'v3_ip' => $_SERVER['REMOTE_ADDR']
        );
        header('Location: index.php');
      }
    }else {
      $errors['password'] = 'votre mdp est incorrect';
    }


  }else {
    $errors['login'] = 'Vos identifiants ne sont pas correct !';
  }

  }








include('inc/header.php');



?>
<!-- ICONS -->
<svg id="svg-source" height="0" version="1.1"  xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink" style="position: absolute">
 <g id="man-people-user" data-iconmelon="Streamline Icon Set:de32eb2621491c1a881a9fe846236da1">
    <g id="Expanded">
      <g>
        <g>
          <path  d="M16.028,20c-4.764,0-8.639-4.486-8.639-10s3.875-10,8.639-10c4.763,0,8.638,4.486,8.638,10
				S20.791,20,16.028,20z M16.028,1.333C12,1.333,8.722,5.221,8.722,10s3.277,8.667,7.306,8.667c4.029,0,7.306-3.888,7.306-8.667
				S20.057,1.333,16.028,1.333z"></path>
        </g>
      <g>
         <path  d="M31.988,32H0.012v-4.515c0-1.967,1.245-3.733,3.097-4.395l8.224-2.266v-2.77h1.333v3.785L3.51,24.361
				c-1.275,0.458-2.165,1.72-2.165,3.124v3.182h29.309v-3.182c0-1.404-0.889-2.666-2.213-3.139l-9.107-2.506v-3.758h1.332v2.742
				l8.178,2.251c1.9,0.677,3.145,2.442,3.145,4.409V32z"></path>
       </g>
       <g>
                    <path  d="M21.865,8.812c-0.045,0-0.09-0.001-0.137-0.003c-1.5-0.055-3.25-1.004-4.361-2.287
				C16.59,7.513,15.48,8.15,14.106,8.383c-2.403,0.413-5.152-0.51-5.988-1.321l0.928-0.957c0.403,0.391,2.69,1.329,4.836,0.964
				c1.332-0.226,2.292-0.911,2.854-2.034l0.558-1.114l0.617,1.082c0.738,1.292,2.508,2.425,3.867,2.475
				c0.604,0.016,1.033-0.165,1.307-0.571l1.105,0.745C23.686,8.403,22.863,8.812,21.865,8.812z"></path>
                  </g>
                </g>
              </g>
            </g>
            <g id="lock-locker" data-iconmelon="Streamline Icon Set:5d43c6f45cdbecfd5b8a12bc9e5dd33c">
              <g id="Expanded">
                <g>
                  <g>
                    <circle  cx="16" cy="20" r="1.333"></circle>
                  </g>
          <g>
              <path  d="M16,25.333c-0.369,0-0.667-0.298-0.667-0.666v-4C15.333,20.298,15.631,20,16,20s0.667,0.298,0.667,0.667
				v4C16.667,25.035,16.369,25.333,16,25.333z"></path>
          </g>
          <g>
            <path  d="M28,32H4V12h24V32z M5.333,30.667h21.333V13.333H5.333V30.667z"></path>
        </g>
        <g>
         <path  d="M24,12.667h-1.333V8c0-3.676-2.991-6.667-6.667-6.667c-3.676,0-6.667,2.99-6.667,6.667v4.667H8V8
				c0-4.412,3.588-8,8-8c4.411,0,8,3.588,8,8V12.667z"></path>
           </g>
        </g>
      </g>
   </g>
</svg>
<!-- ICONS -->


<div class="background">
  <img src="asset/images/bg-banner1.png" alt="">
  <div class="contenu-image">
    <p>Nous sommes un site de carnets de vaccination électronique, permettant de vous faciliter dans vos démarches de santé.</p>
  </div>
</div>
<div class="wrapper">

  <div class="header">

    <h3 class="sign-in">Se connecter</h3>
    <div class="button"><a href="inscription.php">S'inscrire</a>

    </div>
  </div>
   <div class="clear"></div>
  <form action="" method="post">
      <div>
         <label class="user" for="text">
           <svg viewBox="0 0 32 32">
                    <g filter="">
                      <use xlink:href="#man-people-user"></use>
                    </g>
                  </svg>
         </label>
        <input class="user-input" type="text" name="login" id="login" placeholder="Email"  />
      </div>
      <div>
        <label class="lock" for="password">
          <svg viewBox="0 0 32 32">
             <g filter="">
               <use xlink:href="#lock-locker"></use>
              </g>
            </svg>
        </label>
        <input type="password" name="password" id="name" placeholder="" />
      </div>
     <div>
      <input type="submit" name="submitted" value="Se connecter"  />
    </div>
    <div class="radio-check">
      <input type="radio" class="radio-no" id="no" name="remember" value="no" checked>
      <label for="no"><i class="fa fa-times"></i></label>
      <input type="radio" class="radio-yes" id="yes" name="remember" value="yes">
      <label for="yes"><i class="fa fa-check"></i></label>
      <span class="switch-selection"></span>
    </div>
      <span class="check-label">Remember me</span>
      <span class="forgot-label"><a href="passwordforget.php">Mot de passe oublié?</a></span>
      <div class="clear"></div>
  </form>
</div>




<?php
}else {
  header('Location: index.php');
}
include('inc/footer.php');
