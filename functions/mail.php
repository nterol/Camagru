<?php
function send_email_verification($mail, $username, $token, $host)
{
    $subject = "[CAMAGRU] - Email Verification";
    
    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=UTF-8'."\r\n";
    $headers .= 'From: nterol@free.fr'."\r\n";

    $message = '
    <html>
      <head>
        <title>'. $subject . '</title>
      </head>
      <body>
        Hello,  '. htmlspecialchars($username) . '</br>
        Pour finaliser ton inscription clique sur ce lien ma gueule :
        <a href="http://localhost'.$host.'/verify.php?token='.$token.'">Verify my email</a>
      </body>
    </html>
    ';
    mail($mail, $subject, $message, $headers);
}

function send_forgot_mail($mail, $username, $token, $host)
{
    $subject = "[CAMAGRU] - Email Verification";
    
    $headers = 'MIME-Version: 1.0'."\r\n";
    $headers .= 'Content-type: text/html; charset=UTF-8'."\r\n";
    $headers .= 'From: <nterol@free.fr>'."\r\n";

    $message = '
    <html>
      <head>
        <title>'. $subject .'</title>
      </head>
    <body>
    Salut, '. htmlspecialchars($username) .'</br>
    Il semblerait que tu aies oublié ton mot de passe. </br>
    Clique sur ce lien pour le réinitialiser :
    <a href="http://localhost'.$host.'/change_password.php?token='.$token.'">Changer mon mot de passe</a>
    </body>
  </html>
  ';
    mail($mail, $subject, $message, $headers);
}

function send_comment_mail($mail, $toUsername, $comment, $fromUsername, $img, $host) {
  $subject = "Someone commented your picture !";
  
  $headers = 'MIME_Version: 1.0'."\r\n";
  $headers .= 'Content-type: text/html; charset=UTF-8'. "\r\n";
  $headers .= 'From nterol@free.fr'."\r\n";

  $message = '
  <html>
    <head>
      <title>' . $subject . '</title>
    </head>
    <body>
      Hello, '. htmlspecialchars($toUsername). '</br>
      A user just commented one of your Picture !</br>
      <img src="http://'. $ip . '/montage/'. $img . '" style="width: 388px;height: 291px; display:block; margin: 20px;"></img>
      <span>'. htmlspecialchars($fromUsername) . ': '. htmlspecialchars($comment). '</span>
    </body>
  </html>';
  mail($mail, $subject, $message, $headers);
}
?>