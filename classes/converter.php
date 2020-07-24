<?php

class Converter
{
    private $currency = [
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

    public function convert($from, $to, $sum, $format = false)
    {
        $result = round(($this->currency[$from]['rate'] * $sum / $this->currency[$to]['rate']), 2);
        if ($format) {
            return number_format($result, 2, ',', ' ');
        }
        return $result;
    }

    public function сurExist($abbr)
    {
        return isset($this->currency[$abbr]);
    }

    public function getCurrencies()
    {
        $result = [];
        foreach ($this->currency as $key => $val) {
            $result[] = $key;
        };
        return $result;
    }

    public function getCurrencyName($abbr)
    {
        return $this->currency[$abbr]['name'];
    }

    public function loadRusRates()
    {
        $filePath = "./rates/" . date("Y-m-d") . ".json";
        if (file_exists($filePath)) {
            $this->currency = [];
            $json_data = file_get_contents($filePath);
            $this->currency = json_decode($json_data, true);
        } else {
            $rates = [];
            $jsonRates = file_get_contents('https://www.cbr-xml-daily.ru/daily_json.js');
            $rates = json_decode($jsonRates, true);
            $this->currency = [];
            foreach ($rates["Valute"] as $key => $value) {
                $this->currency[mb_strtolower($key)] = [
                    'rate' => $value["Value"] / $value["Nominal"],
                    'name' => $value["Name"],
                ];
            }
            $this->currency['rub'] = [
                'rate' => 1,
                'name' => 'Российский рубль',
            ];            
            file_put_contents($filePath, json_encode($this->currency, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
        }
    }

    public function loadEuropeRates()
    {
        $jsonRates = file_get_contents('https://api.exchangeratesapi.io/latest');
        $rates = json_decode($jsonRates, true);
        return $rates;
    }
}
