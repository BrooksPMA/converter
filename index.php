<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Конвертер валют</title>
</head>

<body>
    <?php
    include "classes/converter.php";
    include "functions/help.php";

    $converter = new Converter();
    $converter->loadRusRates();
    $res = $converter->getCurrencies();
    $protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http"); // определяем протокол, http или https
    $url = $protocol . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; // получаем полный URL
    $path = parse_url($url, PHP_URL_PATH); // получаем только путь без всего остального 

    if ($path == "/currencies") {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($converter->getCurrencies(), JSON_PRETTY_PRINT);
        exit;
    }

    if ($path == "/help") {
        if (count($_GET) == 0) {
            header('Content-Type: application/json; charset=utf-8');
            json_encode(help(), JSON_UNESCAPED_UNICODE);
            exit;
        }
    }
    if ($path == "/") {
        if (!isset($_GET['from']) or !isset($_GET['to'])) {
            $warningMessage = "Введите валюты и сумму";
        } elseif ($_GET['sum'] == null){
            $badMessage = "Сумма введена неверно";
        }
         elseif (!$converter->сurExist(mb_strtolower($_GET['from'])) or !$converter->сurExist(mb_strtolower($_GET['to']))) {

            $badMessage = "Неверно введена валюта!";
        } else {
            $result = $converter->convert(mb_strtolower($_GET['from']), mb_strtolower($_GET['to']), floatval(str_replace(",", ".", ($_GET['sum']))), true);
            $currName = $converter->getCurrencyName(mb_strtolower($_GET['to']));
            $succesMessage = ("Результат: " . $result . " " . $currName . " ");
        }
    }
    include "pages/main.php";
    ?>

</body>

</html>