<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\Models\Test;
use App\Http\Requests\TestRequest;

class TestController extends Controller
{
    public function index() {
        $tests = Test::all();
        return view('test.index', compact('tests'));
    }
    
    public function input() {
        return view('test.input');
    }
    
    public function store(TestRequest $request) {
        Test::create($request->validated());
        
        return redirect(route('test.index'));
    }
    
    public function edit(Test $test) {
        return view('test.edit', compact('test'));
    }
    
    public function update(TestRequest $request, Test $test) {
        $test->update($request->validated());
        
        return redirect(route('test.index'));
    }
}
