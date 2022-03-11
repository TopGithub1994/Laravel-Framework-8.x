<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Spatie\Browsershot\Browsershot;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class ScreenShotController extends Controller
{
    function printScreenShot(Request $request){
        if (File::exists(public_path('/monthly_report.jpg'))) {
		    File::delete(public_path('/monthly_report.jpg'));
        }
        Browsershot::url(
            $request->url
        )
            ->setNodeBinary("C:\Programs\\nodejs\\node.exe")
            ->windowSize(1675,2520)
            ->waitUntilNetworkIdle()
            ->save('./monthly_report.jpg');
        $imagePath = public_path('/monthly_report.jpg');
        return Image::make($imagePath)->response();
    }
}

