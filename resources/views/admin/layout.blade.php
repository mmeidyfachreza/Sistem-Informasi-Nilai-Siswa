@extends('layouts.proyek')
@section('contents')
@yield('content')
<div>
    <p> </p>
</div>
@endsection
@if (Auth::user()->category_user->name=="admin")
@section('sidebar')
<div class="main-menu">
    <h5 class="sidenav-heading">Menu</h5>
    <ul id="side-main-menu" class="side-menu list-unstyled">
        {{-- <li><a href="{{route('guest.index')}}"> <i class="fa fa-home"></i>Home </a></li>
        <li><a href="{{route('siswa.index')}}"> <i class="fa fa-user-graduate"></i>Data Siswa </a></li>
        <li><a href="{{route('kesehatan.index')}}"> <i class="fa fa-notes-medical"></i>Data Kesehatan </a></li>
        <li><a href="{{route('imunisasi.index')}}"> <i class="fa fa-stethoscope"></i>Data Imunisasi </a></li>
        <li><a href="{{route('rekammedik.index')}}"> <i class="fa fa-book-medical"></i>Data Penjaringan Kesehatan Anak
            </a></li> --}}
        <li><a href="#Dropdown1" aria-expanded="false" data-toggle="collapse"> <i class="fas fa-envelope"></i>Master
            </a>
            <ul id="Dropdown1" class="collapse list-unstyled ">
                <li><a href="{{route('user.index')}}"><i class="far fa-envelope"></i>Pengguna</a></li>
                <li><a href="{{route('siswa.index')}}"><i class="far fa-envelope"></i>Siswa</a></li>
                <li><a href="{{route('user.index')}}"><i class="far fa-envelope"></i>Kelas Siswa</a></li>
                <li><a href="{{route('user.index')}}"><i class="far fa-envelope"></i>Kategori Pengguna</a></li>
                <li><a href="{{route('user.index')}}"><i class="far fa-envelope"></i>Kondisi Kesehatan</a></li>
                <li><a href="{{route('user.index')}}"><i class="far fa-envelope"></i>Hasil Kesehatan</a></li>
                <li><a href="{{route('user.index')}}"><i class="far fa-envelope"></i>Hasil Pengukuran</a></li>
            </ul>
        </li>
        {{-- <li><a href="#exampledropdownDropdown1" aria-expanded="false" data-toggle="collapse"> <i
                    class="fas fa-envelope"></i>Surat Rujukan </a>
            <ul id="exampledropdownDropdown1" class="collapse list-unstyled ">
                <li><a href="{{route('rujuk.index')}}"><i class="far fa-envelope"></i>Rujukan Kesehatan</a></li>
        <li><a href="{{route('rujukB.index')}}"><i class="far fa-envelope"></i>Rujukan Balik</a></li>
        <li><a href="{{route('rujukUKS.index')}}"><i class="far fa-envelope"></i>Rujukan UKS</a></li>
    </ul>
    </li>
    <li><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="fa fa-book"></i>Pojok
            Baca </a>
        <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
            <li><a href="{{route('modul.index')}}"><i class="fa fa-book"></i>Buku</a></li>
            <li><a href="{{route('katmodul.index')}}"><i class="fa fa-book"></i>Kategori Buku</a></li>
        </ul>
    </li>
    <li><a href="{{route('karkon.index')}}"> <i class="fas fa-table"></i>Kartu Kontrol </a></li>
    <li><a href="{{route('user.index')}}"> <i class="fa fa-users"></i>Pengguna </a></li> --}}

    {{-- <li> <a href="#"> <i class="icon-mail"></i>Demo
              <div class="badge badge-warning">6 New</div></a>
        </li> --}}
    </ul>
</div>

@endsection
@else
@section('sidebar')
<div class="main-menu">
    <h5 class="sidenav-heading">Main</h5>
    <ul id="side-main-menu" class="side-menu list-unstyled">
        <li><a href="{{route('guest.index')}}"> <i class="fa fa-home"></i>Home </a></li>
        @if (Auth::user())
        @if (Auth::user()->status=="ADMIN"||Auth::user()->status=="GURU"||Auth::user()->status=="UMUM")
        <li><a href="{{route('rekammedik.index')}}"> <i class="fa fa-book-medical"></i>Data Penjaringan Kesehatan Anak
            </a></li>
        @endif
        @endif
        <li><a href="{{route('guest.pojokbaca')}}"> <i class="fa fa-book"></i>Pojok Baca </a></li>
    </ul>
</div>

@endsection
@section('script')

@endsection
@endif
