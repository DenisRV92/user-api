<?php

namespace App\Services;

use App\Enums\ApplicationStatus;
use App\Events\ApplicationResolved;
use App\Models\Application;
use App\Models\User;
use App\Repositories\ApplicationRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class ApplicationService implements ApplicationServiceInterface
{
    protected $applicationRepository;

    public function __construct(ApplicationRepository $applicationRepository)
    {
        $this->applicationRepository = $applicationRepository;
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function create(Request $request): bool
    {
        try {
            $user = auth()->user();
            $application = $this->applicationRepository->create([
                'name' => $user->name,
                'email' => $user->email,
                'status' => ApplicationStatus::Active->name,
                'message' => $request->message,
                'user_id' => $user->id
            ]);
            return $application->save();
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * @param Request $request
     * @param Application $application
     * @return bool
     */
    public function update(Request $request, Application $application): bool
    {
        try {
            $application->fill($request->toArray());
            $application->status = ApplicationStatus::Resolved->name;
            if ($this->applicationRepository->update($application, $application->toArray())) {
                $user = User::find($application->user_id);
                event(new ApplicationResolved($user));
                return true;
            }
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function getAllApplications(): Collection
    {
        return $this->applicationRepository->getAll();
    }

    public function getFilteredApplications($status): Collection
    {
        return $this->applicationRepository->getFiltered($status);
    }

}
