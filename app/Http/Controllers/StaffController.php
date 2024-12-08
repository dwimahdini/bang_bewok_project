<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffController extends Controller
{
    
    public function index()
{
    if (Auth::check() && Auth::user()->role !== 'admin') {
        return redirect('/')->with('error', 'Akses ditolak, hanya admin yang bisa mengakses halaman ini');
    }

    $staffs = Staff::all();
    return view('staf', ['staffs' => $staffs]);
}

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'notel' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'posisi' => 'required|string|max:255',
            'cabang' => 'required|string|max:255',
        ]);

        Staff::create($validatedData);

        return redirect()->route('staff.index')->with('success', 'Staf baru berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        $staff = Staff::findOrFail($id);
        $staff->delete();

        return redirect()->route('staff.index')->with('success', 'Staf berhasil dihapus.');
    }

    public function edit($id)
    {
        $staff = Staff::findOrFail($id);
        return response()->json($staff);
    }

    public function update(Request $request, $id)
    {
        $staff = Staff::findOrFail($id);

        // Validasi data
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'notel' => 'required|string|max:15',
            'email' => 'required|email|max:255|unique:staff,email,' . $id,
            'posisi' => 'required|in:staf,kepala cabang',
            'cabang' => 'nullable|in:cabang 1,cabang 2,cabang 3',
        ]);

        // Update data di database
        $staff->update($validatedData);

        return redirect()->route('staff.index')->with('success', 'Staf berhasil diperbarui.');
    }
}