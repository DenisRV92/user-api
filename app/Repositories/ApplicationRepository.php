<?php

namespace App\Repositories;

use App\Models\Application;
use Illuminate\Database\Eloquent\Collection;

class ApplicationRepository implements ApplicationRepositoryInterface
{
    public function create(array $data): Application
    {
        return Application::create($data);
    }

    public function update(Application $application, array $data): bool
    {
        return $application->update($data);
    }

    public function getAll(): Collection
    {
        return Application::all();
    }

    public function getFiltered(string $status):Collection
    {
        return Application::where(['status' => $status])->get();
    }
}
