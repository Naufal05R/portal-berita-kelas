<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use App\Models\Slider;
use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    public function index()
    {
        $title        = "Welcome to ZenBlog";
        $news         = News::latest()->get();
        $nav_category = Category::all();
        $slider       = Slider::all();
        $side_news    = News::inRandomOrder()->limit(4)->get();

        return view('frontend.index', compact(
            'title',
            'news',
            'nav_category',
            'slider',
            'side_news'
        ));
    }

    public function detailCategory($slug)
    {
        $category = Category::where('slug', $slug)->first();
        $text     = Category::findOrFail($category->id)->name;
        $title    = "Detail Category - $text";
        $news     = News::where('category_id', $category->id)->paginate(10);
        $nav_category = Category::all();
        $side_news    = News::inRandomOrder()->limit(4)->get();

        return view('frontend.detail-category', compact(
            'title',
            'news',
            'nav_category',
            'side_news'
        ));
    }

    public function detailNews($slug)
    {
        
        $news         = News::where('slug', $slug)->first();
        $text         = News::findOrFail($news->id)->title;
        $title        = "Berita - $text" ;
        $nav_category = Category::all();
        $side_news    = News::inRandomOrder()->limit(4)->get();

        return view('frontend.detail-news', compact(
            'title',
            'news',
            'nav_category',
            'side_news'
        ));
    }

    public function searchNewsEnd(Request $request)
    {
        $keyword      = $request->keyword;
        $news         = News::where('title', 'like', '%' . $keyword . '%')->paginate(10);
        $slider       = Slider::all();
        $title        = "Welcome to ZenBlog";
        $nav_category = Category::all();
        $side_news    = News::inRandomOrder()->limit(4)->get();

        return view('frontend.index', compact('news', 'slider', 'title', 'nav_category', 'side_news'));
    }
}
