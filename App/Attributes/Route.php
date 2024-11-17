<?php

namespace App\Attributes;

use Attribute;



#[Attribute]
class Route
{

    public function __construct(public  $path, public $method){}   
}