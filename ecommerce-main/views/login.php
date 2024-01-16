<?php ?>
<html lang="">
<head>
    <title>
        pagina login
    </title>

</head>

<body>
login page
<form action="../actions/login.php" method="POST">
    <input type="text" name="email" placeholder="Indirizzo Email">
    <input type="password" name="password" placeholder="Password">
    <input type="submit" value="Login"/>
</form>
<h3>Non hai un account? <a href = "signup.php">Registrati</a></h3>

</body>

</html>


