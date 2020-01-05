<?php 
// 
require("Output.php");
class Exchange {
    // 
    public static function checkInput(array $post) : array {
        // 
        $objects = [];
        // 
        foreach ($post as $key => $value) {
            // 
            if ("" === trim($value) || null === $value || False === is_numeric($value)) {
                // 
                throw new Exception("Input is invalid! Try again!");
                exit;
            }
            // 
            $objects[$key] = $value;
            // 
        }
        return $objects;
    }
    // 
    public static function prepare(array $post = null) : array {
        // 
        try {
            // 
            $currency1 = isset($post['currency1']) ? Output::fetchRate($post['currency1']) : null;
            $currency2 = isset($post['currency2']) ? Output::fetchRate($post['currency2']) : null;
            $currency2Symbol = isset($post['currency2']) ? Output::getSupportedRates($post['currency2']) : null;
            $amount = isset($post['amount']) ? $post['amount'] : null;
            // 
            $objects = [
                // 
                'currency1' => $currency1,
                'currency2' => $currency2,
                'amount' => $amount
            ];
            // 
            // 
            self::checkInput($objects);
            // 
            $objects['currency2Symbol'] = $currency2Symbol;
            // 
            return $objects;
            // 
        } catch (Throwable $e) {
            // 
            throw new Exception($e->getMessage());
        }
    }
    // 
    public static function compute($array) {
        //
        try {
            // 
            $object = self::prepare($array);
            // 
            $amountToUsd = 0; 
            $finalAmount = 0;
            $returnMessage = '';
            $amountToUsd = $object['amount'] / ($object['currency1']);
            // 
            $finalAmount = $amountToUsd * $object['currency2'];
            //
            $returnMessage .= key($object['currency2Symbol']) . $finalAmount;
            // 
            return $returnMessage;
            // 
        } catch (Exception $e) {
            // 
            throw new Exception($e->getMessage());
        }
    }
    // 
}
?>