<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Hobby;

use App\Events\TestEvent;

class UserController extends Controller
{
    public function index() {
        $users = User::all();
        
        TestEvent::dispatch('てすと'); // TestEvent発火
        
        return view('user.index', compact('users'));
    }
    
    public function edit(User $user) {
        $hobbies = Hobby::all();
        return view('user.edit', compact('user', 'hobbies'));
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
