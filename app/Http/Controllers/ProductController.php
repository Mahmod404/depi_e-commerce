<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function getProducts(Request $request)
    {
        $query = Product::query();
        $user = Auth::user();
        // Search functionality
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->input('search') . '%')
                ->orWhere('description', 'like', '%' . $request->input('search') . '%');
        }

        // Sorting functionality
        if ($request->has('sort')) {
            $sort = $request->input('sort');
            $direction = $request->input('direction', 'asc');
            $query->orderBy($sort, $direction);
        }

        // Pagination
        $products = $query->paginate(12)->appends($request->all());

        return view('pages.products', compact('products', 'user'));
    }

    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('pages.product.create', compact('categories', 'brands'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|exists:categories,id',
            'brand' => 'required|exists:brands,id',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048|dimensions:min_width=100,min_height=100,max_width=4000,max_height=4000',
        ]);

        // Handle the image upload and processing
        $imagePath = $this->handleImageUpload($request->file('image'));

        // Create a new product
        Product::create([
            'name' => $request->name,
            'category_id' => $request->category,
            'brand_id' => $request->brand,
            'description' => $request->description,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'image' => $imagePath,
        ]);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }
    private function handleImageUpload($image)
    {
        // Generate a unique file name
        $fileName = time() . $image->getClientOriginalName();

        // Store the image in the 'public/products' directory
        // $image->storeAs('public/imgs/products', $fileName);
        $image->move(public_path('productImgs'), $fileName);


        return 'productImgs/' . $fileName;
    }

    public function show($id)
    {
        $product = product::findOrFail($id);
        return view('pages.product.show', compact('product'));
    }

    public function edit($id)
    {
        $product = product::findOrFail($id);
        $categories = Category::all();
        $brands = Brand::all();
        return view('pages.product.edit', compact('product', 'categories', 'brands'));
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $product = Product::findOrFail($id);

        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|exists:categories,id',
            'brand' => 'required|exists:brands,id',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048|dimensions:min_width=100,min_height=100,max_width=4000,max_height=4000',
        ]);
        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($product->image) {
                Storage::delete('public/' . $product->image);
            }

            // Upload the new image
            $imagePath = $this->handleImageUpload($request->file('image'));
        }

        // Update the product
        $product->update([
            'name' => $request->name,
            'category_id' => $request->category,
            'brand_id' => $request->brand,
            'description' => $request->description,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'image' => $imagePath,
        ]);
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy($id)
    {
        $product = product::findOrFail($id);
        // Delete the product image from storage
        if ($product->image) {
            Storage::delete('public/' . $product->image);
        }

        // Delete the product
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
    public function __construct()
    {
        $products = product::get();
        foreach ($products as $product) {
            if ($product->quantity == 0) {
                $product->availability = 'false';
                $product->update();
            } else {
                $product->availability = 'true';
                $product->update();
            }
        }
    }
    public function index()
    {
    }
}