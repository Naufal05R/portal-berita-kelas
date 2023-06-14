<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slider = Slider::all();
        return view('admin.slider.index', compact('slider'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'image' => 'required|mimes:png,jpg,jpeg|max:2000',
            'url'   => 'required'
        ]);

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/sliders', $image->hashName());

        // Save to DB
        Slider::create([
            'image' => $image->hashName(),
            'url'   => $request->url
        ]);

        return redirect()->route('slider.index')->with([
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider)
    {
        $this->validate($request,[
            'image' => 'mimes:png,jpg,jpeg|max:2000',
            'url'   => 'required'
        ]);

        if ($request->file('image') == '') {

            //update data tanpa image
            $slider = Slider::findOrFail($slider->id);
            $slider->update([
                'url'   => $request->url
            ]);

        } else {

            //hapus image lama
            Storage::disk('local')->delete('public/sliders/' . basename($slider->image));

            //upload image baru
            $image = $request->file('image');
            $image->storeAs('public/sliders', $image->hashName());

            //update dengan image baru
            $slider = Slider::findOrFail($slider->id);
            $slider->update([
                'image'  => $image->hashName(),
                'url'   => $request->url,
            ]);
        }
        return redirect()->route('slider.index')->with([
            Alert::success('Success', 'Message Success')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);
        Storage::disk('local')->delete('public/sliders/' .basename($slider->image));
        $slider->delete();

        return redirect()->route('slider.index')->with([
            Alert::success('Success', 'Message Success')
        ]);

    }
}
