<?php
header('Content-Type: application/json; charset=utf-8');
$rates = [];
$jsonRates = file_get_contents('https://www.cbr-xml-daily.ru/daily_json.js');
$rates = json_decode($jsonRates, true);
$currency = [
    'usd' => [
        'rate' => 70,
        'name' => 'долларов США',
    ],
    'eur' => [
        'rate' => 80,
        'name' => 'евро',
    ],
    'gpb' => [
        'rate' => 50,
        'name' => 'фунтов стерлингов',
    ],
    'chf' => [
        'rate' => 40,
        'name' => 'швейцарских франков',
    ],
    'jpy' => [
        'rate' => 30,
        'name' => 'японских иен',
    ],
    'aud' => [
        'rate' => 20,
        'name' => 'австралийских долларов',
    ],
    'rub' => [
        'rate' => 1,
        'name' => 'рублей',
    ]
];
$currency = [];
foreach ($rates["Valute"] as $key => $value) {
    $currency[mb_strtolower($key)] = [
        'rate' => $value["Value"] / $value["Nominal"],
        'name' => $value["Name"],

    ];
}
print_r($currency);
file_put_contents(date("y-m-d"), json_encode($currency, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
print_r(date("y-m-d"));






if (file_exists(date("y-m-d"))) {
    $currency = [];
    $json_data = file_get_contents(date("y-m-d"));
    $currency = json_decode($json_data, true);
    print_r($currency);
} else {
    $rates = [];
    $jsonRates = file_get_contents('https://www.cbr-xml-daily.ru/daily_json.js');
    $rates = json_decode($jsonRates, true);
    $currency = [];
    foreach ($rates["Valute"] as $key => $value) {
        $currency[mb_strtolower($key)] = [
            'rate' => $value["Value"] / $value["Nominal"],
            'name' => $value["Name"],

        ];
        file_put_contents(date("y-m-d"), json_encode($currency, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    }
}








public function loadRusRates()
{
    $jsonRates = file_get_contents('https://www.cbr-xml-daily.ru/daily_json.js');
    $rates = json_decode($jsonRates, true);
    $this->currency = [];
    foreach ($rates["Valute"] as $key => $value) {
        $this->currency[mb_strtolower($key)] = [
            'rate' => $value["Value"] / $value["Nominal"],
            'name' => $value["Name"],
        ];
        file_put_contents(date("y-m-d"), json_encode($this->currency, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    }
}
