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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../src/css/style.css">
    <title>Le Quai Antique</title>
</head>
<header>
    <div class="container-fluid nav-container">
        <nav class="row justify-content-between" id="navMenu">
            <div class="col-md-5 d-flex align-items-center">
                <div class="dropdown">
                    <button class="btn btn-secondary" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-menu-down"></i>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a href="/menus" class="btn" id="menusPage"><p>Carte et Menus</p></a></li>
                        <?php if(isset($_SESSION['user']) && $_SESSION['admin'] === 1 || $_SESSION['admin'] === 2): ?>
                            <li>
                                <a class="dropdown-item" id="param" href="/parameters/reservations"><h6>Paramètres</h6></a></li>
                            <li class="nav-btn">
                                <a class="dropdown-item" id="log-out" href="/logout"><h6>Log out</h6></a></li>
                        <?php elseif(isset($_SESSION['user']) && $_SESSION['admin'] === 0): ?>
                            <li class="nav-btn">
                                <a class="dropdown-item" id="profile" href="/profile"><h6>Profil</h6></a></li>
                            <li class="nav-btn">
                                <a class="dropdown-item" id="log-out" href="/logout"><h6>Log out</h6></a></li>
                        <?php else: ?>
                            <li class="nav-btn">
                                <button class="dropdown-item" id="log-in"><h6>Log in</h6></button></li>
                            <li class="nav-btn">
                                <button class="dropdown-item" id="sign-up"><h6>Sign up</h6></button></li>
                        <?php endif; ?>
                    </ul>
                </div>
                <a href="/" class="btn" id="homePage"><h1 class="logo">Le Quai Antique</h1></a>
            </div>
            <div class="col-md-3">
                <?php if(isset($_SESSION)):
                    if($_SESSION['admin'] === 2):?>
                        <a class="btn" id="newAdmin-btn" href="/admin/users"><p><?= $_SESSION['firstname'].' '.$_SESSION['lastname'] ?></p></a>
                    <?php else:?>
                        <p><?= $_SESSION['firstname'].' '.$_SESSION['lastname'] ?></p>
                    <?php endif;
                endif;?>
            </div>
        </nav>
    </div>
</header>
<body>
