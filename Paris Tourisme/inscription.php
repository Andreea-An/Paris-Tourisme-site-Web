<?php require 'include/header.html' ?>
<?php
     if(isset($_POST['inscription'])){
        if(empty($_POST['username']) || !preg_match ('/[a-zA-Z0-9]+/', $_POST['username']) )
        {
           $message='Votre username doit etre une chaine de caractere(alphanumerique)';
        }
        elseif(empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL ))
        {
            $message='Veuiller saisir une adresse mail valide';
        }
        elseif(empty($_POST['password']) || $_POST['password'] != $_POST['password2'])
        {
            $message='Rentrer un mot de passe valide';
        }
        else{
            require_once'include/bdd.php';
            $req=$bdd->prepare('SELECT * FROM users WHERE username=:username');
            $req->bindValue(':username',$_POST['username']);
            $req->execute();
            $result=$req->fetch();

            $req1=$bdd->prepare('SELECT * FROM users WHERE mail=:mail');
            $req1->bindValue(':mail',$_POST['email']);
            $req1->execute();
            $result1=$req1->fetch();

            if ($result)
            {
                $message='le username utilisé existe deja';
            }
            elseif($result1){
                $message='L\'adresse mail utilisé existe deja';
            }

             else{
            $password=password_hash($_POST['password'], PASSWORD_DEFAULT);
            $requete=$bdd->prepare('INSERT INTO users(username, mail, password) VALUE(:username, :mail, :password)');
            $requete->bindValue(':username',$_POST['username']);
            $requete->bindValue(':mail',$_POST['email']);
            $requete->bindValue(':password',$password);
            $requete->execute();
            $message='Vous etes bien inscrit'; 
             }

        }
    }

 ?>
<body>
    <div id="login">
        <h3 class="text-center text-white pt-5">Inscription</h3>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">

                        <?php if(isset($message)) echo $message;?>
                        
                        <form id="login-form" class="form" action="" method="post">
                            <h3 class="text-center text-info">Login</h3>
                            <div class="form-group">
                                <label for="username" class="text-info">username:</label><br>
                                <input type="text" name="username" id="username" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="email" class="text-info">Adresse mail:</label><br>
                                <input type="mail" name="email" id="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">Mot de passe:</label><br>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password2" class="text-info">Confirmation mot de passe:</label><br>
                                <input type="password" name="password2" id="password2" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="submit" name="inscription" class="btn btn-info btn-md" value="s'inscrire">
                                <a href="connexion.php" class="btn btn-info btn-md">Se connecter</a>
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
