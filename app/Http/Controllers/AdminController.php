<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function properties(Request $request)
    {
        $properties = Product::all();
        return view('admin.properties', compact('properties'));
    }

    public function bookings(Request $request, int $id)
    {
        $product = Product::whereId($id)->first(['name']);
        $bookings = Booking::where('product_id', $id)->get();
        return view('admin.bookings', compact('bookings', 'product'));
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
