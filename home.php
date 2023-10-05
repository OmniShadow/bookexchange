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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>

<body class="bg-body-tertiary ">
  <header>
    <nav class="navbar navbar-expand-sm p-3 bg-primary-subtle">
      <div class="container-fluid">
        <a class="navbar-brand" href="home.php">
          <div class="container">
            <div class="row">
              <div class="col-sm">
                <img class="img-thumbnail" src="imgs/icon.png" alt="" width="50" height="50">
              </div>
              <div class="col-sm">
                <h2>
                  BookExchange
                </h2>
              </div>
            </div>
          </div>
        </a>
        <span>
          <div class="collpase navbar-collapse">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link" href=<?php

                if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]) {
                  $userId = $_SESSION["user"]["id"];
                  echo ("api.php/user/$userId/profile");
                } else
                  echo ("login.php");
                ?>>
                  <h5>
                    <?php
                    if (isset($_SESSION["loggedin"]))
                      echo ("Profile");
                    else
                      echo ("Login");
                    ?>
                  </h5>
                </a>
              </li>
              <li class="nav-item">
                <?php
                if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]) {
                  echo ('<a class="nav-link" href="logout.php">
                  <h5>
                    Logout
                  </h5>
                </a>');

                } else {
                  echo ('<a class="nav-link" href="register.php">
                <h5>
                  Register
                </h5>
              </a>');
                }
                ?>

              </li>
            </ul>
          </div>
        </span>
      </div>
    </nav>
  </header>



  <div class="container-fluid">
    <div class="row">
      <nav class="col-md-2 d-md-block bg-light navbar">
        <ul class="nav flex-column">
          <li class="nav-item border">
            <a class="nav-link" href="#">
              HOME
            </a>
          </li>
        </ul>

      </nav>
      <main class=" col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        <h3>Cerca tra i libri disponibili</h3>
        <div class="input-group mb-3">
          <input id="book-search-bar" class="form-control mr-sm-2" type="search" placeholder="Ricerca per titolo, autore o categoria"
            aria-label="Search">
          <div class="input-group-append">
            <button id="confirm-search-input" class="btn btn-outline-secondary " type="button">Search</button>
          </div>
        </div>
        <ul id="book-search-results" class="list-unstyled list-group"></ul>
      </main>
    </div>
  </div>





</body>
<li id="book-template" hidden class="media list-group-item list-group-item-action">
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
          <button id="scambio" class="btn btn-primary">Scambia</button>
        </div>

      </div>
    </div>
  </div>
</li>
<script src="homepagescript.js"></script>

</html>