<?php

namespace App\Http\Controllers;

use App\Models\Usermanagement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UsermanagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usermanagements = Usermanagement::orderBy('id', 'desc')->paginate(3);
        return view('usermanagement.index', ['usermanagements' => $usermanagements]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('usermanagement.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
          'name' => 'required',
          'age' => 'required',
          'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time() . '.' . $request->file->extension();
        // $request->image->move(public_path('images'), $imageName);
        $request->file->storeAs('public/images', $imageName);

        $usermanagementData = ['name' => $request->name, 'age' => $request->age, 'image' => $imageName];

        Usermanagement::create($usermanagementData);
        return redirect('/usermanagement')->with(['message' => 'User added successfully!', 'status' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Usermanagement  $usermanagement
     * @return \Illuminate\Http\Response
     */
    public function show(Usermanagement $usermanagement)
    {
        return view('usermanagement.show', ['usermanagement' => $usermanagement]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Usermanagement  $usermanagement
     * @return \Illuminate\Http\Response
     */
    public function edit(Usermanagement $usermanagement)
    {
        return view('usermanagement.edit', ['usermanagement' => $usermanagement]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Usermanagement  $usermanagement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Usermanagement $usermanagement)
    {
        $imageName = '';
        if ($request->hasFile('file')) {
          $imageName = time() . '.' . $request->file->extension();
          $request->file->storeAs('public/images', $imageName);
          if ($usermanagement->image) {
            Storage::delete('public/images/' . $usermanagement->image);
          }
        } else {
          $imageName = $usermanagement->image;
        }

        $usermanagementData = ['name' => $request->name, 'age' => $request->age, 'image' => $imageName];

        $usermanagement->update($usermanagementData);
        return redirect('/usermanagement')->with(['message' => 'User updated successfully!', 'status' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Usermanagement  $usermanagement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Usermanagement $usermanagement)
    {
        Storage::delete('public/images/' . $usermanagement->image);
        $usermanagement->delete();
        return redirect('/usermanagement')->with(['message' => 'User deleted successfully!', 'status' => 'info']);
    }
}
