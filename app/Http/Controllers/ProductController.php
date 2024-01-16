<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->paginate(5);
        return view('products.index', compact('products'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric',
            'description' => 'required',
            'feature_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gallery_images' => 'sometimes|array',
            'gallery_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'shipping_cost' => 'required|numeric',
            'product_status' => 'required',
        ]);

        $input = $request->all();

        if ($feature_image = $request->file('feature_image')) {
            $destinationPath = 'image/feature/';
            $profileImage = date('YmdHis') . "." . $feature_image->getClientOriginalExtension();
            $feature_image->move($destinationPath, $profileImage);
            $input['feature_image'] = "$profileImage";
        }

        if ($request->hasfile('gallery_images')) {
            foreach ($request->file('gallery_images') as $file) {
                $destinationPath = 'image/gallery/';
                $profileImage = date('YmdHis') . "_" . uniqid() . "." . $file->getClientOriginalExtension();
                $file->move($destinationPath, $profileImage);
                $data[] = "$profileImage";
            }
            $input['gallery_images'] = json_encode($data);
        }

        Product::create($input);

        return redirect()->route('products.index')
            ->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric',
            'description' => 'required',
            'feature_image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gallery_images' => 'sometimes|array',
            'gallery_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'shipping_cost' => 'required|numeric',
            'product_status' => 'required',
        ]);

        $input = $request->all();

        if ($feature_image = $request->file('feature_image')) {
            $destinationPath = 'image/feature/';
            $profileImage = date('YmdHis') . "." . $feature_image->getClientOriginalExtension();
            $feature_image->move($destinationPath, $profileImage);
            $input['feature_image'] = "$profileImage";
        } else {
            unset($input['feature_image']);
        }

        if ($request->hasfile('gallery_images')) {
            $galleryImages = [];
            foreach ($request->file('gallery_images') as $file) {
                $destinationPath = 'image/gallery/';
                $profileImage = date('YmdHis') . "_" . uniqid() . "." . $file->getClientOriginalExtension();
                $file->move($destinationPath, $profileImage);
                $galleryImages[] = "$profileImage";
            }
            $input['gallery_images'] = json_encode($galleryImages);
        } else {
            unset($input['gallery_images']);
        }


        $product->update($input);

        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully');
    }

    public function generatePDF(Product $product)
    {
        $pdf = Pdf::loadView('products.pdf', compact('product'));
        return $pdf->download('product-' . $product->id . '.pdf');
    }
}
