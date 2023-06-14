<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function index()
    {
        try {
            $slider = Slider::all();

            if($slider){
                return ResponseFormatter::success($slider, 'Data Slider Berhasil Diambil');
            } else {
                return ResponseFormatter::error(null, 'Data Slider Tidak Ada', 404);
            }
        } catch (\Error $err) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error'   => $err
            ], 'Authentication Failed', 500);
        }
    }

    public function create(Request $request)
    {
        try {
            //validate request
            $this->validate($request, [
                'image' => 'required|mimes:png,jpg,jpeg|max:2000',
                'url'   => 'required'
            ]);

            //upload image
            $image = $request->file('image');
            $image->storeAs('public/sliders', $image->hashName());

            // Save to DB
            $slider = Slider::create([
                'image' => $image->hashName(),
                'url'   => $request->url
            ]);

            if ($slider) {
                return ResponseFormatter::success($slider, 'Data Slider berhasil ditambahkan');
            } else {
                return ResponseFormatter::error(null, 'Data Slider gagal ditambahkan', 404);
            }
        } catch (\Error $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error'   => $error
            ], 'Authentication Failed', 500);
        }
    }

    public function destroy($id)
    {
        try {
            $slider = Slider::findOrFail($id);
            //delete image
            Storage::disk('local')->delete('public/categories/' . basename($slider->image));
            //delete data
            $slider->delete();

            if ($slider) {
                return ResponseFormatter::success($slider, 'Data category berhasil dihapus');
            } else {
                return ResponseFormatter::error(null, 'Data category tidak ada', 404);
            }
            
        } catch (\Error $error) {
            return ResponseFormatter::error([
                'data'      => null,
                'message' => 'Data gagal dihapus',
                'error'   => $error
            ]);
        }
    }

    public function show($id)
    {
        try {
            $slider = Slider::findOrFail($id);

            if ($slider) {
                return ResponseFormatter::success($slider, 'Data category berhasil diambil');
            } else {
                return ResponseFormatter::error(null, 'Data category tidak ada', 404);
            }
        } catch (\Error $error) {
            return ResponseFormatter::error([
                'data'      => null,
                'message' => 'Data gagal diambil',
                'error'   => $error
            ]);
        }
    }
    
}
