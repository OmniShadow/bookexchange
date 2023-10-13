<?php
session_start();
$host = $_SERVER["HTTP_HOST"];
$idOfferta = $_GET["offerta"];

if (!isset($_SESSION["user"]))
    header("Location: login.php");


$user = $_SESSION["user"];

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $host . "/bookexchange/api.php/book/ownedBook?id=$idOfferta");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HEADER, false);
$curlOutput = curl_exec($curl);
curl_close($curl);
$offerta = json_decode($curlOutput, true)[0];



$idOfferente = $offerta["proprietario"];
if ($_SESSION["user"]["id"] == $idOfferente)
    header("Location: home.php");
$idLibroOfferto = $offerta["libro"];

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $host . "/bookexchange/api.php/user/$idOfferente");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HEADER, false);
$curlOutput = curl_exec($curl);
curl_close($curl);


$offerente = json_decode($curlOutput, true)["user"];

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $host . "/bookexchange/api.php/book/$idLibroOfferto");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HEADER, false);

$curlOutput = curl_exec($curl);
curl_close($curl);

$libroOfferto = json_decode($curlOutput, true)[0];

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $host . "/bookexchange/api.php/book/$idLibroOfferto/authors");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HEADER, false);

$curlOutput = curl_exec($curl);
curl_close($curl);

$autoriLibroOfferto = json_decode($curlOutput, true);

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $host . "/bookexchange/api.php/book/$idLibroOfferto/categories");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HEADER, false);

$curlOutput = curl_exec($curl);
curl_close($curl);

$categorieLibroOfferto = json_decode($curlOutput, true);


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

<body class="text-center bg-dark-subtle">

    <header
        class="bg-secondary d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 border-bottom">

        <a href="/bookexchange/home.php"
            class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
            <div class="container">
                <div class="row row-cols-3">
                    <div class="col-auto">
                        <img class="bi me-2" src="/bookexchange/imgs/icon.png" width="40" height="40" role="img"
                            aria-label="Bootstrap">
                        </img>
                    </div>
                    <div class="col-auto d-flex align-items-start">
                        <h3>
                            BookExchange
                        </h3>
                    </div>
                </div>

            </div>
        </a>

        <ul class="nav col-12 col-md-auto justify-content-center ">
            <li><a href="/bookexchange/home.php" class="nav-link px-2 link-dark">Home</a></li>
            <li><a href="docs.html" class="nav-link px-2 link-dark">Docs</a></li>
        </ul>

        <div class="col-md-3 text-end">
        </div>
    </header>

    <main class="container-lg bg-body-secondary my-5">
        <div class="row border ">
            <div class="col border border-dark">
                <div class="row px-2 pt-4">
                    <div class="">
                        <div class="d-flex align-items-center text-black text-decoration-none">
                            <img src=<?php echo $user["avatar"] ?> width="64" height="64" class="rounded-circle">
                            <span class="d-none d-sm-inline mx-1">
                                <?php echo $user["username"] ?>
                            </span>
                            <span id="user-id" class="d-none d-sm-inline mx-1 text-secondary">
                                <?php echo "#" . $user["id"] ?>
                            </span>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row px-2">
                    <select id="user-book-select" class="form-select bg-body-tertiary border border-dark"
                        aria-label="Default select example">
                        <option value="default" selected>Scegli libro da scambiare</option>
                    </select>
                </div>
                <hr>
                <div class="row px-2 pb-2">
                    <li id="user-book-template" hidden class="media list-group-item list-group-item-action">
                        <div class="d-flex">
                            <div>
                                <img id="copertina" class="flex-shrink-0" src="" width="200" height="248"
                                    alt="Generic placeholder image">
                            </div>

                            <div id="body" class="flex-grow-1 ms-3">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Titolo</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <h5 id="titolo" class="mt-0 mb-1">
                                        </h5>

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
                                        <p class="mb-0">Editore</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p id="editore" class="text-muted mb-0">
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
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Lingua</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p id="lingua" class="text-muted mb-0">
                                        </p>
                                    </div>
                                </div>
                                <hr>
                            </div>
                        </div>
                    </li>
                </div>

            </div>
            <div class="col border border-dark">
                <div class="row px-2 pt-4">
                    <div class="">
                        <div class="d-flex align-items-center text-black text-decoration-none">
                            <img src=<?php echo $offerente["avatar"] ?> width="64" height="64" class="rounded-circle">
                            <span class="d-none d-sm-inline mx-1">
                                <?php echo $offerente["username"] ?>
                            </span>
                            <span id="offerente-id" class="d-none d-sm-inline mx-1 text-secondary">
                                <?php echo "#" . $offerente["id"] ?>
                            </span>
                        </div>
                    </div>
                </div>
                <hr>


                <div class="row px-2 pt-lg-5">
                    <li id="book-template" class="media list-group-item list-group-item-action">
                        <div class="d-flex">
                            <h1 id="libro-offerto-id" hidden>
                                <?php echo $libroOfferto["id"] ?>
                            </h1>
                            <div>
                                <img id="img" class="flex-shrink-0" src=<?php echo $libroOfferto["copertina"] ?>
                                    width="200" height="248" alt="Generic placeholder image">
                            </div>

                            <div id="body" class="flex-grow-1 ms-3">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Titolo</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <h5 id="title" class="mt-0 mb-1">
                                            <?php echo $libroOfferto["titolo"] ?>
                                        </h5>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Autori</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <?php
                                        foreach ($autoriLibroOfferto as $autore) {
                                            echo '<p id="autore" class="text-muted mb-0">
                                                ' . $autore["autore"] . '
                                            </p>';
                                        }
                                        ?>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Editore</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p id="editore" class="text-muted mb-0">
                                            <?php echo $libroOfferto["editore"] ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Categorie</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <?php
                                        foreach ($categorieLibroOfferto as $categoria) {
                                            echo '<p id="cateogria" class="text-muted mb-0">
                                                ' . $categoria["categoria"] . '
                                            </p>';
                                        }
                                        ?>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Anno pubblicazione</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p id="anno" class="text-muted mb-0">
                                            <?php echo $libroOfferto["anno"] ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Lingua</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p id="lingua" class="text-muted mb-0">
                                            <?php echo $libroOfferto["lingua"] ?>
                                        </p>
                                    </div>
                                </div>
                                <hr>
                            </div>
                        </div>
                    </li>
                </div>
            </div>
        </div>
        <div class="container-sm w-25">
            <div class="row align-content-center ">
                <button id="proponi-scambio" class="btn btn-danger">
                    proponi scambio
                </button>
            </div>
        </div>
    </main>

