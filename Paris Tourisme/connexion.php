<?php require 'include/header.html' ?>

<?php 
    if(isset($_POST['connexion']))
    {
        $email=$_POST['email'];
        $password=$_POST['password'];
        require_once'include/bdd.php';
        $requete=$bdd->prepare('SELECT * FROM users WHERE mail=:mail');
        $requete->execute(array('mail'=>$email));
        $result=$requete->fetch();
        if(!$result){
            $message="Merci de rentrer une adresse email valide";

        }
        else{
            $passwordIsOk=password_verify($password, $result['password']);
            if($passwordIsOk){
                session_start();
                $_SESSION['id']=$result['id'];
                $_SESSION['username']=$result['username'];
                $_SESSION['mail']=$result['mail'];
                header('location:index.php');
            }
            else{
                echo'Mot de passe incorrect';
            }
        }

    }
?>




<div id="login">
        <h3 class="text-center text-white pt-5">Connexion</h3>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">

                        <?php if(isset($message)) echo $message;?>
                        
                        <form id="login-form" class="form" action="" method="post">
                            <h3 class="text-center text-info">Login</h3>
                            <div class="form-group">
                                <label for="email" class="text-info">Adresse mail:</label><br>
                                <input type="mail" name="email" id="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">Mot de passe:</label><br>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="submit" name="connexion" class="btn btn-info btn-md" value="Se connecter">
                            </div>
                            <div class="form-group">
                                <a href="inscription.php" class="btn btn-info btn-md">S'inscrire</a>
                            </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
