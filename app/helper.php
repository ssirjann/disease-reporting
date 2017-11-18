<?php

function getDistrictId($district)
{
    return App\Disease::where('name', $district)->first()->id;
}
