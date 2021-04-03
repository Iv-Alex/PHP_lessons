<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comments</title>
    <link rel="stylesheet" href="css/style.css">
    <!-- jQuery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

</head>

<body>

    <div class="container col-lg-10 col-xl-8">
        <?= $pageHeader ?? '' ?>
        <div class="row pt-5 pb-5 form-container">
            <div class="col-sm"></div>
            <div class="col-sm-9">
                <div class="row pb-2">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-3 text-center">
                        <img src="images/envelope.svg" alt="Оставьте комментарий" title="Оставьте комментарий" class="envelope">
                    </div>
                    <div class="col-sm-5"></div>
                </div>
                <?= $commentsForm ?? '' ?>
            </div>
            <div class="col-sm"></div>
        </div>
        <div class="row">
            <div class="col-sm"></div>
            <div class="col-sm-9">
                <?= $commentsList ?? '' ?>
            </div>
            <div class="col-sm"></div>
        </div>


        <?= $pageFooter ?? '' ?>

        <!-- Application JS -->
        <script src="js/script.js"></script>

</body>

</html>