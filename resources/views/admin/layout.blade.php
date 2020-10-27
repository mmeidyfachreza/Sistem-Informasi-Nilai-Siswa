@extends('layouts.layout')


@section('sidebar')
<div class="main-menu">
    <h5 class="sidenav-heading">Main</h5>
    <ul id="side-main-menu" class="side-menu list-unstyled">
        <li><a href="{{url('/admin')}}"> <i class="fas fa-home"></i>Beranda </a></li>
        <li><a href="{{route('nilai-akademik.index')}}"> <i class="fas fa-home"></i>Nilai Akademik </a></li>
        @if (Auth::user()->guru->kelas->first())
            <li><a href="{{route('raport.index')}}"><i class="far fa-envelope"></i>Raport</a>
            </li>
        @endif
        <li><a href="#letterDropdown" aria-expanded="false" data-toggle="collapse"> <i
            class="far fa-envelope"></i>Data Master </a>
            <ul id="letterDropdown" class="collapse list-unstyled ">
                <li><a href="{{route('siswa.index')}}"><i class="far fa-envelope"></i>Siswa</a>
                </li>
                <li><a href="{{route('guru.index')}}"><i class="far fa-envelope"></i>Guru</a>
                </li>
                <li><a href="{{route('jurusan.index')}}"><i class="far fa-envelope"></i>Jurusan</a>
                </li>
                <li><a href="{{route('kelas.index')}}"><i class="far fa-envelope"></i>Kelas</a>
                </li>
                <li><a href="{{route('matapelajaran.index')}}"><i class="far fa-envelope"></i>Mata Pelajaran</a>
                </li>
                <li><a href="{{route('ekskul.index')}}"><i class="far fa-envelope"></i>Ekskul</a>
                </li>
                <li><a href="{{route('pkl.index')}}"><i class="far fa-envelope"></i>PKL</a>
                </li>
            </ul>
        </li>
        <li><a href="{{route('akun.guru.show',Auth::user()->id)}}"> <i class="fas fa-user"></i>Akun </a></li>
        <li><a href="{{route('kepsek.show')}}"> <i class="fas fa-user"></i>Kepala Sekolah </a></li>
    </ul>
</div>
@endsection

