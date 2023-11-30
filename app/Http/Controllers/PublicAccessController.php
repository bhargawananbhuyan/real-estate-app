<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class PublicAccessController extends Controller
{
    public function home()
    {
        return view("welcome");
    }

    public function images(string $folder, string $filename)
    {
        $url = config('app.url') . "/$folder/$filename";
        $ext = pathinfo($url, PATHINFO_EXTENSION);
        $content = Storage::disk('local')->get("$folder/$filename");

        $header = [
            'Content-Type' => "image/$ext",
            'Content-Disposition' => 'inline; filename="' . $filename . '"'
        ];

        return Response::make($content, 200, $header);
    }
}
