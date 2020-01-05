<?php 

class Rates {
    // 
    public static function cacheRates() : void {
        // 
        $url = "https://api.exchangerate-api.com/v4/latest/USD";
        // 
        try {
            // 
            if (False === file_get_contents($url)) {
                // 
                return;
            }
            // 
            $requestJson = file_get_contents($url);
            // 
            if (False === file_put_contents("rates.json", $requestJson)) {
                // 
                throw new Exception("Failed to cache rates!");
            }
            // 
        } catch (Throwable $e) {
            // 
            throw new Exception($e->getMessage());
        }
        // 
    }
    // 
    public static function isValid() {
        // 
        $file = "rates.json";
        // 
        if (filemtime($file) + (24 * 60 * 60) < time()) {
            // 
            return False;
            // 
        } else {
            // 
            return True;
        }
        // 
    }
}

?>