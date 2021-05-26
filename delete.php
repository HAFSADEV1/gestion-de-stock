<?php
if(isset($_GET["ref"]) && !empty($_GET["ref"])){
   
    require_once "config.php";
    
 
    $sql = "DELETE FROM produits WHERE ref= :ref";
    
    if($stmt = $pdo->prepare($sql)){
    
        $stmt->bindParam(":ref", $param_ref);
        
        // Set parameters
        $param_ref = trim($_GET["ref"]);
     
        if($stmt->execute()){
         
            header("location: produits.php");
            exit();
        } else{
            echo "Oops! reesayez dans quelques instants.";
        }
    }
     
    // Close statement
    unset($stmt);
    
    // Close connection
    unset($pdo);
} else{
    // Check existence of ref parameter
    if(empty(trim($_GET["ref"]))){
      
        echo "ERROR!!!";
        exit;
    }
}