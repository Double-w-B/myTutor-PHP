<?php

namespace Classes;

class Validator
{

    public static function string($input, $value)
    {
        $value = trim($value);

        if (!$value) {
            validationFail($input, "Please provide value");
        }
    }
    
    public static function string_len($input, $value, $min = 0, $max = INF)
    {
        $value = trim($value);

        if ($value && !(strlen($value) >= $min && strlen($value) <= $max)) {
            validationFail($input, "Must have from $min to $max characters");
        }
    }

    public static function string_latin($input, $value)
    {
        $value = trim($value);

        if ($value && !ctype_alnum($value)) {
            validationFail($input, "Only latin letters allowed");
        }
    }

    public static function email($input, $value)
    {
        $sanitizedEmail = filter_var($value, FILTER_SANITIZE_EMAIL);

        if ($value && (filter_var($value, FILTER_VALIDATE_EMAIL) == false || $sanitizedEmail !== $value)) {
            validationFail($input, "Check your email value");
        }
    }
}
