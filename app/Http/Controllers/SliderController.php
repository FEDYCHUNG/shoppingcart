<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    //

    public function addslider()
    {
        return view("admin.addslider");
    }

    public function sliders()
    {
        $sliders = Slider::All();

        return view("admin.sliders", ["sliders" => $sliders]);
    }

    public function saveSlider(Request $request)
    {
        $this->validate($request, [
            'description1' => "required",
            'description2' => "required",
            "slider_image" => "image|nullable|max:1999|required"
        ]);

        $sliders = new Slider();
        $sliders->description1 = $request->description1;
        $sliders->description2 = $request->description2;

        $file_name_to_store = "no_image.jpg";
        if ($request->hasFile("slider_image")) {
            $file_name_with_ext = $request->file("slider_image")->getClientOriginalName();
            $file_name = pathinfo($file_name_with_ext, PATHINFO_FILENAME);
            $extension = $request->file("slider_image")->getClientOriginalExtension();
            $file_name_to_store = $file_name . "_" . time() . "." . $extension;

            $path = $request->file("slider_image")->storeAs("public/slider_images", $file_name_to_store);
        }
        $sliders->slider_image = $file_name_to_store;
        $sliders->status = config("constants.SLIDER_ACTIVE");
        $sliders->save();

        return back()->with("status", "The slider has been saved successfully !!!");
    }

    function activeUnactiveSlider($id, $status_update)
    {
        $slider = Slider::find($id);
        $slider->status = (int) $status_update;
        $slider->save();

        return redirect()->route("admin.sliders.sliders")->with("status", "The slider has been " . (strval($status_update) == config('constants.SLIDER_ACTIVE')) ? "Active" : "Unactive" . " successfully !!");
    }

    function editSlider($id)
    {
        $slider = Slider::find($id);
        return view("admin.editSlider", ["slider" => $slider]);
    }

    public function updateSlider(Request $request)
    {
        $this->validate($request, [
            'description1' => "required",
            'description2' => "required",
            "slider_image" => "image|nullable|max:1999"
        ]);

        $slider = Slider::find($request->id);
        $slider->description1 = $request->description1;
        $slider->description2 = $request->description2;

        if ($request->hasFile("slider_image")) {
            $file_name_with_ext = $request->file("slider_image")->getClientOriginalName();
            $file_name = pathinfo($file_name_with_ext, PATHINFO_FILENAME);
            $extension = $request->file("slider_image")->getClientOriginalExtension();
            $file_name_to_store = $file_name . "_" . time() . "." . $extension;

            $path = $request->file("slider_image")->storeAs("public/slider_images", $file_name_to_store);

            Storage::delete("public/slider_images/" . $slider->slider_image);

            $slider->slider_image = $file_name_to_store;
        }
        $slider->save();

        return redirect()->route("admin.sliders.sliders")->with("status", "The slider has been updated successfully !!!");
    }

    public function deleteSlider($id)
    {
        $slider = Slider::find($id);
        Storage::delete("public/slider_images/" . $slider->slider_image);
        $slider->delete();

        return redirect()->route("admin.sliders.sliders")->with("status", "The slider has been deleted successfully");
    }
}