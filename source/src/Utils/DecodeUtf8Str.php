<?php
namespace App\Utils;

// https://gist.github.com/chrisveness/bcb00eb717e6382c5608
class DecodeUtf8Str
{
    public static function decode($utf8String) {
        if (gettype($utf8String) != 'string') 
            throw new \TypeError('parameter ‘utf8String’ is not a string');
        // note: decode 3-byte chars first as decoded 2-byte strings could appear to be 3-byte char!
        $unicodeString = preg_replace_callback(
            '/[\u00e0-\u00ef][\u0080-\u00bf][\u0080-\u00bf]/', // 3-byte chars
            function($c) {  // (note parentheses for precedence)
                $cc = ( 
                    ( ( ord($c{0}) & 0x0f ) << 12) | 
                    ( ( ord($c{1}) & 0x3f ) << 6) | 
                    ( ( ord($c{2}) & 0x3f )));
                return chr($cc); 
            },
            $utf8String
        );
        $unicodeString = preg_replace_callback(
            '/[\u00c0-\u00df][\u0080-\u00bf]/',  // 2-byte chars
            function($c) {  // (note parentheses for precedence)
                $cc = (ord($c{0})&0x1f)<<6 | ord($c{1})&0x3f;
                return chr($cc);
            },
            $unicodeString
        );
        return $unicodeString;
    }
}
