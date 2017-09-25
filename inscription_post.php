<?php
try
{
$bdd = new PDO('mysql:host=localhost;dbname=membre;charset=utf8', 'phpmyadmin', 'sana15');
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}


$pass_hache = sha1($_POST['pass']);

$req = $bdd->prepare('SELECT pseudo FROM membre WHERE pseudo = :pseudo');
$req->execute(array(
    'pseudo' => $_POST['pseudo']));
$resultat = $req->fetch();




if (isset($_POST['email']) && isset($_POST['pseudo']) && isset($_POST['pass']) && isset($_POST['confirmpass']))
{

    $_POST['email'] = htmlspecialchars($_POST['email']);
    $_POST['pseudo'] = htmlspecialchars($_POST['pseudo']);
    $_POST['pass'] = htmlspecialchars($_POST['pass']);
    $_POST['confirmpass'] = htmlspecialchars($_POST['confirmpass']);
    if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['email'])  &&   ($_POST['pseudo'] != $resultat['pseudo']) && ($_POST['pass'] == $_POST['confirmpass']) )
    {
        $req = $bdd->prepare('INSERT INTO membre(pseudo, pass, email, date_inscription) VALUES(:pseudo, :pass, :email, CURDATE())');
        $req->execute(array(
            'pseudo' => $_POST['pseudo'],
            'pass' => $pass_hache,
            'email' => $_POST['email']
            ));
        header('Location: inscription.php');
    }
  }

    else
    {
        echo 'errrrrrrrrrrrrreurr';
    }

  ?>


<?php
  if ($_POST['pseudo'] == $resultat['pseudo'] )
  {
      echo ' identifiant existant!';
  }
  else
  {

      echo 'identifiant OK';
  }


  if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['email']))
  {
      echo 'L\'adresse ' . $_POST['email'] . ' est <strong>valide</strong> !';
      // echo ' email ok!';
    }
    else{
      echo 'L\'adresse ' . $_POST['email'] . ' est pas dans le bon format !';
    }

    if ($_POST['pass'] == $_POST['confirmpass'])
    {
      echo 'mot de passe OK';
    }
    else{

      echo 'le champ mot de passe doit etre identique au champ confirmer';
    }

?>
