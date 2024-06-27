<?php

namespace App\Http\Controllers;

use App\Models\{Product, Pharmacy};
use Illuminate\Http\Request;

use DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.Products.index');
    }
    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $data = Product::select('id', 'title', 'description', 'image');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('title',function($row){
                    return  '<a href="'.route("product.details",["id"=>$row->id]).'" class="btn btn-link">'.$row->title.'</a>';
                  })
                ->addColumn('image', function ($row) {
                    $img = '<img src="' . asset('images/' . $row->image) . '" alt="Image" style="width: 100px; height: auto;">';
                    return $img;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route("product.edit", ["id" => $row->id]) . '" class="edit btn btn-success btn-sm">Edit</a>';
                    $btn .= ' <a href="' . route("product.delete", ["id" => $row->id]) . '" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['image','title', 'action'])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.Products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();

            $request->image->move(public_path('images'), $imageName);
        } else {
            $imageName = 't';
        }
        $product=Product::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imageName,
        ]);

        $data = [
            $request->pharmacy => [
                'quantity' => $request->quantity,
                'price' => $request->price,
            ],
        ];

        $product->pharmacies()->sync($data);
        return redirect()->route('products.index')->with('success', 'Product Stored Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Product::where('id',$id)->with('pharmacies')->first();
     return view('backend.Products.detailes',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::findorfail($id);
        return view('backend.Products.edit', compact('product'));
    }
    public function pharmacy(Request $request)
    {
        $search = $request->get('q');

        $items = Pharmacy::select('id', 'name')
            ->where('name', 'LIKE', "%{$search}%")
            ->get();

        return response()->json($items);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $product = Product::findorfail($request->id);
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $old_image = $product->image;
            if ($old_image) {
                unlink(public_path('images/' . $old_image));
            }
            $request->image->move(public_path('images'), $imageName);
        } else {
            $imageName = $product->image;
        }
        $product->update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imageName,
        ]);

        $data = [
            $request->pharmacy => [
                'quantity' => $request->quantity,
                'price' => $request->price,
            ],
        ];

        $product->pharmacies()->sync($data);
        return redirect()->route('products.index')->with('success', 'Product Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Product::findorfail($id)->delete();
        return redirect()->route('products.index')->with('success', 'Product Deleted Successfully');
    }
}
