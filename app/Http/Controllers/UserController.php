<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index() {
        $users = User::all();
        return view('user.index', compact('users'));
    }
    
    public function edit(User $user) {
        return view('user.edit', compact('user'));
    }
    
    public function update(Request $request, User $user) {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'role' => 'required',
        ]);
        $user->update($validated);
        
        //\Session::flash('message', '更新しました'); // withのかわりにこれでもいい
        //$request->session()->flash('message', '更新しました'); // withのかわりにこれでもいい
        
        return redirect(route('user.index'))->with('message', '更新しました');
    }
    
    public function destroy(Request $request, User $user) {
        $user->delete();
        
        $request->session()->flash('message', '削除しました');
        
        return redirect(route('user.index'));
    }
}
