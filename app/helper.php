<?php

function getDiseaseId($disease)
{
    return App\Disease::where('name', $disease)->first()->id;
}
