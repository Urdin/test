<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;


class AdsController extends Controller
{

    public function index(Request $request)
    {

        $id = $request->route('id');

        if($id !== 'new'){
            $data = DB::table('ads')->select('ad')->where('id','=',$id)->get();
            return view('ads',array('text'=>trim($data[0]->ad)));
        }

        return view('ads',array('text'=>''));

    }


    public function new(Request $request)
    {

        $user_id = $request->user()->id;
        $ad_text = $request['data'];

        DB::table('ads')->insert([
            'user_id' => $user_id,
            'ad' => $ad_text 
        ]);

    }

    public function update(Request $request)
    {

        $id = $request['id'];
        $user_id = $request->user()->id;
        $ad = $request['data'];

        DB::table('ads')
            ->where('id',$id)
            ->update(['ad' => $ad]);
        
    }


    public function delete(Request $request)
    {
        $id = $request['id'];
        DB::table('ads')->where('id',$id)->delete();
        return Redirect::route('dashboard');
    }




    
    /**
     * Display the user's profile form.
     */
    /*
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }
    */
    /**
     * Update the user's profile information.
     */
    /*
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    /*
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
    */

}
