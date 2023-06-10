<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendor;
class VendorController extends Controller
{
    //
    /**
     * Display a listing of the vendors.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendors = Vendor::all();

        return response()->json($vendors);
    }

    /**
     * Store a newly created vendor in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:vendors|max:255',
            'address' => 'nullable',
            // Add more validation rules as per your requirements
        ]);

        $vendor = Vendor::create([
            'name' => $request->name,
            'address' => $request->address,
            // Assign other vendor attributes here
        ]);

        return response()->json($vendor, 201);
    }

    /**
     * Display the specified vendor.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vendor = Vendor::findOrFail($id);

        return response()->json($vendor);
    }

    /**
     * Update the specified vendor in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $vendor = Vendor::findOrFail($id);

        $request->validate([
            'name' => 'required|unique:vendors,name,' . $vendor->id . '|max:255',
            'address' => 'nullable',
            // Add more validation rules as per your requirements
        ]);

        $vendor->name = $request->name;
        $vendor->address = $request->address;
        // Update other vendor attributes here
        $vendor->save();

        return response()->json($vendor);
    }

    /**
     * Remove the specified vendor from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vendor = Vendor::findOrFail($id);
        $vendor->delete();

        return response()->json(['message' => 'Vendor deleted successfully']);
    }
}
