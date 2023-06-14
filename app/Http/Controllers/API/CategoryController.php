<?php

namespace App\Http\Controllers\API;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        try {
            $category = Category::latest()->paginate('10');

            if ($category) {
                return ResponseFormatter::success($category, 'Data category berhasil diambil');
            } else {
                return ResponseFormatter::error(null, 'Data category tidak ada', 404);
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
                'name'  => 'required|string|max:255',
                'image' => 'required|mimes:png,jpg,jpeg'
            ]);

            $image = $request->file('image');
            $image->storeAs('public/categories', $image->hashName());

            // use Illuminate\Support\Str;
            $category = Category::create([
                'name'  => $request->name,
                'slug'  => Str::slug($request->name, '-'),
                'image' => $image->hashName()
            ]);

            if ($category) {
                return ResponseFormatter::success($category, 'Data category berhasil ditambahkan');
            } else {
                return ResponseFormatter::error(null, 'Data category gagal ditambahkan', 404);
            }
        } catch (\Error $error) {
            return ResponseFormatter::error([
                'data'      => null,
                'message' => 'Data gagal ditambahkan',
                'error'   => $error
            ]);
        }
    }

    public function destroy($id)
    {
        try {
            $category = Category::findOrFail($id);
            //delete image
            Storage::disk('local')->delete('public/categories/' . basename($category->image));
            //delete data
            $category->delete();

            if ($category) {
                return ResponseFormatter::success($category, 'Data category berhasil dihapus');
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

    public function update(Request $request, $id)
    {
        try {

            //request validate
            $this->validate($request, [
                'name'  => 'required|unique:categories,name,' . $id,
                'image' => 'mimes:png,jpg,jpeg|max:2000'
            ]);

            //get data category by id
            $category = Category::findOrFail($id);

            //check jika image kosong
            if ($request->file('image') == '') {

                //update data tanpa image
                $category->update([
                    'name'  => $request->name,
                    'slug'  => Str::slug($request->name, '-')
                ]);

                if ($category) {
                    return ResponseFormatter::success($category, 'Data category berhasil diupdate');
                } else {
                    return ResponseFormatter::error(null, 'Data category tidak ada', 404);
                }
            } else {

                //delete image lama
                Storage::disk('local')->delete('public/categories/' . basename($category->image));

                //upload image baru
                $image = $request->file('image');
                $image->storeAs('public/categories', $image->hashName());

                //update data dengan image baru
                $category->update([
                    'name'  => $request->name,
                    'slug'  => Str::slug($request->name, '-'),
                    'image' => $image->hashName()
                ]);

                if ($category) {
                    return ResponseFormatter::success($category, 'Data category berhasil diupdate');
                } else {
                    return ResponseFormatter::error(null, 'Data category tidak ada', 404);
                }
            }
        } catch (\Error $error) {
            return ResponseFormatter::error([
                'data'      => null,
                'message' => 'Data gagal diupdate',
                'error'   => $error
            ]);
        }
    }

    public function show($id)
    {
        try {
            $category = Category::findOrFail($id);

            if ($category) {
                return ResponseFormatter::success($category, 'Data berhasil ditampilkan');
            } else {
                return ResponseFormatter::error(null, 'Data gagal ditampilkan', 404);
            }
        } catch (\Error $error) {
            return ResponseFormatter::error([
                'data'      => null,
                'message' => 'Data gagal ditampilkan',
                'error'   => $error
            ]);
        }
    }
}
