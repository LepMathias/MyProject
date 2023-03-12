<!DOCTYPE html>
<html lang="fr" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="Description" content="Le Quai Antique, restaurant du Chef Arnaud Michant, propose une cuisine authentique
    et passionnée autour des produits et producteurs de Savoie.">
    <meta name="keywords" content="restaurant, savoie, Arnaud, Michant, Chef, cuisine, authentique, produits frais">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href='https://fonts.googleapis.com/css?family=Rock+Salt' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="../src/css/style.css">
    <title>Le Quai Antique</title>
</head>
<header>
    <div class="container-fluid nav-container">
        <nav class="row align-items-center" id="navMenu">
            <div class="col-md-3">
                <a href="/" class="btn" id="homePage"><h1 class="logo">Le Quai Antique</h1></a>
            </div>
            <div class="col-md-6 justify-content-md-start">
                <div class="row">
                    <a href="/menus" class="btn" id="menusPage"><h2>Carte et Menus</h2></a>
                </div>
            </div>
            <div class="col-md-3">
                <ul>
                    <?php if(isset($_SESSION) && $_SESSION['admin'] === 1): ?>
                    <li class="nav-btn">
                        <p class="text-center"><?= $_SESSION['firstname'].' '.$_SESSION['lastname'] ?></p></li>
                    <li class="nav-btn">
                        <a href="/parameters/reservations" class="btn" id="param"><h6>Paramètres</h6></a></li>
                    <li class="nav-btn">
                        <a href="/logout" class="btn" id="log-out"><h6>Log out</h6></a></li>
                    <?php elseif(isset($_SESSION) && $_SESSION['admin'] === 0): ?>
                    <li class="nav-btn">
                        <p class="text-center"><?= $_SESSION['firstname'].' '.$_SESSION['lastname'] ?></p></li>
                    <li class="nav-btn">
                        <a href="/logout" class="btn" id="log-out"><h6>Log out</h6></a></li>
                    <?php else: ?>
                    <li class="nav-btn">
                        <button class="btn" id="log-in"><h6>Log in</h6></button></li>
                    <li class="nav-btn">
                        <button class="btn" id="sign-up"><h6>Sign up</h6></button></li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
    </div>
</header>
<body>
