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

<body class="text-center">

    <nav class="navbar navbar-expand-sm p-3 bg-primary-subtle text-center">
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
        </div>
    </nav>

    <div class="p-5">
        <div class="align-items-center text-center">
            <img class="mb-4" src="imgs/icon.png" alt="" width="72" height="72">
            <h3>Registrazione utente</h3>
        </div>

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