<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\Repositories\ProductRepository;

class ProductController extends Controller
{

    public $product;


    public function __construct(ProductRepository $productRepository)
    {
        $this->product = $productRepository;
    }

    /**
     * Shows the product form page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('coalition.product-form');
    }


    /**
     * Handles storing the data.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $data = $request->get('data');
        $this->product->saveToFile('storage/app/public/coalition.json', $data);

        $fileData = $this->product->readFromFile('storage/app/public/coalition.json');

        return response()->json([
            'success' => true,
            'data' => $fileData
        ], 200);
    }
}
