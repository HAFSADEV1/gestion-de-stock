<?php
session_start();
$erroMsg = "";
$exists = "";
if (isset($_POST["submit"])) {
    require_once 'config.php';
    $login = $_POST['login'];
    $password = $_POST['password'];

    if (empty($login) && empty($password)) {
        $erroMsg = "please fill all the fields";
    } else {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE login=:login and pass=:pass");
        if ($stmt) {
            $stmt->bindParam("login", $login);
            $stmt->bindParam("pass", $password);
            if ($stmt->execute()) {
                if ($stmt->rowCount() > 0) {
                    $_SESSION["loggedin"] = true;
                    header('location:produit.php');
                } else {
                    $exists = "user or password incorect";
                }
            } else {
                echo "svp reesayer plus tard.";
            }
        }
        // Close statement
        unset($stmt);
    }
}
//close connection
unset($pdo);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/App.css" />

</head>

<body>
    <div class="container  w-50">
        <h1 class="title">LOGIN FORM</h1>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
            <div class="form-group">
                <label for="login">Login</label>
                <input type="text" placeholder="Login" id="login" name="login" class="form-control inp">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" placeholder="Password" id="password" name="password" class="form-control inp">
            </div>
            <div class="form-group text-center">
                <button class="btn btn-success" type="submit" name="submit">Login</button>
            </div>
            <span class="err"><?php echo $erroMsg; ?> <br> <?php echo $exists; ?></span>

        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>

</html>