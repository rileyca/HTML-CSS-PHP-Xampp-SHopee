<?php

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $mysqli = require __DIR__ . "/database.php";
    $sql = sprintf("SELECT * FROM user
                    WHERE email = '%s'",
                   $mysqli->real_escape_string($_POST["email"]));
                   $mysqli ->real_escape_string($_POST["id"]);
    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();
    if ($user) {
        if (password_verify($_POST["password"], $user["password_hash"])) {
            session_start();
            session_regenerate_id();
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["email"] = $user["email"];
            $_SESSION["Photo"] = $user["Photo"];
            header("Location: index.php");
            exit;
        }
    }
    
    $is_invalid = true;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css"> -->
    <link rel="stylesheet" href="./assets/fonts/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="./assets/css/login.css">
    
</head>
<body background="https://cdn.wallpapersafari.com/99/90/UkahRm.jpg">   
   
    
    <form method="post" class="list-login">
    <div class="list-form">
    <div class="home-login" >
    <h1 >Login-User</h1>  
   <a href="./index.php"> <i class="ti-home"></i></a>
   
</div>
<div style="margin-left: 10px; color:blue;">
<?php if ($is_invalid): ?>
        <em>Error login faid</em>
    <?php endif; ?>
    </div>
    <div class="form-email">
        <label  for="email">Email</label>
        <input type="email" name="email" id="email" placeholder="Enter Email" class="input-password"
               value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">
               </div>

        <div class="form-password">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="Enter Password" class="input-password">
        </div>
        <button class="btn">Log in</button>
        <button class="btn "> <a href="./signup.html" class="btn-link" > Register </a>  </button>
        
        </div>
        <div class="link-admin">
       <button class="link-access"> <a  href="/admin/login-admin.php">Admin access </a>  </button>
        </div>
    </form>
    
    
    
</body>
</html>









