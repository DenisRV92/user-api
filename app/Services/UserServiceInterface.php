<?php

namespace App\Services;

use Illuminate\Http\Request;

interface UserServiceInterface
{
    public function register(Request $request): string;
}
