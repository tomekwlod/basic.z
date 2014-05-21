<?php

/**
 * Conversion
 */
class Base_Convert {

    /**
     * Convert string (base64 encoded) to hex
     *
     * @param string $string
     * @return string
     */
    public static function strToHex($string) {
        $hex = '';
        $string = base64_encode($string);
        for ($i=0; $i < strlen($string); $i++) {
            $hex .= dechex(ord($string[$i]));
        }
        return $hex;
    }

    /**
     * Convert hex (base64 encoded) to string
     *
     * @param string $string
     * @return string
     */
    public static function hexToStr($hex) {
        $string = '';
        for ($i=0; $i < strlen($hex)-1; $i+=2) {
            $string .= chr(hexdec($hex[$i].$hex[$i+1]));
        }
        return base64_decode($string);
    }
}