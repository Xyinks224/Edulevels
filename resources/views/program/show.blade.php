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
                    <li><a href="# ">Program</a></li>
                    <li><a href=" {{ url('programs') }} ">Data</a></li>
                    <li class="active">Detail</i></li>
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
                    <strong>Detail Program</strong>
                </div>
                <div class="pull-right">
                    <a href=" {{ url('programs') }} " class="btn btn-secondary btn-sm">
                        <i class="fa fa-chevron-left"></i> Back
                    </a>
                </div>
            </div>
            <div class="card-body table-responsive">
                <div class="row">
                    <div class="col-md offset-md-2">
                        <table class="table table-bordered">
                            <body>
                                <tr>
                                    <th>Edulevel</th>
                                    <td> {{ $program->edulevel->name }} </td>
                                </tr>
                                <tr>
                                    <th>Program</th>
                                    <td> {{ $program->name }} </td>
                                </tr>
                                <tr>
                                    <th>Student Price</th>
                                    <td> {{ $program->student_price }} </td>
                                </tr>
                                <tr>
                                    <th>Student Max</th>
                                    <td> {{ $program->student_max }} </td>
                                </tr>
                                <tr>
                                    <th>Info</th>
                                    <td> {{ $program->info }} </td>
                                </tr>
                                <tr>
                                    <th>Create At</th>
                                    <td> {{ $program->created_at }} </td>
                                </tr>
                            </body>
                        </table>
                    </div>
                </div>
            </div>
    </div><!-- .animated -->
</div><!-- .content -->
@endsection
