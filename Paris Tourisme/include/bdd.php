<?php 
   $bdd= new PDO('mysql:dbname=touristes; host=localhost','root',"");
   $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>