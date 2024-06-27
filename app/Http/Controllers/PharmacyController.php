<?php

namespace App\Http\Controllers;

use App\Models\Pharmacy;
use Illuminate\Http\Request;
use DataTables;

class PharmacyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.pharmacies.index');
    }
    public function datatable(Request $request){
        if ($request->ajax()) {
            $data = Pharmacy::select('id', 'name', 'address');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('name',function($row){
                  return  '<a href="'.route("pharmacy.detail",["id"=>$row->id]).'" class="btn btn-link">'.$row->name.'</a>';
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="' . route("pharmacy.edit", ["id" => $row->id]) . '" class="edit btn btn-success btn-sm">Edit</a>';
                    $btn .= ' <a href="'.route("pharmacy.delete", ["id" => $row->id]).'" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action','name'])
                ->make(true);
        }
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.Pharmacies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Pharmacy::create([
            'name'=>$request->name,
            'address'=>$request->address
        ]);
        return redirect()->route('pharmacies.index')->with('success', 'Pharmacy Stored Successfully');
        
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pharmacy = Pharmacy::where('id',$id)->with('products')->first();
   
        return view('backend.Pharmacies.detailes',compact('pharmacy'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pharmacy = Pharmacy::findorfail($id);
        return view('backend.Pharmacies.edit',compact('pharmacy'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $pharmacy=Pharmacy::findorfail($id);
        $pharmacy->update([
            'name'=>$request->name,
            'address'=>$request->address,
        ]);
        return redirect()->route('pharmacies.index')->with('success', 'Pharmacy Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Pharmacy::findorfail($id)->delete();
        return redirect()->route('pharmacies.index')->with('success', 'Pharmacy Deleted Successfully');
    }
}