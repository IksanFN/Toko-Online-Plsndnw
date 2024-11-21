<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Models\SliderCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class SliderController extends Controller
{
    public function index(Request $request)
    {
        if ($request->search) {

            $sliders = Slider::query()->whereAny(['title', 'tagline'], 'LIKE', '%'.$request->search.'%')
                        ->latest()
                        ->paginate(10)
                        ->withQueryString();
        } else {

            $sliders = Slider::query()->latest()->paginate(10);

        }

        return view('admin.slider.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.sliders.create');
    }

    public function store(Request $request)
    {
        $thumbnail = $request->file('thumbnail');
        $thumbnail->StoreAs('thumbnail', $thumbnail->hashName());
        try {

            DB::transaction(function () use ($request, $thumbnail) {

                Slider::query()->create([
                    'thumbnail' => $thumbnail->hashName(),
                    'title' => $request->input('title'),
                    'tagline' => $request->input('tagline'),
                    'content' => $request->input('content'),
                ]);

            });

            Alert::success('Success', 'Slider Creatd Successfully');
            return redirect()->route('admin.sliders.index');

        } catch (\Throwable $th) {

            Alert::error('Error', 'Error Creating Slider');
            return redirect()->route('admin.sliders.index');

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Slider $slider)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SliderCategory $sliderCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SliderCategory $sliderCategory)
    {
        //
    }
}
