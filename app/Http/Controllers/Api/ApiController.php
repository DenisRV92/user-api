<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApplicationRequest;
use App\Http\Requests\ApplicationResponceRequest;
use App\Http\Resources\ApplicationResource;
use App\Models\Application;
use App\Models\User;
use App\Services\ApplicationServiceInterface;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;


class ApiController extends Controller
{
    private $applicationServie;

    public function __construct(ApplicationServiceInterface $applicationService)
    {
        $this->applicationServie = $applicationService;
    }


    /**
     * @param ApplicationRequest $request
     * @param ApplicationServiceInterface $service
     * @return JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(ApplicationRequest $request): JsonResponse
    {
        $this->authorize('store', User::class);
        try {
            $this->applicationServie->create($request);
            return (new ApplicationResource(['message' => 'Application accepted for processing']))
                ->response()
                ->setStatusCode(200);
        } catch (Exception $e) {
            logger($e);
            return (new ApplicationResource(['error' => 'error in submitting application']))
                ->response()
                ->setStatusCode(401);
        }
    }

    /**
     * @param ApplicationResponceRequest $request
     * @param Application $application
     * @param ApplicationServiceInterface $service
     * @return JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(ApplicationResponceRequest $request, Application $application): JsonResponse
    {
        $this->authorize('update', User::class);

        try {
            $this->applicationServie->update($request, $application);
            return (new ApplicationResource(['message' => 'Application response sent successfully']))
                ->response()
                ->setStatusCode(200);
        } catch (Exception $e) {
            logger($e);
            return (new ApplicationResource(['error' => 'error in receiving application']))
                ->response()
                ->setStatusCode(401);
        }
    }


    /**
     * @return ApplicationResource
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(ApplicationServiceInterface $service): AnonymousResourceCollection
    {
        $this->authorize('index', User::class);
        return ApplicationResource::collection($service->getAllApplications());
    }

    /**
     * @param Request $request
     * @return ApplicationResource
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function filter(Request $request, ApplicationServiceInterface $service): AnonymousResourceCollection
    {
        $this->authorize('index', User::class);
        return ApplicationResource::collection($service->getFilteredApplications($request->route('status')));

    }
}
