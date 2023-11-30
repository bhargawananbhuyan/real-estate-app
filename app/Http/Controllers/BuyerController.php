<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Product;
use Illuminate\Http\Request;

class BuyerController extends Controller
{
    public function properties(Request $request)
    {
        $properties = Product::where('status', 'not_sold')->get();
        return view('buyer.properties', compact('properties'));
    }

    public function bookings(Request $request)
    {
        $bookings = Booking::where('buyer_id', $request->user()->id)->get();
        return view('buyer.bookings', compact('bookings'));
    }

    public function book_property(Request $request, int $id)
    {
        $existing_booking = Booking::where('product_id', $id)->where('buyer_id', $request->user()->id)->whereNot('status', 'cancelled');
        if ($existing_booking->exists())
            return redirect()->back()->with('error', 'Booking request already sent for this property.');

        Booking::create([
            'product_id' => $id,
            'buyer_id' => $request->user()->id
        ]);

        return redirect()
            ->route('buyer.bookings')
            ->with('success', 'Booking request sent successfully.');
    }
}
