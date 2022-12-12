
<?php 
 //Nous allons démarrer la session avant toute chose
   session_start() ;
  if(isset($_POST['boutton-valider'])){ // Si on clique sur le boutton , alors :
    //Nous allons verifiér les informations du formulaire
    if(isset($_POST['pseudo']) && isset($_POST['mdp'])) { //On verifie ici si l'utilisateur a rentré des informations
      //Nous allons mettres l'email et le mot de passe dans des variables
      $pseudo = $_POST['pseudo'] ;
      $mdp = $_POST['mdp'] ;
      $erreur = "" ;
       //Nous allons verifier si les informations entrée sont correctes
       //Connexion a la base de données
       $nom_serveur = "localhost";
       $utilisateur = "mael";
       $mot_de_passe ="26082002Mael";
       $nom_base_données ="Portfolio" ;
       $con = mysqli_connect($nom_serveur , $utilisateur ,$mot_de_passe , $nom_base_données);
       //requete pour selectionner  l'utilisateur qui a pour email et mot de passe les identifiants qui ont été entrées
        $req = mysqli_query($con , "SELECT * FROM users WHERE pseudo = '$pseudo' AND mdp ='$mdp' ") ;
        $num_ligne = mysqli_num_rows($req) ;//Compter le nombre de ligne ayant rapport a la requette SQL
        if($num_ligne > 0){
            header("Location:bienvenu.php") ;//Si le nombre de ligne est > 0 , on sera redirigé vers la page bienvenu
            // Nous allons créer une variable de type session qui vas contenir l'email de l'utilisateur
            $_SESSION['pseudo'] = $pseudo ;
        }else {//si non
            $erreur = "Pseudo ou Mots de passe incorrectes !";
        }
    }
  }
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Liaison des diférentes pages (javascript, css, bootsrap, etc...) -->

    <!-- Liaison des différents CSS présents -->
        <link rel="stylesheet" href="css/reset.css">
        <link rel="stylesheet" href="css/connexion.css">
    <!---------------- Fin CSS  --------------->



    <!-- Fin Liaison des diférentes pages (javascript, css, bootsrap, etc...) -->

    <!-- Titre apparent sur le haut de la page (nom de l'onglet) -->
    <title>Portfolio Mael</title>


</head>
<body>
<section>
       <h1> Connexion</h1>
       <?php 
       if(isset($erreur)){// si la variable $erreur existe , on affiche le contenu ;
           echo "<p class= 'Erreur'>".$erreur."</p>"  ;
       }
       ?>
       <form action="" method="POST">  <!--on ne mets plus rien au niveau de l'action , pour pouvoir envoyé les données  dans la même page -->
           <label>pseudo</label>
           <input type="text" name="pseudo">
           <label >Mots de Passe</label>
           <input type="password" name="mdp">
           <input type="submit" value="Valider" name="boutton-valider">
       </form>
   </section> 
</body>
</html>