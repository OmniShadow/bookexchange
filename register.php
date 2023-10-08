<?php
$htmlForm = file_get_contents("registrationform.html");
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

<body class="text-center bg-dark-subtle align-items-center justify-content-center">

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

    <div class="p-5">
        <div class="align-items-center text-center">
            <img class="mb-4" src="imgs/icon.png" alt="" width="72" height="72">
            <h3>Registrazione utente</h3>
        </div>
        <hr>

        <?php
        echo ($htmlForm);
        ?>


    </div>





</body>
<script>
    var form = document.getElementById("registration-form");

    form.addEventListener("submit", function (event) {
        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        }

        let emailInput = document.getElementById("email");
        if (!emailInput.value
            .toLowerCase()
            .match(
                /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|.(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
            ))
            emailInput.setCustomValidity("Inserisci un'indirizzo email valido");
        else
            emailInput.setCustomValidity("");
        let passwordInput = document.getElementById("password");
        let confirmPasswordInput = document.getElementById("confirm-password");
        if (passwordInput.value != confirmPasswordInput.value) {
            confirmPasswordInput.setCustomValidity("Le due password non combaciano");
        }
        else
            confirmPasswordInput.setCustomValidity("");

        form.classList.add("was-validated");

    });

    var avatar = document.getElementById("avatar");
    var imgAvatar = document.getElementById("img-avatar");

    avatar.addEventListener("change", function (event) {
        if (event.target.files[0]) {
            imgAvatar.setAttribute("src", event.target.files[0].path);
        }
    })
</script>

</html>