<?php
//echo "vous avez bien supprimé votre compte";
$idFilm = $_POST["id"];
Include("{$_SERVER['DOCUMENT_ROOT']}/film/Cdb.php");
$result = $db->query("DELETE FROM t_films WHERE idFilm = '$idFilm'");
if($result === TRUE)
{
//echo "suppression reussie";
header("Location: /clients/clients.php");
?>
<html>
<button onclick="window.location.href='/choose.php'">Revenir au menu</button>
<?php
}
else{
    echo "erreur".mysqli_error($db);
}
?>
</html>