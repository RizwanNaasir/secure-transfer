<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{

    public function register()
    {
        return view(view: 'auth.custom-auth.register');
    }

    public function login()
    {
        return view(view: 'auth.custom-auth.login.blade.php');
    }

    public function forget( )
    {
        return view(view: 'auth.custom-auth.forget-password');
    }

    public function profile()
    {
        return view(view: 'user.profile.index');
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
