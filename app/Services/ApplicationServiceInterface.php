<?php

namespace App\Services;

use App\Models\Application;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

interface ApplicationServiceInterface
{
    public function create(Request $request): bool;

    public function update(Request $request, Application $application): bool;

    public function getAllApplications(): Collection;

    public function getFilteredApplications(string $status): Collection;
}
