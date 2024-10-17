<?php require 'include/header.html' ?>
<?php
session_start();

if(isset($_POST['modification']) AND isset($_SESSION['id'])){
        $id = $_SESSION['id'];
        if(empty($_POST['username']) || !preg_match ('/[a-zA-Z0-9]+/', $_POST['username']) )
        {
        $message='Votre username doit etre une chaine de caractere(alphanumerique)';
        }


        elseif(empty($_POST['password']) || $_POST['password'] != $_POST['password2'])
            {
                $message='Rentrer un mot de passe valide';
            }

         else{
                require_once 'include/bdd.php';
                $req=$bdd->prepare('SELECT * FROM users WHERE username=:username');
                $req->bindValue(':username',$_POST['username']);
                $req->execute();
                $result=$req->fetch();

                if($result)
                    {
                        $message='Le username utilisé existe deja !';
                    }


                else{
                        $password=password_hash($_POST['password'], PASSWORD_DEFAULT);
                        $requete=$bdd->prepare('UPDATE table_membres SET username= :username, password= :password WHERE id= :id');
                        $requete->bindValue(':username',$_POST['username']);
                        $requete->bindValue(':password',$password);
                        $requete->bindValue(':id',$id);
                        $requete->execute();
                        $message='Les modifications ont été bien effectuées'; 
                        header('location:index.php');
                    }
    }
}
?>


<div id="login">
        <h3 class="text-center text-white pt-5">Modification</h3>
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
                                <label for="password" class="text-info">Mot de passe:</label><br>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password2" class="text-info">Confirmation mot de passe:</label><br>
                                <input type="password" name="password2" id="password2" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="submit" name="modification" class="btn btn-info btn-md" value="modifier">
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