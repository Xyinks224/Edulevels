<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Edulevel;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Jika ingin memunculkan data tertentu menggunakan only (syarat dan ketentuan berlaku)
        // Jika ingin memunculkan semua data menggunakan with

        // Cara 1
        $programs = Program::all();

        // Cara 2 ( + pagination)
        // $programs = Program::with('edulevel')->simplepaginate(7); // #1
        // $programs = Program::with('edulevel')->simplePaginate(10); // #2
        // $programs = Program::with('edulevel')->simplepaginate(7); // #3

        // Softdelete (jika ingin memunculkan data yang dihapus sementara)
        // $programs = Program::withTrashed()->get();

        return view ('program/index', compact('programs'));

        // return $programs;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $edulevels = Edulevel::all();
        return view('program.create', compact('edulevels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|min:3',
                'edulevel_id' => 'required'
            ],

            [
                'edulevel_id.required' => 'Jenjang Tidak Boleh Kosong!',
                'name.required' => 'Nama Program Tidak Boleh Kosong!'
            ]
        );

        // dd($request);

        // Cara 1
        // Program = new Program;
        // $program -> name = $request->name;
        // $program -> edulevel_id = $request->edulevel_id;
        // $program -> student_price = $request->student_price;
        // $program -> student_max = $request->student_max;
        // $program -> info = $request->info;
        // $program -> save();

        // Cara 2
        // Program::create(
        //     [
        //         'name' => $request->name,
        //         'edulevel_id' => $request->edulevel_id,
        //         'student_price' => $request->student_price,
        //         'student_max' => $request->student_max,
        //         'info' => $request->info

        //     ]
        // );

        // Cara 3 (nama field dan nama table input harus sama)
        Program::create($request->all());

        // Cara 4
        // $program = new Program(
        //     [
        //         'name' => $request->name,
        //         'edulevel_id' => $request->edulevel_id,
        //         'student_price' => $request->student_price,
        //         'student_max' => $request->student_max,
        //         'info' => $request->info
        //     ]
        // );
        // $program -> student_price = $request->student_price;
        // $program->save();

        return redirect('programs')->with('status', 'Program Berhasil Ditambah!'); //Alert

        // return $request;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function show(Program $program) // $id / Program $program <- bisa menggunakan route model binding
    {
        // $program = Program::find($id); // CARA 1 (Jika Menggunakan $id)

        // $program = Program::where('id', $id)->get(); //CARA 2 (Menggunakan $id)
        // $program = $program[0];

        $program->makeHidden(['id', 'edulevel_id']); //Menghidden Field Tertentu (Melalui Controller)

        return view ('program/show', compact('program'));

        // return $program; // Untuk mengecek

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function edit(Program $program)
    {
        $edulevels = Edulevel::all();
        return view ('program/edit', compact('program', 'edulevels'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Program $program)
    {
        $request->validate(
            [
                'name' => 'required|min:3',
                'edulevel_id' => 'required'
            ],

            [
                'edulevel_id.required' => 'Jenjang Tidak Boleh Kosong!',
                'name.required' => 'Nama Program Tidak Boleh Kosong!'
            ]
        );

        // Cara 1 (Tidak perlu menggunakan ->find() karena sudah di find di atas)
        // $program -> name = $request->name;
        // $program -> edulevel_id = $request->edulevel_id;
        // $program -> student_price = $request->student_price;
        // $program -> student_max = $request->student_max;
        // $program -> info = $request->info;
        // $program -> save();

        // Cara 2
        Program::where('id', $program->id)
              ->update(
                    [
                        'name' => $request->name,
                        'edulevel_id' => $request->edulevel_id,
                        'student_price' => $request->student_price,
                        'student_max' => $request->student_max,
                        'info' => $request->info
                    ]);

        return redirect('programs')->with('status', 'Program Berhasil Diubah!'); //Alert

        // return $request;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function destroy(Program $program)
    {
        // Cara 1
        $program->delete();

        // Cara 2
        // Program::destroy($program->id);

        // Cara 3
        // Program::where('id', $program->id)->delete();

        return redirect('programs')->with('status', 'Program Berhasil Dihapus!'); //Alert
    }

    public function trash()
    {
        // Softdelete (jika ingin memunculkan data yang dihapus sementara)
        $programs = Program::onlyTrashed()->get();

        return view ('program/trash', compact('programs'));
    }

    public function restore($id = null)
    {
        if ($id != null)
        {
            $programs = Program::onlyTrashed()->where('id', $id)->restore();
        }

        else
        {
            $programs = Program::onlyTrashed()->restore();
        }

        return redirect('programs/trash')->with('status', 'Program Berhasil Dikembalikan!'); //Alert
    }

    public function delete($id = null)
    {
        if ($id != null)
        {
            $programs = Program::onlyTrashed()->where('id', $id)->forceDelete();
        }

        else
        {
            $programs = Program::onlyTrashed()->forceDelete();
        }

        return redirect('programs/trash')->with('status', 'Program Berhasil Dihapus Permanen!'); //Alert
    }
}
