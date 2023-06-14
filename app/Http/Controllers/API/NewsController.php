<?php

namespace App\Http\Controllers\API;

use App\Models\News;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    public function index()
    {
        try {
            $news = News::latest()->paginate('10');

            if ($news) {
                return ResponseFormatter::success($news, 'Data news berhasil diambil');
            } else {
                return ResponseFormatter::error(null, 'Data news tidak ada', 404);
            }
        } catch (\Error $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error'   => $error
            ], 'Authentication Failed', 500);
        }
    }

    public function show($id)
    {
        try {
            $news = News::findOrFail($id);

            if ($news) {
                return ResponseFormatter::success($news, 'Data news berhasil diambil');
            } else {
                return ResponseFormatter::error(null, 'Data news tidak ada', 404);
            }
        } catch (\Error $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error'   => $error
            ], 'Authentication Failed', 500);
        }
    }

    public function create(Request $request)
    {
        try {
            //validate request
            $this->validate($request, [
                'category_id' => 'required',
                'title'       => 'required',
                'image'       => 'required|mimes:png,jpg,jpeg',
                'description' => 'required'
            ]);

            //upload image
            $image = $request->file('image');
            $image->storeAs('public/newss', $image->hashName());

            // Save to DB
            $news = News::create([
                'category_id' => $request->category_id,
                'title'       => $request->title,
                'slug'        => Str::slug($request->title, '-'),
                'image'       => $image->hashName(),
                'description' => $request->description
            ]);

            return ResponseFormatter::success($news, 'Data news berhasil ditambahkan');
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
            $news = News::findOrFail($id);
            //delete image from storage
            Storage::disk('local')->delete('public/newss/' . basename($news->image));
            //delete data from DB
            $news->delete();

            return ResponseFormatter::success($news, 'Data news berhasil dihapus');
        } catch (\Error $error) {
            return ResponseFormatter::error([
                'data'      => null,
                'message' => 'Data gagal dihapus',
                'error'   => $error
            ]);
        }
    }

    public function update(Request $request, News $news)
    {
        try {
            //validate request
            $this->validate($request, [
                'category_id' => 'required',
                'title'       => 'required',
                'image'       => 'mimes:png,jpg,jpeg',
                'description' => 'required'
            ]);

            // Find the news item
            $news = News::findOrFail($news->id);

            //check jika image kosong
            if ($request->file('image') == '') {

                //update data tanpa image
                $news->update([
                    'category_id' => $request->category_id,
                    'title'       => $request->title,
                    'slug'        => Str::slug($request->title, '-'),
                    'description' => $request->description
                ]);
            } else {

                //hapus image lama
                Storage::disk('local')->delete('public/newss/' . basename($news->image));

                //upload image baru
                $image = $request->file('image');
                $image->storeAs('public/newss', $image->hashName());

                //update dengan image baru
                $news->update([
                    'category_id' => $request->category_id,
                    'title'       => $request->title,
                    'slug'        => Str::slug($request->title, '-'),
                    'image'       => $image->hashName(),
                    'description' => $request->description
                ]);
            }

            // return
            if ($news) {
                return ResponseFormatter::success($news, 'Data news berhasil diupdate');
            } else {
                return ResponseFormatter::error(null, 'Data news tidak ada', 404);
            }


        } catch (\Error $error) {
            return ResponseFormatter::error([
                'data'      => null,
                'message' => 'Data gagal diupdate',
                'error'   => $error
            ]);
        }
    }
}
