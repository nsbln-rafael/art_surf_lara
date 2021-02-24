<?php

/** @noinspection PhpUndefinedMethodInspection */

namespace App\Services;

use App\Http\Requests\StoreBeerRequest;
use App\Http\Requests\UpdateBeerRequest;
use App\Http\Resources\BeerResource;
use App\Models\Beer;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\File;

class BeerManager implements BeerManagerInterface
{
    /**
     * @return AnonymousResourceCollection
     */
    public function all(): AnonymousResourceCollection
    {
        return BeerResource::collection(Beer::paginate());
    }

    /**
     * @param int $id
     *
     * @return BeerResource
     */
    public function show(int $id): BeerResource
    {
        $beer = Beer::findOrFail($id);

        return new BeerResource($beer);
    }

    /**
     * @param StoreBeerRequest $request
     *
     * @return BeerResource
     */
    public function create(StoreBeerRequest $request): BeerResource
    {
        $fileName = $this->uploadImage($request);

        $beer = Beer::create([
            'title'       => $request->get('title'),
            'description' => $request->get('description'),
            'photo'       => $fileName
        ]);

        return new BeerResource($beer);
    }

    /**
     * @param UpdateBeerRequest $request
     * @param int               $id
     *
     * @return BeerResource
     */
    public function update(UpdateBeerRequest $request, int $id): BeerResource
    {
        $beer = Beer::findOrFail($id);

        $beer->fill($request->only(['title', 'description']));

        if ($request->hasFile('photo')) {
            $this->deleteImage($beer->photo);

            $fileName    = $this->uploadImage($request);
            $beer->photo = $fileName;
        }

        $beer->save();

        return new BeerResource($beer);
    }

    /**
     * @param int $id
     *
     * @return void
     */
    public function delete(int $id): void
    {
        $beer = Beer::findOrFail($id);
        $this->deleteImage($beer->photo);

        $beer->delete();
    }

    /**
     * @param StoreBeerRequest|UpdateBeerRequest $request
     *
     * @return string
     */
    private function uploadImage($request): string
    {
        $file     = $request->file('photo');
        $path     = public_path() . '/images/';
        $fileName = time() . '.' . $file->extension();

        $file->move($path, $fileName);

        return $fileName;
    }

    /**
     * @param string $fileName
     *
     * @return void
     */
    private function deleteImage(string $fileName): void
    {
        $path = public_path() . '/images/' . $fileName;

        if (File::exists($path)) {
            File::delete($path);
        };
    }
}
