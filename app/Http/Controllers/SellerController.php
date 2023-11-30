<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SellerController extends Controller
{
    public function add_property_view()
    {
        return view('seller.add-property');
    }

    public function add_property(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'details' => 'required|string',
            'price' => 'required|numeric',
            'property_img' => 'required|mimes:png,jpg,jpeg|max:2048'
        ]);

        if ($validator->fails())
            return redirect()->back()->withInput()->withErrors($validator);

        $image = $request->file('property_img');
        $image_path = $image->store('properties');
        $image_url = config('app.url') . '/images/properties/' . basename($image_path);

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'details' => $request->details,
            'image_url' => $image_url,
            'seller_id' => $request->user()->id
        ]);

        return redirect()->route('seller.properties')->with('success', 'Property added successfully.');
    }

    public function properties(Request $request)
    {
        $properties = Product::where('seller_id', $request->user()->id)->where('status', 'not_sold')->get();

        if ($request->query('status') === 'sold')
            $properties = Product::where('seller_id', $request->user()->id)->where('status', 'sold')->get();

        return view('seller.properties', compact('properties'));
    }

    public function bookings(Request $request, int $id)
    {
        $product = Product::whereId($id)->first(['name']);
        $bookings = Booking::where('product_id', $id)->get();
        return view('seller.bookings', compact('bookings', 'product'));
    }

    public function confirm_booking(int $id)
    {
        Booking::whereId($id)->update([
            'status' => 'confirmed'
        ]);

        $booking = Booking::whereId($id)->first(['product_id']);
        Product::whereId($booking->product_id)->update([
            'status' => 'sold'
        ]);

        return redirect()->back()->with('success', 'Booking confirmed successfully.');
    }

    public function cancel_booking(int $id)
    {
        Booking::whereId($id)->update([
            'status' => 'cancelled'
        ]);

        return redirect()->back()->with('success', 'Booking cancelled successfully.');
    }

    public function remove_property(int $id)
    {
        Product::whereId($id)->delete();
        return redirect()->back()->with('success', 'Property removed successfully.');
    }
}
