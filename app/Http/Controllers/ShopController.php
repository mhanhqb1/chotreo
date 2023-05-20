<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Http\Requests\StoreShopRequest;
use App\Http\Requests\UpdateShopRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = new Shop();
        if ($request->search) {
            $data = $data->where('name', 'LIKE', "%{$request->search}%");
        }
        $data = $data->latest()->paginate(10);
        // if (request()->wantsJson()) {
        //     return ProductResource::collection($data);
        // }
        return view('shops.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('shops.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreShopRequest $request)
    {
        $image_path = '';

        if ($request->hasFile('logo')) {
            $image_path = $request->file('logo')->store('shops', 'public');
            // print_r($image_path); die();
        }

        $item = Shop::create([
            'name' => $request->name,
            'description' => $request->description,
            'logo' => $image_path,
            'address' => $request->address,
            'phone' => $request->phone,
            'status' => $request->status
        ]);

        if (!$item) {
            return redirect()->back()->with('error', __('Sorry, there a problem while creating shop.'));
        }
        return redirect()->route('shops.index')->with('success', __('Success, your shop has been created.'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Shop $shop)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shop $shop)
    {
        return view('shops.edit')->with('item', $shop);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateShopRequest $request, Shop $shop)
    {
        $shop->name = $request->name;
        $shop->description = $request->description;
        $shop->address = $request->address;
        $shop->phone = $request->phone;
        $shop->status = $request->status;

        if ($request->hasFile('logo')) {
            // Delete old image
            if ($shop->logo) {
                Storage::delete($shop->logo);
            }
            // Store image
            $image_path = $request->file('logo')->store('shops', 'public');
            // Save to Database
            $shop->logo = $image_path;
        }

        if (!$shop->save()) {
            return redirect()->back()->with('error', __('Sorry, there\'re a problem while updating shop.'));
        }
        return redirect()->route('shops.index')->with('success', __('Success, your shop have been updated.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shop $shop)
    {
        if ($shop->logo) {
            Storage::delete($shop->logo);
        }
        $shop->delete();

        return response()->json([
            'success' => true
        ]);
    }
}
