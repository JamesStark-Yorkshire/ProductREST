<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductListResource;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\Product\StoreRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $products = Product::query()
            ->locale($request->input('locale'))
            ->paginate(20);

        return ProductResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request)
    {
        $data = $request->all();

        $product = Product::query()->create($data);

        return response()->json($product, JsonResponse::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param int $productId
     * @return ProductResource
     */
    public function show(Request $request, int $productId)
    {
        $product = Product::query()
            ->locale($request->input('locale'))
            ->findOrFail($productId);

        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $productId
     * @return JsonResponse
     */
    public function update(Request $request, int $productId)
    {
        $product = Product::query()->findOrFail($productId);

        $product->update($request->all());

        return response()->json($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $productId
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(int $productId): JsonResponse
    {
        $product = Product::query()->findOrFail($productId);

        $product->delete();

        return response()->json($product);
    }
}
