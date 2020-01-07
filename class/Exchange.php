<?php 
// 
require("Rates.php");
require("Output.php");
class Exchange {
    // 
    public static function prepare(array $post = null) : array {
        // 
        try {
            // 
            $parameters = ['currency1', 'currency2', 'amount'];
            // 
            $objects = [];
            // 
            foreach ($parameters as $value) {
                // 
                $objects[$value] = $post[$value] ?? $_POST[$value];
                // 
                if ("" === trim($objects[$value]) || null === $objects[$value] || ('amount' == $value && false === is_numeric($objects[$value]))) {
                    // 
                    throw new Exception("Input is invalid! Try again!");
                    exit;
                }
                // 
            }
            return $objects;
            // 
        } catch (Throwable $e) {
            // 
            throw $e;
        }
    }
    // 
    public static function compute(array $post = null) {
        //
        try {
            // 
            $object = self::prepare($post);
            // 
            $amountToUsd = 0; 
            $finalAmount = 0;
            $returnMessage = '';
            $amountToUsd = $object['amount'] / Rates::fetchRate($object['currency1']);
            // 
            $finalAmount = $amountToUsd * Rates::fetchRate($object['currency2']);
            //
            $returnMessage .= key(Output::getSupportedRates($object['currency2'])) . $finalAmount;
            // 
            return $returnMessage;
            // 
        } catch (Exception $e) {
            // 
            throw $e;
        }
    }
    // 
}
// 
?>