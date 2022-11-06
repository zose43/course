<?php

namespace App\contracts;

use Illuminate\Contracts\Routing\Registrar;

interface RouteRegistrar
{
    public function map(Registrar $registrar): void;
}