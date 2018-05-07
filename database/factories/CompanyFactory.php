<?php

use App\Company;
use Faker\Generator as Faker;

$factory->define(Company::class, function (Faker $faker) {
  return [
    'name'        =>  $faker->name,
    'contact1'    =>  '8579786322',
    'pan_no'      =>  'COIPK0304M',
    'gstn_no'     =>  'GSTIN0304M',
    'address'     =>  $faker->address,
    'state_code'  =>  '27'  
  ];
});
