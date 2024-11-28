<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Slider\SliderStore;
use App\Http\Requests\Admin\Slider\SliderUpdate;
use App\Models\Slider;
use App\Models\SliderCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class SliderController extends Controller
{
    public function index(Request $request)
    {
        $sliders = Slider::search($request->search)->latest()->paginate(10);

        return view('admin.sliders.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.sliders.create');
    }

    public function store(SliderStore $request)
    {
        $thumbnail = $request->file('thumbnail');
        $thumbnail->storeAs('public/thumbnails', $thumbnail->hashName());
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

    public function edit(Slider $slider)
    {
        return view('admin.sliders.edit', compact('slider'));
    }

    public function update(SliderUpdate $request, Slider $slider)
    {
        try {
            DB::transaction(function () use ($request, $slider) {

                if ($request->hasFile('thumbnail')) {

                    $thumbnail = $request->file('thumbnail');
                    $thumbnail->storeAs('public/thumbnails', $thumbnail->hashName());

                    Storage::delete('public/thumbnails/'.$slider->thumbnail);

                    $slider->update([
                        'thumbnail' => $thumbnail->hashName(),
                        'title' => $request->input('title'),
                        'tagline' => $request->input('tagline'),
                        'content' => $request->input('content'),
                    ]);
                } else {
                    $slider->update([
                        'title' => $request->input('title'),
                        'tagline' => $request->input('tagline'),
                        'content' => $request->input('content'),
                    ]);
                }

            });

            Alert::success('Success', 'Slider Updated Successfully');
            return redirect()->route('admin.sliders.index');

        } catch (\Throwable $th) {

            Alert::success('Error', 'Error Creating Slider');
            return redirect()->route('admin.sliders.index');

        }
    }

    public function destroy(Slider $slider)
    {
        DB::beginTransaction();
        try {

            $slider->delete();
            DB::commit();

            Alert::success('Success', 'Slider Deleted Successfully');
            return redirect()->route('admin.sliders.index');

        } catch (\Throwable $th) {

            DB::rollback();

            Alert::error('Error', 'Error Creating Slider');
            return redirect()->route('admin.sliders.index');

        }
    }
}
