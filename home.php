<?php
session_start();

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>BookExchange</title>
  <link rel="icon" href="imgs/icon.png" type="image/x-icon" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>

<body class="bg-dark-subtle ">
  <header
    class="bg-secondary d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
    <a href="/bookexchange/home.php"
      class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
      <div class="container">
        <div class="row row-cols-2">
          <div class="col-auto">
            <img class="bi me-2" src="imgs/icon.png" width="40" height="40" role="img" aria-label="Bootstrap">
            </img>
          </div>
          <div class="col-sm d-flex align-items-start">
            <h3>
              BookExchange
            </h3>
          </div>
        </div>
      </div>

    </a>

    <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
      <li><a href="/bookexchange/home.php" class="nav-link px-2 link-dark">Home</a></li>
      <li><a href="docs.html" class="nav-link px-2 link-dark">Docs</a></li>
    </ul>

    <div class="col-md-3 text-end pe-5 pe-lg-5">
      <a type="button" class="btn <?php
      if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"])
        echo ("btn-light");
      else
        echo ("btn-outline-light ");
      ?> me-2" href=<?php

       if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]) {
         $userId = $_SESSION["user"]["id"];
         echo ("api.php/user/$userId/profile");
       } else
         echo ("/bookexchange/login.php");
       ?>>
        <?php
        if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"])
          echo ('<i class="bi-person-circle"></i> Profile');
        else
          echo ("Login");
        ?>

      </a>
      <a type="button" class="btn <?php
      if (isset($_SESSION["loggedin"])  && $_SESSION["loggedin"])
        echo ("btn-outline-danger ");
      else
        echo ("btn-dark");
      ?> " href=<?php
       if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]) {
         echo ('"logout.php"');
       } else {
         echo ('"register.php"');
       }
       ?>>
        <?php
        if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]) {
          echo ("Logout");
        } else {
          echo ("Sign Up");
        }
        ?>
      </a>
    </div>
  </header>

  <main class="container-fluid overflow-y-scroll mx-auto" style="max-height: 800px;">
    <div class="row">
      <div class="col-auto ml-sm-auto col-lg-10 pt-3 px-4">
        <h3>Cerca tra i libri disponibili</h3>
        <div class="input-group mb-3">
          <input id="book-search-bar" class="form-control mr-sm-2" type="search"
            placeholder="Ricerca per titolo, autore o categoria" aria-label="Search">
          <div class="input-group-append">
            <button id="confirm-search-input" class="btn btn-outline-secondary " type="button"><i class="bi-search"></i> Search</button>
          </div>
        </div>
       
          <ul id="book-search-results" class="list-group" style=""></ul>
      </div>
    </div>
  </main>





</body>
<li id="book-template" hidden class="media list-group-item list-group-item-action" style="">
  <div class="d-flex">
    <div>
      <img id="img" class="flex-shrink-0" src="" width="200" height="248" alt="Generic placeholder image">
    </div>

    <div id="body" class="flex-grow-1 ms-3">

      <div class="row">
        <div class="col-sm-3">
          <p class="mb-0">Titolo</p>
        </div>
        <div class="col-sm-9">
          <h5 id="title" class="mt-0 mb-1">{titolo}</h5>
          </p>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-3">
          <p class="mb-0">Proprietario</p>
        </div>
        <div class="col-sm-9">
          <a id="proprietario" href=""></a>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-3">
          <p class="mb-0">Editore</p>
        </div>
        <div class="col-sm-9">
          <p id="editore" class="text-muted mb-0">
            {editore}
          </p>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-3">
          <p class="mb-0">Autori</p>
        </div>
        <div class="col-sm-9">
          <p id="autori" class="text-muted mb-0">

          </p>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-3">
          <p class="mb-0">Categorie</p>
        </div>
        <div class="col-sm-9">
          <p id="categorie" class="text-muted mb-0">

          </p>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-3">
          <p class="mb-0">Anno pubblicazione</p>
        </div>
        <div class="col-sm-9">
          <p id="anno" class="text-muted mb-0">
            {anno}
          </p>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-3">
          <p class="mb-0">Lingua</p>
        </div>
        <div class="col-sm-9">
          <p id="lingua" class="text-muted mb-0">
            {lingua}
          </p>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-sm-9">
          <p id="descrizione" class="text-muted mb-0">
            {descrizione}
          </p>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col">
          <button id="scambio" class="btn btn-secondary">Scambia</button>
        </div>

      </div>
    </div>
  </div>
</li>
<script src="/bookexchange/javascript/homepagescript.js"></script>

</html>