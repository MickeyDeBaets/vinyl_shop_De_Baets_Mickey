<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Facades\App\Helpers\Json;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       $zoeken = '%' . $request->input('username') . '%';
       $sorting = $request->input('sorting');
       $sortBy = "name";
       $sortOrder = "asc";
       if ($sorting == "name_AZ"){
           $sortBy = "name";
           $sortOrder = "asc";
       }
        if ($sorting == "name_ZA"){
            $sortBy = "name";
            $sortOrder = "desc";
       }
        if ($sorting == "email_AZ"){
            $sortBy = "email";
            $sortOrder = "asc";
       }
        if ($sorting == "email_ZA"){
            $sortBy = "email";
            $sortOrder = "desc";
       }
        if ($sorting == "active"){
            $sortBy = "active";
            $sortOrder = "desc";
       }
        if ($sorting == "admin"){
            $sortBy = "admin";
            $sortOrder = "desc";
       }
        $currentUser = auth()->user();
        $users = User::orderBy($sortBy, $sortOrder)
            ->where('name', 'like', $zoeken)
            ->orWhere('email', 'like', $zoeken)
            ->orderBy($sortBy, $sortOrder)
            ->paginate(10)
            ->appends(['username' => $request->input('username'), 'sorting' => $request->input('sorting')]);
//


        $result = compact('users','currentUser');
        Json::dump($result);

        return view('admin.users.index', $result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect("admin/users");
    }


    public function show(User $user)
    {
        return redirect("admin/users");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $result = compact('user');
        Json::dump($result);
        return view('admin.users.edit', $result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request,[
            'name' => 'required|min:3|unique:users,name,',
            'email' => 'required|min:3|unique:users,email,'
        ]);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->active = $request->active ?? 0;
        $user->admin = $request->admin ?? 0;
        $user->save();
        session()->flash('success', 'The user has been updated');
        return redirect('admin/users');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user->id == auth()->id())
        {
            session()->flash('danger', "In order not to exclude yourself from (the admin section of) the application, you con not edit your own profile.");
            return back();
        }
        $user->delete();
        session()->flash('success', "The user <b>$user->name</b> has been deleted");
        return back();
    }
}
