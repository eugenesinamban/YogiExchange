<?php 

class Output {
    // 
    public static function getSupportedRates(string $code = null) {
        // 
        $rates = [
            // 
            "USD" => ['$' => 'U.S. Dollar'],
            "JPY" => ['¥' => 'Japanese Yen'],
            "PHP" => ['₱' => 'Philippine Peso'],
            "CAD" => ['$' => 'Canadian Dollars'],
            "KRW" => ['₩' => 'Korean Won'],
            "EUR" => ['€' => 'Euro'],
            "GBP" => ["£" => 'British Pounds'],
            "AUD" => ['$' => 'Australian Dollars']
            // 
        ];
        // 
        if (null === $code) {
            // 
            return $rates;
        } else {
            // 
            return $rates[$code];
        }
    }
    //  
}

?>