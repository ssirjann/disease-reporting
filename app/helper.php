<?php

function getDiseaseId($disease)
{
    return App\Disease::where('name', $disease)->first()->id;
}

function getDistance($lat1, $lon1, $lat2, $lon2) {
    $p = 0.017453292519943295;    // Math.PI / 180
    $a = 0.5 - cos(($lat2 - $lat1) * $p)/2 +
        cos($lat1 * $p) * cos($lat2 * $p) *
        (1 - cos(($lon2 - $lon1) * $p))/2;

    return 12742 * asin(sqrt($a)); // 2 * R; R = 6371 km
}
