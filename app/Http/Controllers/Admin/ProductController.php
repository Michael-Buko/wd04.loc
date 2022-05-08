<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = Image::where('imageable_type', Product::class)->get();
        return view('admin.products.index', [
            'products' => Product::paginate(10),
            'images' => $images,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreCategoryRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $iteration = 1;
        $product = Product::create($request->all());
        foreach ($request->all() as $value) {
            if (is_file($value)) {
                $filename = $request->name . $iteration++ . '.' . $value->getClientOriginalExtension();
                Storage::disk('public')->putFileAs('products', $value, $filename);
                Image::create([
                    'path' => Storage::url('products/' . $filename),
                    'imageable_id' => $product->id,
                    'imageable_type' => Product::class]);
            }
        }
        return redirect()->route('admin.product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $images = Image::where('imageable_type', Product::class)
            ->where('imageable_id', $product->id)
            ->get();
        $imagesTemp = array_fill(1, 5, '');
        foreach ($images as $value){
            $index = substr($value->path, strpos($images->first()->path, '.')-1, 1);
            $imagesTemp[$index] = $value;
        }
        $categories = Category::get();
        return view('admin.products.edit', compact('product', 'categories', 'imagesTemp'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateCategoryRequest $request
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $product->fill($request->all())->save();
        foreach ($request->all() as $name => $value) {
            if (is_file($value)) {
                $index = substr($name, 3);
                $filename = $request->name . $index . '.' . $value->getClientOriginalExtension();
                $image = Image::where('path', Storage::url('products/' . $filename))
                    ->firstOrCreate([
                            'path' => Storage::url('products/' . $filename),
                            'imageable_id' => $product->id,
                            'imageable_type' => Product::class]
                    );
                Storage::disk('public')->putFileAs('products', $value, $filename);
            }
        }
        return redirect()->route('admin.product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Image::where('imageable_id', $id)->get()->reject(function ($image) {
            Storage::disk('public')->delete(substr($image->path, 9));
            $image->delete();
        });
        Product::find($id)->delete();
        return redirect()->route('admin.product.index');
    }
}
