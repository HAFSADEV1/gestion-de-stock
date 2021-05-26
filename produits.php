<?php
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === false) {
    header("location:login.php");
    exit;
}
require_once "config.php";
$categorie = '';
$query = "SELECT DISTINCT categorie FROM produits";
$stmt = $pdo->prepare($query);
$stmt->execute();
$result = $stmt->fetchAll();
foreach ($result as $cat) {
    $categorie .= '<option value="' . $cat["categorie"] . '">' . $cat["categorie"] . '</option>';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <title>Gestion De Stock</title>
    <link rel="stylesheet" href="./css/App.css" />
</head>

<body>
    <div class="container text-center">
        <h1>List des produit</h1>

        <select class="form-control">
            <option value="">choisir categorie</option>
            <?php echo $categorie; ?>
        </select> <br/><br/>
        <table class="table table-striped">
            <tr>
                <th>référence</th>
                <th>libellé</th>
                <th>prix unitair</th>
                <th>catégorie</th>
                <th>prix min</th>
                <th>Qte</th>
                <th>Qte Stock</th>
                <th>Mis A jour</th>
            </tr>
           <tbody>

           </tbody>
        </table>
    </div>

    <script src="./js/main.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

</body>

</html>