<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Todo;
use Illuminate\Support\Facades\Validator;

class TodoController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function index()
    {
        $data = Todo::all();
        return Inertia::render('todos', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'title' => ['required'],
            'body' => ['required'],
        ])->validate();

        Todo::create($request->all());

        return redirect()->back()->with('message', 'Todo Created Successfully.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function update(Request $request)
    {
        Validator::make($request->all(), [
            'title' => ['required'],
            'body' => ['required'],
        ])->validate();

        if ($request->has('id')) {
            Todo::find($request->input('id'))->update($request->all());
            return redirect()->back()->with('message', 'Todo Updated Successfully.');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function destroy(Request $request)
    {
        if ($request->has('id')) {
            Todo::find($request->input('id'))->delete();
            return redirect()->back();
        }
    }
}
