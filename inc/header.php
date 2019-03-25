<?php
use VanillaPHP\Helpers\AuthManager;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Vanilla App</title>
    <meta name="description" content="">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="css/materialize.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
  <nav class="light-blue lighten-1" role="navigation">
    <div class="nav-wrapper container">
      <a id="logo-container" href="/" class="brand-logo">PetProject</a>
      <ul class="right hide-on-med-and-down">
        <?php if(!AuthManager::is_authenticated()) {?>
        <li><a href="/index.php">Login</a></li>
        <li><a href="/register.php">Register</a></li>
        <?php } else {?>
          <li><a href="/countries.php">Countries</a></li>
          <li><a href="/users.php">Users</a></li>
          <li><a href="/profile.php">Profile</a></li>
          <li><a href="/procedures/do_logout.php">Logout</a></li>
          <?php } ?>
      </ul>

        <ul id="nav-mobile" class="sidenav">
          <?php if(!AuthManager::is_authenticated()) {?>
            <li><a href="/index.php">Login</a></li>
            <li><a href="/register.php">Register</a></li>
          <?php } else {?>
            <li><a href="/countries.php">Countries</a></li>
            <li><a href="/profile.php">Profile</a></li>
            <li><a href="/procedures/do_logout.php">Logout</a></li>
          <?php } ?>
        </ul>
        <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
      </div>
    </nav>
  </header>
  <main>
