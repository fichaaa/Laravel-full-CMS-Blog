<?php

namespace App\Helpers;

class Helper{
    public static function plural( $amount, $singular = '', $plural = 's' ) {
        if ( $amount === 1 ) {
            return $singular;
        }
        return $plural;
    }
}

