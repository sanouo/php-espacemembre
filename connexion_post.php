<?php
try
{
$bdd = new PDO('mysql:host=localhost;dbname=membre;charset=utf8', 'phpmyadmin', 'sana15');
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}
?>


<?php
$pass_hache = sha1($_POST['pass']);
$req = $bdd->prepare('SELECT * FROM membre WHERE pseudo = :pseudo AND pass = :pass');
$req->execute(array(
    'pseudo' => $_POST['pseudo'],
    'pass' => $pass_hache));
$resultat = $req->fetch();


if ($_POST['pseudo'] != $resultat['pseudo'] or $pass_hache != $resultat['pass'] )
{
    echo 'Mauvais identifiant ou mot de passe !';
}
else
{
    session_start();
    // $_SESSION['id'] = $resultat['id'];
    // $_SESSION['pseudo'] = $pseudo;
    echo 'Vous êtes connecté !';
}
?>
