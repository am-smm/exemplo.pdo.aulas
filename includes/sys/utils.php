<?php

function limpaEspacosDuplicados(string $str){return trim(preg_replace('/\s+/', ' ', $str));}
function removeEspacos(string $str){return preg_replace('/\s*/', '', $str);}



function hasInputKey($key) { return isset($_REQUEST[$key]); }

function getInput($key, $default = false) {
    return isset($_REQUEST[$key])
        ? trim(filter_var($_REQUEST[$key], FILTER_SANITIZE_STRING))
        : $default;
}


function array_get($key, $array, $default = false) {

    if ( !is_string($key) || !is_array($array)) return false;

    return ($array[$key] ?? $default);
}

function trygetDatetimeFromStr($str, &$datetime, $format = 'Y-m-d H:i:s'): bool {
    $timeZone = new DateTimeZone('Europe/Lisbon');
    $datetime = DateTime::createFromFormat($format, $str, $timeZone);
    if ($datetime === false) {
        $datetime = new DateTime('now', $timeZone); // agora
        return false;
    }

    return true;
}

function agora(): DateTime {
    $timeZone = new DateTimeZone('Europe/Lisbon');
    return new DateTime('now', $timeZone);
}