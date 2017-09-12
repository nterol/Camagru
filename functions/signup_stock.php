<?php
  function signup($mail, $username, $password, $host)
  {
      include_once '../setup/database.php';
      include_once '../functions/mail.php';

      $mail = strtolower($mail);

      try {
          $db = new PDO($DB_DSN, $DB_USER, $DB_PSSWD);
          $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $query = $db->prepare("SELECT id FROM users WHERE username=:username OR mail=:mail");
          $query->execute(array(':username' => $username, ':mail' => $mail));

          if ($val = $query->fetch()) {
              $_SESSION['error'] = "Gro t'existes déjà, log toi bouffon";
              $query->closeCursor();
              return (-1);
          }
          $query->closeCursor();

          $password = hash('whirlpool', $password);
          $query = $db->prepare("INSERT INTO users (username, mail, password, token) VALUES (:username, :mail, :password, :token)");
          $token = uniqid(rand(), true);
          $query->execute(array(':username' => $username, ':mail' => $mail, ':password' => $password, ':token' => $token));
          send_email_verification($mail, $username, $token, $host);
          $_SESSION['signup_success'] = true;
          return(0);
      } catch (PDOException $e) {
          $_SESSION['error'] = "COUCOU :".$e->getMessage()."Aborting process";
      }
  }
