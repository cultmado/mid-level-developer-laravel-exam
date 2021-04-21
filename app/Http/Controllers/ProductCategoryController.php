<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductCategoryController extends Controller
{
    private $productCategoryModel;

    public function __construct(ProductCategory $productCategory)
    {
        $this->productCategoryModel = $productCategory;
    }

    public function index() {
        $productCategories = $this->productCategoryModel->all();

        return view('admin.pages.product_category.index')->with([
            'productCategories' => $productCategories
        ]);
    }

    public function show($id) {
        $productCategory = $this->productCategoryModel->findOrFail($id);
        
        return view('admin.pages.product_category.show')->with([
            'productCategory' => $productCategory
        ]);
    }

    public function create() {
        return view('admin.pages.product_category.create');
    }

    public function store(Request $request) {
        $this->validate($request, [
            'title' => 'required'
        ]);

        DB::beginTransaction();
        try {
            $this->productCategoryModel->create([
                'title' => $request->title
            ]);

            DB::commit();
            return redirect()->route('admin.product-categories.index')
                ->with('flash_message', [
                    'title' => 'Product Category Created!',
                    'message' => 'New Product Category has been Added.',
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
        $productCategory = $this->productCategoryModel->findOrFail($id);

        return view('admin.pages.product_category.edit')->with([
            'productCategory' => $productCategory
        ]);
    }

    public function update($id, Request $request) {
        $this->validate($request, [
            'title' => 'required'
        ]);

        $productCategory = $this->productCategoryModel->findOrFail($id);

        DB::beginTransaction();
        try {
            $productCategory->title = $request->title;
            $productCategory->save();

            DB::commit();
            return redirect()->route('admin.product-categories.index')
            ->with('flash_message', [
                'title' => 'Product Category Updated!',
                'message' => 'Product Category has been Updated.',
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
            $productCategory = $this->productCategoryModel->findOrFail($request->id);

            $productCategory->delete();

            DB::commit();
            return response()->json('Product Category has been deleted successfuly!', 200);

        }catch(Exception $ex) {
            DB::rollBack();
            return response()->json('Something went wrong, please try again.', 400);
        }
    }
}
