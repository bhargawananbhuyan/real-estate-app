@extends('layouts.app')

@section('title')
    {{ Auth::user()->name }}'s Bookings
@endsection

@section('main')
    <div class="space-y-5">
        <h1 class="text-xl font-bold">Bookings</h1>

        @if (count($bookings) > 0)
            <table class="base-table">
                <thead>
                    <tr>
                        <th>Property image</th>
                        <th>Property name</th>
                        <th>Booked on</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bookings as $booking)
                        <tr>
                            <td>
                                <img src="{{ $booking->product->image_url }}" alt="{{ $booking->product->name }}"
                                    width="100" class="rounded-md">
                            </td>
                            <td>{{ $booking->product->name }}</td>
                            <td>{{ $booking->created_at }}</td>
                            <td>
                                <em @class([
                                    'text-yellow-500' => $booking->status === 'pending',
                                    'text-green-500' => $booking->status === 'confirmed',
                                    'text-red-500' => $booking->status === 'cancelled',
                                ])>{{ ucwords($booking->status) }}</em>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No bookings available.</p>
        @endif
    </div>
@endsection
