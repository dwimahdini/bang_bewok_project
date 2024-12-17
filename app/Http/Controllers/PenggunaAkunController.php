<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PenggunaAkunController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('penggunaakun', compact('users'));
    }
}
