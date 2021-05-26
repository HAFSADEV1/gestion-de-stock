<?php

require_once "config.php";
if (isset($_POST['cat'])) {
    $cat = $_POST['cat'];
    $sql = "SELECT * FROM produits  WHERE categorie='$cat'";

    foreach($pdo->query($sql) as $row){
      
        echo "<tr>";
        echo "<td>" . $row['ref'] . "</td>";
        echo "<td>" . $row['libelle'] . "</td>";
        echo "<td>" . $row['prixUnitair'] . "</td>";
        echo "<td>" . $row['categorie'] . "</td>";
        echo "<td>" . $row['prixMin'] . "</td>";
        echo "<td>" . $row['qte'] . "</td>";
        echo "<td>" . $row['qteStock'] . "</td>";
        echo "<td>"."<a href='updateproduit.php?ref=". $row['ref'] ."' title='Modifier'><img src='img/edit.png' width='30'></a>"."<a href='delete.php?ref=". $row['ref'] ."' title='Supprimer'><img src='img/trash.png' width='30'></a>"."</td>";
        echo "</tr>";
      
    }
     unset($result);
}

 unset($pdo);