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
        <div class="container-sm w-50">
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
            <div class="form-floating">
            <a href="/bookexchange/register.php">
            Non hai ancora un account? Registrati qui!
        </a>
            </div>
        </div>
        
       

        <button type="submit" class="btn btn-dark mt-2">Accedi</button>
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

    <div class="p-5">
        <div class="align-items-center text-center">
            <img class="mb-4" src="imgs/icon.png" alt="" width="72" height="72">
            <h3>LOGIN</h3>
        </div>
        <hr>

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