<?php

namespace App\Repositories;


use App\Models\Application;
use Illuminate\Database\Eloquent\Collection;


interface ApplicationRepositoryInterface
{
    public function create(array $data): Application;

    public function update(Application $application, array $data): bool;

    public function getAll(): Collection;

    public function getFiltered(string $string): Collection;

}
