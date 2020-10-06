@extends('layouts.layout')


@section('sidebar')
<div class="main-menu">
    <h5 class="sidenav-heading">Main</h5>
    <ul id="side-main-menu" class="side-menu list-unstyled">
        <li><a href="{{route('index.raport.siswa')}}"> <i class="fas fa-home"></i>Raport </a></li>
        <li><a href="{{route('akun.siswa.show',Auth::user()->id)}}"> <i class="fas fa-user"></i>Akun </a></li>
        {{-- <li><a href="{{route('nilai-akademik.index')}}"> <i class="fas fa-home"></i>Nilai Akademik </a></li> --}}
    </ul>
</div>
@endsection

