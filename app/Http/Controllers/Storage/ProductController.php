<?php

namespace App\Http\Controllers\Storage;

use App\Http\Requests\Storage\ProductRequest;
use App\Notifications\Storage\CreateProductNotification;
use App\Product;
use App\Http\Controllers\Controller;
use App\Product_img;
use Illuminate\Support\Facades\Notification;

class ProductController extends Controller
{

    public function index(Product $product)
    {

        return view('storage.product.index',['products' => $product->liste()]);

    }


    public function create()
    {

        return view('storage.product.create');

    }


    public function store(ProductRequest $request, Product $product)
    {

        $product = $product->onStore($request);

        Notification::send(auth()->user()->colleagues(), new CreateProductNotification($product));

        session()->flash('status',__('storage/product.stored'));

        return redirect()->route('product.show',compact('product'));

    }


    public function show(Product $product)
    {

        $this->authorize('view', $product);

        return view('storage.product.show',compact('product'));

    }


    public function edit(Product $product)
    {

        $this->authorize('update', $product);

        return view('storage.product.edit',compact('product'));

    }


    public function update(ProductRequest $request, Product $product)
    {

        $this->authorize('update', $product);

        $product->onUpdate($request);

        Notification::send(auth()->user()->colleagues(), new CreateProductNotification($product));

        session()->flash('status',__('storage/product.updated'));

        return redirect()->route('product.show',compact('product'));

    }


    public function destroy(Product $product)
    {

        $this->authorize('update', $product);

        $product->onDelete();

        session()->flash('status',__('storage/product.deleted'));

        return redirect()->route('product.index');

    }

    public function destroyImg(Product $product, Product_img $product_img)
    {

        $this->authorize('update', $product);

        $product_img->onDelete();

        session()->flash('status',__('storage/product.imgDeleted'));

        return redirect()->route('product.show',compact('product'));

    }
}
