<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $load['users'] = User::get();

        return  view('pages.user.index', $load);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {

        return view('pages.user.show', compact('user'));
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
    public function update(Request $request, User $user)
    {
        if ($request->from == 'admin') {
            $postVal['name'] = $request->name;
            $postVal['email'] = $request->email;
            $postVal['phone'] = $request->phone;
            $postVal['is_admin'] = $request->is_admin;

            if ($request->password) {
                $postVal['password'] = Hash::make($request->password);
            }

            $user->update($postVal);

            return redirect()->route('user.index')->withSuccess('Update User Berhasil');
        }else{
            $postVal['name'] = $request->name;
            $postVal['email'] = $request->email;
            $postVal['phone'] = $request->phone; 
    
            if ($request->password) {
                $postVal['password'] = Hash::make($request->password);
            }
    
            $user->update($postVal);
    
            return redirect()->route('user.show',$user->id)->withSuccess('Update User Berhasil');;;;
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
        User::find($id)->delete();
        return redirect()->route('user.index')->withSuccess('Hapus User Berhasil');;
    }
}
