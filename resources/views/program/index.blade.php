@extends('main')

@section('title', 'Program')

@section('breadcrumbs')
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Program</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href=" {{ url('programs') }} ">Program</a></li>
                    <li class="active">Data</i></li>
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="content mt-3">
    <div class="animated fadeIn">

        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif

        <div class="card">
            <div class="card-header">
                <div class="pull-left">
                    <strong>Data Program</strong>
                </div>
                <div class="pull-right">
                    <a href=" {{ url('programs/create') }} " class="btn btn-success btn-sm">
                        <i class="fa fa-plus"></i> Add
                    </a>
                    <a href=" {{ url('programs/trash') }} " class="btn btn-trash btn-sm">
                        <i class="fa fa-trash"></i> Trash
                    </a>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Program</th>
                            <th>Jenjang</th>
                            {{-- <th>Info</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @if ($programs -> count() > 0) --}}
                        @foreach ($programs as $item)
                            <tr>
                                <td> {{ $loop -> iteration }} </td>
                                <td> {{ $item -> name }} </td>
                                <td> {{ $item -> edulevel -> name }} </td>
                                {{-- <td> {{ $item -> info }} </td> --}}
                                <td class="text-center">
                                    <a href=" {{ url('programs/'.$item->id )}} " class="btn btn-warning btn-sm">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a href=" {{ url('programs/'.$item->id.'/edit')}} " class="btn btn-primary btn-sm">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <form action=" {{ url('programs/'. $item->id) }} " method="POST" class="d-inline" onsubmit="return confirm('Yakin Hapus Data?')">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        {{-- @else
                        <tr>
                            <td colspan="4" class="text-center"> Data Kosong! </td>
                        </tr>
                        @endif --}}
                        @endforeach
                    </tbody>
                </table>
                {{-- <div>
                    <div class="pull-left">
                        {{ $programs->links() }}
                    </div>
                    <div class="pull-right">
                        Showing
                        {{ $programs->firstItem() }}
                        {{ $programs->lastItem() }}
                        off
                        {{ $programs->total() }}
                        entries
                    </div>
                </div> --}}
            </div>
        </div>
    </div><!-- .animated -->
</div><!-- .content -->
@endsection
