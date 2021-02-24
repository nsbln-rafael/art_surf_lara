<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreBeerRequest;
use App\Http\Resources\BeerResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class BeerController extends Controller
{
    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return $this->manager->all();
    }

    /**
     * @param StoreBeerRequest $request
     *
     * @return BeerResource
     */
    public function store(StoreBeerRequest $request): BeerResource
    {
        return $this->manager->create($request);
    }
}
