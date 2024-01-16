<?php ?>
<html lang="">
<head>
    <title>
        pagina signup
    </title>

</head>

<body>
signup page
<form action="../actions/signup.php" method="POST">
    <input type="text" name="email" placeholder="Indirizzo Email">
    <input type="password" name="password" placeholder="Password">
    <label>
        <input type="radio" name="role_id" value="1"> User
    </label>
    <label>
        <input type="radio" name="role_id" value="2"> Admin
    </label>
    <input type="submit" value="Registra"/>
</form>
<h3>Hai già l'account? <a href = "login.php">Accedi</a></h3>

</body>

</html>