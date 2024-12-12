<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\UserModel;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $data = [
            'user' => UserModel::all()
        ];

        return view('pages.user', $data);
    }

    public function tambahUser(UserRequest $request)
    {
        $data = $request->validated();
        UserModel::create($data);
        return redirect()->back()->with('success', 'Data berhasil ditambahkan.');
    }

    public function ubahUser(UserRequest $request)
    {
        $data = $request->validated();
        UserModel::where('id_user', $request->id_user)->update($data);
        return redirect()->back()->with('success', 'Data berhasil diubah.');
    }

    public function hapusUser(Request $request)
    {
        UserModel::where('id_user', $request->id_user)->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }
}
