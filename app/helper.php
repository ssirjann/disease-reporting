<?php

function getDistrictId($district)
{
    return Disease::where('name', $district)->first()->id;
}
