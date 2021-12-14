<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EdulevelController extends Controller
{
    public function data()
    {
        $edulevels = DB::table('edulevels')->get();

        // return $edulevels; // CARA 1
        // return view('edulevel.data', ['edulevels' => $edulevels]); // CARA 2
        return view('edulevel.data', compact('edulevels')); // CARA 3
        // return view('edulevel.data')->with('edulevels', $edulevels); // CARA 4

        // dd($edulevels); // Untuk Mengecek
    }

    public function add()
    {
        return view('edulevel.add');
    }

    public function addProcess(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|min:2',
                'desc' => 'required',
            ],

            [
                'name.required' => 'Nama Jenjang Tidak Boleh Kosong!'
            ]
        );

        DB::table('edulevels')->insert(
            [
                'name' => $request -> name,
                'desc' => $request -> desc
            ]
        );
        return redirect('edulevels')->with('status', 'Jenjang Berhasil Ditambah!'); // Alert
    }

    public function edit($id)
    {
        $edulevels = DB::table('edulevels')->where('id', $id)->first();
        return view('edulevel/edit', compact('edulevels'));

        // dd($jenjang); // Untuk Mengecek
    }

    public function editProcess(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:2',
            'desc' => 'required',
        ]);

        DB::table('edulevels')->where('id', $id)->update(
            [
            'name' => $request -> name,
            'desc' => $request -> desc
        ]);
        return redirect('edulevels')->with('status', 'Jenjang Berhasil Ditambah!'); // Alert
    }

    public function delete($id)
    {
        DB::table('edulevels')->where('id', $id)->delete();
        return redirect('edulevels')->with('status', 'Jenjang Berhasil Dihapus!'); // Alert
    }
}
