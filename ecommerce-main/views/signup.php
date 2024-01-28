<?php ?>
<html lang="">
<head>
    <title>
        pagina signup
    </title>

</head>

<body>
<link rel="stylesheet" href="../css/styles.css">
<header>
    <form action="index.php">
        <input type="submit" value="Index"/>
    </form>
    <form action="login.php">
        <input type="submit" value="Login"/>
    </form>
</header>
<div class = "title">Signup page</div>
<div class="input-container">
<form action="../actions/signup.php" method="POST">
    <input type="text" name="email" placeholder="Indirizzo Email">
    <input type="password" name="password" placeholder="Password">
    <div>
    <label>
        <input type="radio" name="role_id" value="1"> User
    </label>
    <label>
        <input type="radio" name="role_id" value="2"> Admin
    </label>
    </div>
    <input type="submit" value="Registra"/>
</form>
</div>

</body>

</html>