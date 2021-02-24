<?php

namespace App\Services;

use App\Http\Requests\StoreBeerRequest;
use App\Http\Requests\UpdateBeerRequest;
use App\Http\Resources\BeerResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

interface BeerManagerInterface
{
    /**
     * @return AnonymousResourceCollection
     */
    public function all(): AnonymousResourceCollection;

    /**
     * @param int $id
     *
     * @return BeerResource
     */
    public function show(int $id): BeerResource;

    /**
     * @param StoreBeerRequest $request
     *
     * @return BeerResource
     */
    public function create(StoreBeerRequest $request): BeerResource;

    /**
     * @param UpdateBeerRequest $request
     * @param int               $id
     *
     * @return BeerResource
     */
    public function update(UpdateBeerRequest $request, int $id): BeerResource;

    /**
     * @param int $id
     *
     * @return void
     */
    public function delete(int $id): void;
}
