<?php

namespace App\Http\Controllers\Admin;

use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DriverController
{
    public function index()
    {
        $drivers = Driver::all();
        return view('admin.drivers.index', compact('drivers'));
    }

    // Show the form for creating a new resource
    public function create()
    {
        return view('admin.drivers.create');
    }

    // Store a newly created resource in storage
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Ensure the file is an image
            'phone' => 'required|string|unique:drivers,phone|max:255',
        ]);

        if ($request->hasFile('avatar')) {
            $validated['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        Driver::create($validated);

        return redirect()->route('admin.drivers.index')->with('success', 'Tài xế đã được tạo thành công');
    }

    // Display the specified resource
    public function show(Driver $driver)
    {
    }

    // Show the form for editing the specified resource
    public function edit(Driver $driver)
    {
        return view('admin.drivers.edit', compact('driver'));
    }

    // Update the specified resource in storage
    public function update(Request $request, Driver $driver)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'phone' => 'required|string|unique:drivers,phone,' . $driver->id . '|max:255',
        ]);

        if ($request->hasFile('avatar')) {
            if ($driver->avatar) {
                \Storage::disk('public')->delete($driver->avatar);
            }
            $validated['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $driver->update($validated);

        return redirect()->route('admin.drivers.index')->with('success', 'Tài xế đã được cập nhật thành công');
    }

    // Remove the specified resource from storage
    public function destroy(Driver $driver)
    {
        $driver->delete();
        return redirect()->route('admin.drivers.index')->with('success', 'Tài xế đã được xóa thành công');
    }
}
