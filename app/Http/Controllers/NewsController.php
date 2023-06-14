<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news =  News::latest()->paginate('3');
        $category = Category::all();

        return view('admin.news.index', compact(
            'news',
            'category'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();

        return view('admin.news.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'category_id' => 'required',
            'title'       => 'required',
            'image'       => 'required|mimes:png,jpg,jpeg',
            'description' => 'required'
        ]);

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/newss', $image->hashName());

        //save to DB
        News::create([
            'category_id'       => $request->category_id,
            'title'             => $request->title,
            'slug'              => Str::slug($request->title, '-'),
            'image'             => $image->hashName(),
            'description'       => $request->description
        ]);

        return redirect()->route('news.index')->with([
            Alert::success('Success', 'Message Success')
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::all();
        $news     = News::findOrFail($id);

        return view('admin.news.show', compact(
            'category',
            'news'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::all();
        $news     = News::findOrFail($id);

        return view('admin.news.edit', compact(
            'category',
            'news'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news)
    {
        $this->validate($request, [
            'title'  => 'required|unique:news,title,' . $news->id,
            'image'  => 'mimes:png,jpg,jpeg'
        ]);

        //check jika image kosong
        if ($request->file('image') == '') {

            //update data tanpa image
            $news = News::findOrFail($news->id);
            $news->update([
                'title'         => $request->title,
                'category_id'   => $request->category_id,
                'description'   => $request->description,
                'slug'          => Str::slug($request->title, '-')
            ]);
        } else {

            //hapus image lama
            Storage::disk('local')->delete('public/newss/' . basename($news->image));

            //upload image baru
            $image = $request->file('image');
            $image->storeAs('public/newss/', $image->hashName());

            //update dengan image baru
            $news = News::findOrFail($news->id);
            $news->update([
                'image'         => $image->hashName(),
                'title'         => $request->title,
                'category_id'   => $request->category_id,
                'description'   => $request->description,
                'slug'          => Str::slug($request->title, '-')
            ]);
        }

        if ($news) {
            return redirect()->route('news.index')->with([
                Alert::success('Success', 'Berhasil diupdate')
            ]);
        } else {
            return redirect()->route('news.index')->with([
                Alert::error('Error', 'Gagal diupdate')
            ]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $news = News::findOrFail($id);
        Storage::disk('local')->delete('public/newss/' . basename($news->image));
        $news->delete();

        return redirect()->route('news.index')->with([
            Alert::success('Success', 'Berhasil dihapus')
        ]);
    }

    public function searchNews(Request $request)
    {
        $keyword = $request->keyword;
        $news    = News::where('title', 'like', '%' . $keyword . '%')->paginate(5);

        return view('admin.news.index', compact('news'));
    }
}
