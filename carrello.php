<?php
session_start();
require('mysql.php');
require('config.php');
require('funzioni.php');

$carrello = $_SESSION['carrello'];
if(isset($_GET['action']))
{
  $action = $_GET['action'];
  
  switch ($action)
  {
    case 'aggiungi':
    if ($carrello)
    {
      $carrello .= ','.$_GET['id'];
    }else{
      $carrello = $_GET['id'];
    }
    break;

    case 'cancella':
    if ($carrello)
    {
      $prodotti = explode(',',$carrello);
      $acquisto = '';
      foreach ($prodotti as $prodotto)
      {
        if ($_GET['id'] != $prodotto)
        {
          if ($acquisto != '')
          {
            $acquisto .= ','.$prodotto;
          }else{
            $acquisto = $prodotto;
          }
        }
      }
      $carrello = $acquisto;
    }
    break;

    case 'aggiorna':
    if ($carrello)
    {
      $acquisto = '';
      foreach ($_POST as $key=>$value)
      {
        if (stristr($key,'quantita'))
        {
          $id = str_replace('quantita','',$key);
          $prodotti = ($acquisto != '') ? 
          explode(',',$acquisto) : explode(',',$carrello);
          $acquisto = '';

          foreach ($prodotti as $prodotto)
          {
            if ($id != $prodotto)
            {
              if ($acquisto != '')
              {
                $acquisto .= ','.$prodotto;
              }else{
                $acquisto = $prodotto;
              }
            }
          }
  
          for ($i=1;$i<=$value;$i++)
          {
            if ($acquisto != '')
            {
              $acquisto .= ','.$id;
            }else{
              $acquisto = $id;
            }
          }
        }
      }
    }
    $carrello = $acquisto;
    break;
  }
}

$_SESSION['carrello'] = $carrello;
?>

<html>
<head>
<title>Un carrello della spesa con PHP</title>
<style>
a{
	color: cornflowerblue;
	text-decoration: none;
}
</style>
</head>
<body>
<h1>Carrello in PHP</h1>

<?php
echo usaCarrello();
?>

<h1>Controlla il numero dei prodotti</h1>

<?php
echo mostraCarrello();
?>

<a href="index.php">Torna allo shop</a><br>
</body>
</html