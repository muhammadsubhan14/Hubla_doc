@extends('layouts.admin')
@section('content')
    <div class="mb-[35px]">
        <p class="mb-[17px] font-mono text-[10px] uppercase tracking-[.13em] text-[#89958e]">Arsip baru</p>
        <h1 class="m-0 text-[40px] font-bold tracking-[-.06em] max-md:text-[30px]">Tambah dokumentasi</h1>
    </div>@include('admin.documentations.form', ['documentation' => null])
@endsection
