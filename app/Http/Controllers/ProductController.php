<?php

namespace App\Http\Controllers;

use App\Models\CategoryPerProduct;
use App\Models\Product;
use App\Models\ProductCategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    private $productModel;
    private $productCategoryModel;
    private $categoryPerProductModel;

    public function __construct(
        Product $product,
        ProductCategory $productCategory,
        CategoryPerProduct $categoryPerProduct
    )
    {
        $this->productCategoryModel = $productCategory;
        $this->productModel = $product;
        $this->categoryPerProductModel = $categoryPerProduct;
    }

    public function index() {
        $products = $this->productModel->all();
        
        return view('admin.pages.product.index')->with([
            'products' => $products
        ]);
    }

    public function show($id) {
        $product = $this->productModel->findOrFail($id);

        return view('admin.pages.product.show')->with([
            'product' => $product
        ]);
    }

    public function create() {
        $categories = $this->productCategoryModel->all();

        return view('admin.pages.product.create')->with([
            'categories' => $categories
        ]);
    }

    public function store(Request $request) {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'product_category' => 'required'
        ]);

        DB::beginTransaction();
        try {
            $createdProduct = $this->productModel->create([
                'title' => $request->title,
                'content' => $request->content,
                'image' => ''
            ]);

            $this->categoryPerProductModel->create([
                'product_id' => $createdProduct->id,
                'productcategory_id' => $request->product_category
            ]);

            if ($request->hasFile('product_image')) {
                $imgFile = $request->file('product_image');

                $fileName   = $createdProduct->id . '.' . $imgFile->getClientOriginalExtension();

                $productImgPath = 'product_images';

                $storedImg = Storage::putFileAs($productImgPath, $imgFile, $fileName);

                $product = $this->productModel->find($createdProduct->id);
                $product->image = $storedImg;
                $product->save();
            }

            // Storage::put($request->image, 'public');
            DB::commit();

            return redirect()->route('admin.product.index')
                ->with('flash_message', [
                    'title' => 'Product Created!',
                    'message' => 'New Product has been Added.',
                    'type' => 'success'
                ]);
        }catch(Exception $ex) {
            DB::rollBack();
            return redirect()->back()
                ->with('flash_message', [
                    'title' => 'Error',
                    'message' => 'Something went wrong, please try again.',
                    'type' => 'error'
                ]);
        }
    }

    public function edit($id) {
        $product = $this->productModel->findOrFail($id);

        $categories = $this->productCategoryModel->all();

        return view('admin.pages.product.edit')->with([
            'product' => $product,
            'categories' => $categories
        ]);
    }

    public function update($id, Request $request) {
        $product = $this->productModel->findOrFail($id);

        // dd($request->all());

        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'product_category' => 'required'
        ]);

        DB::beginTransaction();
        try {
            $product->title = $request->title;
            $product->content = $request->content;
            $product->save();

            $categoryPerProduct = $this->categoryPerProductModel->where('product_id', $product->id)->first();
            if($categoryPerProduct) {
                $categoryPerProduct->productcategory_id = $request->product_category;
                $categoryPerProduct->save();
            }

            if ($request->hasFile('product_image')) {
                $imgFile = $request->file('product_image');

                $fileName   = $product->id . '.' . $imgFile->getClientOriginalExtension();

                $productImgPath = 'product_images';

                $storedImg = Storage::putFileAs($productImgPath, $imgFile, $fileName);

                $product = $this->productModel->find($product->id);

                Storage::delete($product->image);
                
                $product->image = $storedImg;
                $product->save();
            }

            DB::commit();

            return redirect()->route('admin.product.index')
            ->with('flash_message', [
                'title' => 'Product Updated!',
                'message' => 'Product has been Updated.',
                'type' => 'success'
            ]);

        }catch(Exception $ex) {
            DB::rollBack();
            return redirect()->back()
                ->with('flash_message', [
                    'title' => 'Error',
                    'message' => 'Something went wrong, please try again.',
                    'type' => 'error'
                ]);
        }
    }

    public function delete(Request $request) {
        DB::beginTransaction();
        try {
            $product = $this->productModel->findOrFail($request->product_id);

            $categoryPerProduct = $this->categoryPerProductModel->where('product_id', $product->id)->first();
            
            if($categoryPerProduct) {
                $categoryPerProduct->delete();
            }

            $product->delete();

            DB::commit();
            return response()->json('Product has been deleted successfuly!', 200);

        }catch(Exception $ex) {
            DB::rollBack();
            return response()->json('Something went wrong, please try again.', 400);
        }
    }
}
