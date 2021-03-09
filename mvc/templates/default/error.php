<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasks</title>
    <!-- Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</head>

<body>
    <div class="d-flex container justify-content-center align-items-center">
        <main class="p-3 col-sm-6">
            <div class="card text-white bg-danger">
                <div class="card-header">Error</div>
                <div class="card-body">
                    <h5 class="card-title"><?= $errorCode ?></h5>
                    <p class="card-text"><?= $errorMessage ?></p>
                </div>
                <div class="card-footer">
                    <a class="text-light" href="/">Go to home page</a>
                </div>
            </div>
        </main>
    </div>
</body>

</html>