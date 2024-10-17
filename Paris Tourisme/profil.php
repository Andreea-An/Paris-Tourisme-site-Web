<?php require 'include/header.html'?>

<?php
session_start();
if(isset($_SESSION['id']))
{
 ?>
<div id="login">
<h3 class="text-center text-white pt-5">Mon profil</h3>
<div class="container">
<div id="login-row" class="row justify-content-center align-items-center">
<div id="login-column" class="col-md-6">
<div id="login-box" class="col-md-12">

<table>
    <tr><td>Nom utilisateur:</td> <td><?= $_SESSION['username']?></td> </tr>
    <tr><td>Adresse Email:</td> <td><?= $_SESSION['mail']?></td></tr>
    <tr><td><a href="modif_profil.php">Modifier mon profil</a></td></tr>
</table>
<?php
}
?>

</div>
</div>
</div>
</div>
</div>
</body>
</html>
