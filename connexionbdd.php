<?php

try {
    
    $baseautoloc = new PDO("mysql:host=localhost;dbname=auto loc;charset=utf8;", "root", "");

} catch (Exception $expt) {
  die("<p style=\"color: red;\">échec de connexion à la base de donnée </p>".$expt->getMessage());
}

?>