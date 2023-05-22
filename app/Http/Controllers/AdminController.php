<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;



use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
          $notification = array(
            'message' => 'User Logout Successfully',
            'alert-type' => 'success',
        );

        return route('login')->with($notification);
    }//


    public function Profile(){
        $id = Auth::user()->id;
        $adminData = User::find($id);
        //dd($adminData['profile_image']);
        return view('admin.admin_proflie_view',compact('adminData'));

    }

    public function editProfile(){
        $id = Auth::user()->id;
        $editData = User::find($id);
        return view('admin.admin_profile_edit',compact('editData'));
    }

    public function storeProfile(Request $request){
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;

        if($request->file('profile_image')){
            $file = $request->file('profile_image');
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_image'),$filename);
            $data['profile_image']= $filename;

        }
        $data->save();

        $notification = array(
            'message' => 'Admin Profile Update Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('admin.profile')->with($notification);




    }

     public function changePassword(){
            return view('admin.admin_change_password');
        }

    public function updatePassword(Request $request){
        $validateData = $request->validate([
            'oldpassword'=>'required',
            'newpassword'=>'required',
            'confirm_password'=>'required|same:newpassword',
        ]);

        $hashedPassword = Auth::user()->password;
        if(Hash::check($request->oldpassword, $hashedPassword)){
            $user = User::find(Auth::id());
            $user->password = bcrypt($request->newpassword);
            $user->save();
            session()->flash('message','password updated successfully');
            return redirect()->back();
        }else{
             session()->flash('message','Old password not match');
            return redirect()->back();
        }

    }

}



