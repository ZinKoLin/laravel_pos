<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About;
use App\Models\MultiImage;
use Image;
use Illuminate\Support\Carbon;

class AboutController extends Controller
{
    public function aboutPage(){
        $aboutpage = About::find(1);
        return view('admin.about_page.about_page_all',compact('aboutpage'));
    }


    public function aboutUpdate(Request $request){

        $about_id = $request->id;
        if($request->file('about_image')){
            $image = $request->file('about_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(523,605)->save('upload/home_about/'.$name_gen);

            $save_url='upload/home_about/'.$name_gen;

            About::findorFail($about_id)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'short_description' => $request->short_description,
                'long_description' => $request->long_description,
                'about_image'=>$save_url,
            ]);
              $notification = array(
            'message' => 'HomeSlide With Image Update Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);



        }else{

            About::findorFail($about_id)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'short_description' => $request->short_description,
                'long_description' => $request->long_description,


            ]);
              $notification = array(
            'message' => 'About Page Without Image Update Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);

        }

    }

    public function homeAbout(){
        $aboutpage = About::find(1);
        return view('frontend.about_page');
    }

    public function aboutMultiImage(){

        return view('admin.about_page.multi_image');
    }

    public function storeMultiImage(Request $request){
        $image = $request->file('multi_image');

        foreach ($image as $multi_image){
            $name_gen = hexdec(uniqid()).'.'.$multi_image->getClientOriginalExtension();
            Image::make($multi_image)->resize(220,220)->save('upload/multi/'.$name_gen);

            $save_url='upload/multi/'.$name_gen;
            MultiImage::insert([
                'multi_image'=> $save_url,
                'created_at'=>Carbon::now(),
            ]);
        }


              $notification = array(
            'message' => 'Multi Image Inserted U Successfully',
            'alert-type' => 'success',);
            return redirect()->back()->with($notification);
              }


              public function allMultiImage(){
                $allMultiImage = MultiImage::all();
                return view('admin.about_page.all_multiimage', compact('allMultiImage'));
              }


              public function editMultiImage($id){
                $multiImage = MultiImage::findOrFail($id);
                return view('admin.about_page.edit_multi_image', compact('multiImage'));
              }

              public function updateMultiImage(Request $request){


                $multi_image_id = $request->id;
                if($request->file('multi_image')){
                    $image = $request->file('multi_image');
                    $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
                    Image::make($image)->resize(220,220)->save('upload/multi/'.$name_gen);

                    $save_url='upload/multi/'.$name_gen;

                    MultiImage::findorFail($multi_image_id)->update([

                        'multi_image'=>$save_url,
                    ]);
                    $notification = array(
                    'message' => 'Muliti Image Updated Successfully',
                    'alert-type' => 'success',
                );

        return redirect()->route('all.multi.image')->with($notification);
    }



              }


            public function deleteMultiImage($id){
                $multi = MultiImage::findOrFail($id);
                $img = $multi->multi_image;
                unlink($img);

                MultiImage::findOrFail($id)->delete();
                $notification = array(
                    'message' => 'Muliti Image Deleted Successfully',
                    'alert-type' => 'success',
                );

        return redirect()->back()->with($notification);

            }

        }









