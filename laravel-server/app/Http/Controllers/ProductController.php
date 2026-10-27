<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Traits\ApiResponses;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB; 
use App\Http\Resources\V1\ProductResource;


class ProductController extends Controller
{
    // INDEX
    public function index()
    {
        $products = Product::with('category')->paginate(10);

            return response()->json([
            'message' => 'Products retrieved successfully',
            'data' => ProductResource::collection($products),
        ]);
    }

    // public function index()
    // {
    //     $products = Product::all();

    //     $result = [];
    //     $numbers = [];

    //     for ($i = 1; $i <= 5; $i++) {
    //     $numbers[] = $i;
    //     }


    //     foreach ($products as $product) {
    //         $result[] = [
    //             'id' => $product->id,
    //             'name' => $this->formatProductName($product->name),
    //             'slug' => $product->slug,
    //             'category' => $product->category,
    //             'price' => $product->price,
    //             'quantity' => $product->quantity,
    //             'status' => $product->status,
    //         ];
    //     }

    //     return response()->json([
    //         'status' => true,
    //         'message' => 'Products retrieved successfully.',
    //         'numbers' => $numbers,
    //         'data' => $result
    //     ], 200);

    //     $products = Product::with('category')->paginate(10);

    //     return $this->ok('Products retrieved successfully', 
    //     ProductResource::collection($products));
    // }

    // SHOW USING SLUG
    // public function show(string $slug)
    // {
    //     $product = Product::where('slug', $slug)->first();

    //     if (!$product) {
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'Product not found.'
    //         ], 404);
    //     }

    //     return response()->json([
    //         'status' => true,
    //         'message' => 'Product retrieved successfully.',
    //         'data' => [
    //             'id' => $product->id,
    //             'name' => $this->formatProductName($product->name),
    //             'slug' => $product->slug,
    //             'category' => $product->category,
    //             'price' => $product->price,
    //             'quantity' => $product->quantity,
    //             'status' => $product->status,
    //         ]
    //     ], 200);
    // }

    // public function show(Product $product)
    // {
    //     $product->load('category');

    //     return $this->ok('Product retrieved successfully', new ProductResource($product));
    // }

    public function show(Product $product)
    {
        $product->load('category');

        return response()->json([
            'message' => 'Product retrieved successfully',
            'data' => new ProductResource($product),
        ]);
    }


    // USER-DEFINED FUNCTION
    private function formatProductName($name)
    {
        return ucwords(
            strtolower(
                trim($name)
            )
        );
            
        return response()->json([
        'status' => false,
        'message' => 'Product not found.'
        ], 404);

        return response()->json([
            'status' => true,
            'message' => 'Product retrieved successfully.',
            'data' => [
                'id' => $product->id,
                'name' => $this->formaProductName($product->name),
                'slug' => $product->slug,
                'category' => $product->category,
                'price' => $product->price,
                'quantity' => $product->quantity,
                'status' => $product->status,
            ]
        ], 200);
    
    }

    public function queryMethod()
    {
        // =========================================================
    // A. QUERYING TABLES
    // =========================================================

    // Get the name and price columns from the table.
    $nameAndPrice = Product::select('name', 'price')->get();

    // Load products with their category (avoids N+1 queries).
    $productsWithCategory = Product::with('category')->get();

    // Get the product id and name, ordered by price ascending.
    $productsOrderedByPrice = Product::select('id', 'name')
        ->orderBy('price', 'asc')
        ->get();

    // Get the first 5 rows from the products table.
    $firstFiveProducts = Product::limit(5)->get();



    // =========================================================
    // B. FILTERING DATA
    // =========================================================

    // Get products with a price more than or equal to 3.
    $priceGreaterThanOrEqual = Product::where('price', '>=', 3)->get();

    // Get products in the 'Electronics' category.
    $electronics = Product::whereHas('category', function ($q) {
        $q->where('name', 'Electronics');
    })->get();


    // =========================================================
    // C. AGGREGATING DATA
    // =========================================================

    // Get the total price across all products.
    $totalPrice = Product::sum('price');

    // Get the average price per product.
    $averagePrice = round(Product::avg('price'),2);

    // Get the product with the highest price.
    $highestPrice = Product::max('price');

    // Get the product with the lowest price.
    $lowestPrice = Product::min('price');


    // =========================================================
    // D. GROUPING, FILTERING, AND SORTING
    // =========================================================

    // Get the total price of products for each category.
    $totalPricePerCategory = Product::join(
            'categories',
            'products.category_id',
            '=',
            'categories.id'
        )
        ->select(
            'categories.name',
            DB::raw('SUM(products.price) as total_price')
        )
        ->groupBy('categories.name')
        ->get();

    // Get the average price for each category.
    $averagePricePerCategory = Product::join(
            'categories',
            'products.category_id',
            '=',
            'categories.id'
        )
        ->select(
            'categories.name',
            DB::raw('AVG(products.price) as avg_price')
        )
        ->groupBy('categories.name')
        ->get();

    // Get the product with the lowest price per category.
    $lowestPricePerCategory = Product::join(
            'categories',
            'products.category_id',
            '=',
            'categories.id'
        )
        ->select(
            'categories.name',
            DB::raw('MIN(products.price) as min_price')
        )
        ->groupBy('categories.name')
        ->get();

    // Get the average price per category, sorted ascending.
    $averagePriceSorted = Product::join(
            'categories',
            'products.category_id',
            '=',
            'categories.id'
        )
        ->select(
            'categories.name',
            DB::raw('AVG(products.price) as avg_price')
        )
        ->groupBy('categories.name')
        ->orderBy('avg_price', 'asc')
        ->get();

    // Get the average price for 'Electronics' and 'Books' categories.
    $electronicsAndBooks = Product::join(
        'categories',
        'products.category_id',
        '=',
        'categories.id'
    )
    ->whereIn('categories.name', ['Electronics', 'Books'])
    ->select(
        'categories.name',
        DB::raw('AVG(products.price) as avg_price')
    )
    ->groupBy('categories.name')
    ->get();


    $queryResults = [
    'name_and_price' => $nameAndPrice,
    'products_with_category' => $productsWithCategory,
    'products_ordered_by_price' => $productsOrderedByPrice,
    'first_five_products' => $firstFiveProducts,

    'price_greater_than_or_equal' => $priceGreaterThanOrEqual,
    'electronics' => $electronics,

    'total_price' => $totalPrice,
    'average_price' => $averagePrice,
    'highest_price' => $highestPrice,
    'lowest_price' => $lowestPrice,

    'total_price_per_category' => $totalPricePerCategory,
    'average_price_per_category' => $averagePricePerCategory,
    'lowest_price_per_category' => $lowestPricePerCategory,
    'average_price_sorted' => $averagePriceSorted,
    'electronics_and_books' => $electronicsAndBooks,
    ];

        return response()->json([
            'message' => 'Query results retrieved successfully',
            'data' => $queryResults,
        ]);
    }
}

// class ProductController extends Controller
// {
//     /**
//      * Display a listing of the resource.
//      */
//     public function index()
//     {
//         //
//     }

//     /**
//      * Store a newly created resource in storage.
//      */
//     public function store(Request $request)
//     {
//         //
//     }

//     /**
//      * Display the specified resource.
//      */
//     public function show(string $id)
//     {
//         //
//     }

//     /**
//      * Update the specified resource in storage.
//      */
//     public function update(Request $request, string $id)
//     {
//         //
//     }

//     /**
//      * Remove the specified resource from storage.
//      */
//     public function destroy(string $id)
//     {
//         //
//     }
// }

