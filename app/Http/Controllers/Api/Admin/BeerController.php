<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\StoreBeerRequest;
use App\Http\Requests\UpdateBeerRequest;
use App\Http\Resources\BeerResource;
use Illuminate\Http\JsonResponse;
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

    /**
     * @param UpdateBeerRequest $request
     * @param int               $id
     *
     * @return BeerResource
     */
    public function update(UpdateBeerRequest $request, int $id): BeerResource
    {
        return $this->manager->update($request, $id);
    }

    /**
     * @param int $id
     *
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $this->manager->delete($id);

        return response()->json(null, 204);
    }
}
