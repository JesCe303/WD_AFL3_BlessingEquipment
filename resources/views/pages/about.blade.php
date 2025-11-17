@extends('layouts.master')

@section('content')
    <h1>Met dateng di halaman about</h1>
    <div class="card">
        <div class="card-body">
            selamat datang {{ $name }}, {{ $age }}, dari {{ $alamat }}
        </div>
    </div>
@endsection