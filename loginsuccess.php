<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login success</title>
    <link rel="icon" href="icon.png" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>

<body>
    <nav class="navbar navbar-expand-sm p-3 bg-primary-subtle text-center">
        <div class="container-fluid">
            <a class="navbar-brand" href="home.php">
                <div class="container">
                    <div class="row">
                        <div class="col-sm">
                            <img class="img-thumbnail" src="icon.png" alt="" width="50" height="50">
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
        <img id="success" class="mb-4" src="success.png" alt="" width="144" height="144">
        <h2>
            Login Successfull!
        </h2>
    </div>
    <?php
    header("refresh:1; url=home.php");
    ?>
</body>

</html>