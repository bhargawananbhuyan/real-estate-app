@extends('layouts.app')

@section('title')
    Bookings for {{ $product->name }}
@endsection

@section('main')
    <div class="space-y-5">
        <h1 class="text-xl font-bold">Bookings</h1>

        @if (count($bookings) > 0)
            <table class="base-table">
                <thead>
                    <th>Booking ID</th>
                    <th>Placed on</th>
                    <th>Booked by</th>
                    <th>Status/Action</th>
                </thead>
                <tbody>
                    @foreach ($bookings as $booking)
                        <tr>
                            <td>{{ $booking->id }}</td>
                            <td>{{ $booking->created_at }}</td>
                            <td>{{ $booking->buyer->name }}</td>
                            <td>
                                <div class="flex items-center gap-x-2">
                                    @if ($booking->status === 'pending')
                                        <form action="{{ route('admin.confirm_booking', ['id' => $booking->id]) }}"
                                            method="post">
                                            @csrf
                                            @method('put')
                                            <button type="submit"
                                                class="text-xs font-medium bg-green-500 text-white px-2.5 py-2 rounded-md">
                                                Confirm
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.cancel_booking', ['id' => $booking->id]) }}"
                                            method="post">
                                            @csrf
                                            @method('put')
                                            <button type="submit"
                                                class="text-xs font-medium bg-red-500 text-white px-2.5 py-2 rounded-md">
                                                Cancel
                                            </button>
                                        </form>
                                    @else
                                        <em @class([
                                            'text-green-500' => $booking->status === 'confirmed',
                                            'text-red-500' => $booking->status === 'cancelled',
                                        ])>{{ ucwords($booking->status) }}</em>
                                    @endif
                                </div>
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