</body>
<script>
    var userBooksSelect = document.getElementById("user-book-select");
    var userId = <?php echo $user["id"]?>;
    var offerenteId = <?php echo $idOfferente; ?>;
    var libroOffertoId = "<?php echo $idLibroOfferto ?>";
    console.log(libroOffertoId);
    var selectedBookElement = document.getElementById("user-book-template");
    var proponiScambioButton = document.getElementById("proponi-scambio");
    var userBooks;
    var selectedBook;

    fetch("/bookexchange/api.php/user/" + userId + "/books", {
        method: "GET",
    })
        .then((response) => response.json())
        .then((books) => {
            userBooks = books;
            books.forEach((book) => {
                fetch(
                    "/bookexchange/api.php/book/" +
                    book.libro +
                    "/authors",
                    { method: "GET" }
                )
                    .then((response) => response.json())
                    .then((authors) => {
                        let bookAuthors = "";
                        authors.forEach((autore) => {
                            bookAuthors = bookAuthors + autore.autore+ ', ';
                        });
                        book.autori = bookAuthors;
                    });
                fetch(
                    "/bookexchange/api.php/book/" +
                    book.libro +
                    "/categories",
                    { method: "GET" }
                )
                    .then((response) => response.json())
                    .then((categories) => {
                        let bookCategories = "";
                        categories.forEach((categoria) => {
                            bookCategories = bookCategories + categoria.categoria + ', ';
                        });
                        book.categorie = bookCategories;
                    });
                optionElement = document.createElement("option");
                optionElement.setAttribute("value", books.indexOf(book));
                optionElement.innerText = book.titolo;
                userBooksSelect.appendChild(optionElement);
            });
        });

    userBooksSelect.addEventListener("change", function (event) {
        if (event.target.value == "default") {
            selectedBookElement.setAttribute("hidden", true);
            selectedBook = null;
            return;
        }
        selectedBook = userBooks[event.target.value];
        selectedBookElement.querySelector("#titolo").innerText = selectedBook.titolo;
        selectedBookElement.querySelector("#lingua").innerText = selectedBook.lingua;
        selectedBookElement.querySelector("#editore").innerText =
            selectedBook.editore;
        selectedBookElement.querySelector("#autori").innerText = selectedBook.autori;
        selectedBookElement.querySelector("#categorie").innerText =
            selectedBook.categorie;
        selectedBookElement.querySelector("#anno").innerText = selectedBook.anno;
        selectedBookElement
            .querySelector("#copertina")
            .setAttribute("src", selectedBook.copertina);

        selectedBookElement.removeAttribute("hidden");
    });

    function sleep(ms) {
        return new Promise((resolve) => setTimeout(resolve, ms));
    }

    function proponiScambio(e) {
        if (!selectedBook) return;
        let formData = new FormData();
        formData.append("offerta", <?php echo $offerta["id"]?>);
        formData.append("proposta", selectedBook.id);

        fetch("/bookexchange/api.php/exchange/create", {
            method: "POST",
            body: formData,
        })
            .then((response) =>
                response.json())
            .then((postResponse) => {
                if (postResponse["status"]) {
                    proponiScambioButton.classList.remove("btn-danger");
                    proponiScambioButton.classList.add("btn-success");
                    proponiScambioButton.classList.add("disabled");
                    proponiScambioButton.innerText = "Proposta effettuata";
                    proponiScambioButton.removeEventListener("click", proponiScambio);

                    sleep(2000).then(() =>
                        window.location.replace("/bookexchange/home.php")
                    );
                }
            });
    }

    proponiScambioButton.addEventListener("click", proponiScambio);

</script>

</html>