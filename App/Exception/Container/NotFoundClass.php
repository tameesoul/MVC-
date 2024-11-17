<?php

namespace App\Exception\Conatienr;

use Exception;
use Psr\Container\NotFoundExceptionInterface;


class NotFoundClass extends Exception implements NotFoundExceptionInterface
{
}