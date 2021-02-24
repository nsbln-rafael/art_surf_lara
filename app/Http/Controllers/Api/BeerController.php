<?php

namespace App\Http\Controllers\Api;

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
     * @param int $id
     *
     * @return BeerResource
     */
    public function show(int $id): BeerResource
    {
        return $this->manager->show($id);
    }
}
