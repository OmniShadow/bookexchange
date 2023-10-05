<?php
session_start();
if (isset($_POST["email"]) && isset($_POST["password"])) {

    $params = array("email" => $_POST["email"], "password" => $_POST["password"], );

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_URL, "http://localhost:8080/bookexchange/api.php/user/login");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $params);


    $curlOutput = curl_exec($curl);
    curl_close($curl);
    $output = json_decode($curlOutput, true);

    if (is_array($output["status"])) {
        $_SESSION["loggedin"] = true;
        $user = $output["status"];
        $_SESSION["user"] = $user[0];
    } else
        $_SESSION["loggedin"] = false;

}


$htmlForm = <<<HTML
 <form id="login-form" autocomplete="off" novalidate action="login.php" method="POST">
        <div class="container-sm">
            <div class="form-floating mb-3">
                <input name="email" type="email" class="form-control" id="email" required placeholder="name@example.com">
                <label for="email">Email address</label>
                <div class="invalid-feedback">Inserisci un indirizzo email</div>
            </div>
            <div class="form-floating">
                <input name="password" type="password" class="form-control" id="password" required placeholder="Password">
                
                <label for="password">Password</label>
                <div class="invalid-feedback">Inserisci una password</div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
HTML;
$htmlLoginSuccess = <<<HTML
<div>
    <img id="success" class="mb-4" src="imgs/success.png" alt="" width="144" height="144">
        <h2>
            Login Successfull!
        </h2>
</div>
HTML;
$htmlLoginFailed = <<<HTML
<div>
            <img id="failed" class="mb-4" src="imgs/failed.png" alt="" width="144" height="144">
            <h2>
                Login Failed!
            </h2>
        </div>
HTML;

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
            <h3>LOGIN</h3>
        </div>

        <?php
        if (!isset($_SESSION["loggedin"])) {
            echo ($htmlForm);
        } else if ($_SESSION["loggedin"] == true) {
            echo ($htmlLoginSuccess);
            header("refresh:2; url=home.php");
        } else {
            echo ($htmlLoginFailed);
            session_destroy();
            header("refresh:2; url=login.php");
        }

        ?>


    </div>





</body>
<script>
    var form = document.getElementById("login-form");

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

        form.classList.add("was-validated");

    })
</script>

</html>