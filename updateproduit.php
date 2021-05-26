<?php
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === false) {
    header("location:login.php");
    exit;
}

require_once 'config.php';

if(isset($_GET['ref'])){
    $ref=$_GET['ref'];
    $sql="SELECT * FROM produits WHERE ref=:ref"; 
    $stmt=$pdo->prepare($sql);
    if($stmt){
        //bind params
        $stmt->bindParam("ref",$ref);
        if($stmt->execute()){
           $row= $stmt->fetch();   
        }
    }
   
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $input_ref = trim($_POST["ref"]);
    if (empty($input_ref)) {
        $refError = "rempli une référence";
    }
    $input_libelle = trim($_POST["libelle"]);
    if (empty($input_libelle)) {
        $libelleError = "svp rempli une libelle.";
    }
    $input_prixU = trim($_POST["prixUnitair"]);
    if (empty($input_prixU)) {
        $prixUError = "svp rempli un prix unitair.";
    }
    $input_categorie = trim($_POST["cat"]);
    if (empty($input_categorie)) {
        $catError = "svp rempli une catégorie";
    }
    $input_prixMin = trim($_POST["prixMin"]);
    if (empty($input_prixMin)) {
        $prixMinError = "svp rempli un prix min.";
    }
    $input_qte = trim($_POST["qte"]);
    if (empty($input_qte)) {
        $qteError = "svp rempli une quantite.";
    }
    $input_stock = trim($_POST["qtestock"]);
    if (empty($input_stock)) {
        $stockError = "svp rempli une quantite de stock.";
    }
    if ($input_qte > $input_stock) {
        $globalError = "quantité doit etre inferieur ou egal a la quantite de stock";
    }
    if (empty($refError) && empty($libelleError) && empty($prixUError) && empty($catError) && empty($prixMinError)  && empty($qteError)  && empty($globalError) && empty($stockError)) {

        $stmt = $pdo->prepare("UPDATE produits SET libelle=:libelle,prixUnitair=:prixU,prixMin=:prixMin,qte=:qte,QteStock=:qteStock,categorie=:categorie WHERE ref=:ref");

        if ($stmt) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":ref", $_GET['ref']);
            $stmt->bindParam(":libelle", $param_libelle);
            $stmt->bindParam(":prixU", $param_prixU);
            $stmt->bindParam(":prixMin", $param_prixMin);
            $stmt->bindParam(":qte", $param_Qte);
            $stmt->bindParam(":qteStock", $param_QteStock);
            $stmt->bindParam(":categorie", $param_categorie);
            //set parameters
            $param_ref = intval($input_ref);
            $param_libelle = $input_libelle;
            $param_prixU = floatval($input_prixU);
            $param_prixMin = floatval($input_prixMin);
            $param_Qte = intval($param_Qte);
            $param_QteStock = intval($param_QteStock);
            $param_categorie = $input_categorie;

            if ($stmt->execute()) {
                header("location:produits.php");
                exit;
            } else {
                echo "reesayer dans quelques instants.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UPDATE</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/App.css" />

</head>
<body>
<div class="container text-center">
        <h1>Modifier produit</h1>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <input type="text" class="form-control" name="ref" value="<?php echo $row[0]?>">
                  
                </div>
                <div class="form-group col-md-6">
                    <input class="form-control" name="libelle" value="<?php echo $row['libelle']?>">
                   
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <input class="form-control" name="prixUnitair" placeholder="prix unitair" value="<?php echo $row['prixUnitair']?>">
                </div>
                <div class="form-group col-md-6">
                    <input class="form-control" placeholder="catégorie" name="cat" value="<?php echo $row['categorie']?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <input class="form-control" placeholder="prix min" name="prixMin" value="<?php echo $row['prixMin']?>">
                </div>
                <div class="form-group col-md-4">
                    <input class="form-control" name="qte" placeholder="Qte" value="<?php echo $row['qte']?>">
                </div>
                <div class="form-group col-md-4">
                    <input class="form-control" placeholder="Qte en Stock" name="qtestock" value="<?php echo $row['qteStock']?>">
                </div>
            </div>
            <button class="btn btn-success" name="submit" type="submit">Modifier</button>

        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>
</html>