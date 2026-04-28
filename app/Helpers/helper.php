<?php

// helper get province

use Illuminate\Support\Facades\DB;

function getProvince()
{
    $provinces = DB::table('id_province')->select('id', 'code', 'name')->get();
    return $provinces;
}

function getCity($id)
{
    $cities = DB::table('id_cities')->select('id', 'code', 'province_code', 'name')->where('province_code', $id)->get();
    return $cities;
}
