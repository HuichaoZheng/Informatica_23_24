<?php ?>
<html lang="">
<head>
    <title>
        pagina login
    </title>

</head>

<body>
<link rel="stylesheet" href="../css/styles.css">
<header>
    <form action="signup.php">
        <input type="submit" value="Registra"/>
    </form>
</header>
<div class="title">Login page</div>
<div class="input-container">
<form action="../actions/login.php" method="POST">
    <input type="text" name="email" placeholder="Indirizzo Email">
    <input type="password" name="password" placeholder="Password">
    <input type="submit" value="Login"/>
</form>
</div>

</body>

</html>


