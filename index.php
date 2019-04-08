<?php
session_start();
require('mysql.php');
require('config.php');
require('funzioni.php');
?>

<html>
<head>
<title>Un carrello della spesa con PHP</title>
<style>
a{
	color: cornflowerblue;
	text-decoration: none;
}
span{
	color: brown;
	font-weight: bold;
}
</style>
</head>
<body>
<h1>Carrello in PHP</h1>

<?php
echo usaCarrello();
?>

<h1>Scegli un prodotto</h1>

<?php
$sql = 'SELECT * FROM prodotti ORDER BY id';
$res = mysqli_query($db, $sql);

$result[] = '<ol>';
while ($f = mysqli_fetch_assoc($res))
{
  $result[] = '<li><span>'.$f['nome']. '</span> by '.$f['marca']. ': &euro;'.$f['prezzo'].'<br>
  <a href="carrello.php?action=aggiungi&id='.$f['id'].'">Aggiungi al carrello.</a></li><br>';
}
$result[] = '</ol>';
echo join('',$result);
?>

</body>
</html>