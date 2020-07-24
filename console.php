<?php
include "classes/converter.php";

$converter = new Converter();

function help()
{
    echo ("php index.php currencies - для вывода списка доступных валют" . "\n");
    echo ("php index.php валюта1 валюта2 сумма - для перевода одной валюты в другую");
}

if ($argv[1] == "help" or count($argv) == 1) {
    help();
    exit;
}

if ($argv[1] == "currencies") {
    echo implode("\n", $converter->getCurrencies());
    exit;
}

if (!isset($argv[1]) or !isset($argv[2]) or !isset($argv[3])) {
    echo "Пожалуйста, укажите в командной строке 3 параметра: имя текущей валюты, имя валюты для конвертации, сумму";
    exit;
}
if (!$converter->сurExist($argv[1]) or !$converter->сurExist($argv[2])) {
    echo "Неверно введена валюта!";
    exit;
}
$result = $converter->convert($argv[1], $argv[2], $argv[3]);
$currName = $converter->getCurrencyName($argv[2]);
echo ("Результат: " . $result . " " . $currName);
