<?php 

class Output {
    // 
    public static function getSupportedRates(string $code = null) {
        // 
        $rates = [
            // 
            "USD" => ["$" => "U.S. Dollar"],
            "JPY" => ["¥" => "Japanese Yen"],
            "PHP" => ["₱" => "Philippine Peso"],
            "CAD" => ["$" => "Canadian Dollar"],
            "KRW" => ["₩" => "Korean Won"],
            "EUR" => ["€" => "Euro"],
            "GBP" => ["£" => "British Pound"],
            "AUD" => ["$" => "Australian Dollar"]
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
    public static function fetchRate(string $rateCode) : string {
        // 
        $file = "rates.json";
        // 
        $cachedRates = file_get_contents($file);
        $rates = json_decode($cachedRates);
        return round($rates->rates->$rateCode,2);
        // 
    }
    // 
}

?>