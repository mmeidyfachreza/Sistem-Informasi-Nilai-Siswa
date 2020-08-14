@extends('layouts.layout')

@section('content')
<!-- Breadcrumb-->
<div class="breadcrumb-holder">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Siswa </li>
        </ul>
    </div>
</div>
<section>
    <div class="container-fluid">
        <!-- Page Header-->
        <header>
            <h1 class="h3 display">Detail Data Siswa</h1>
        </header>
        <div class="row">
            <div class="col-lg-4">
              <div class="card card-profile">
                <div class="card-body text-center"><img src="{{asset('/uploads/avatars/'.$student->avatar)}}" class="card-profile-img">
                </div>
                <div class="card-footer">
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Biodata</a>
                        {{-- <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Comming Soon!!!</a> --}}
                    </div>
                </div>
                
              </div>
            </div>
            
            <div class="col-lg-8">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                        <form class="card">
                            <div class="card-body">
                              <div class="table-responsive">
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <th class="pt-0 pb-0">Nama</th>
                                            <td class="pt-0 pb-0">{{$student->name ?? "Tidak Diketahui"}}</td>
                                        </tr>
                                        <tr>
                                            <th class="pt-0 pb-0">NIS</th>
                                            <td class="pt-0 pb-0">{{$student->nis ?? "Tidak Diketahui"}}</td>
                                        </tr>
                                        <tr>
                                            <th class="pt-0 pb-0">Tempat Lahir</th>
                                            <td class="pt-0 pb-0">{{$student->born_city ?? "Tidak Diketahui"}}</td>
                                        </tr>
                                        <tr>
                                            <th class="pt-0 pb-0">Tanggal Lahir</th>
                                            <td class="pt-0 pb-0">{{date("d-m-Y", strtotime($student->born_date))}}</td>
                                        </tr>
                                        <tr>
                                            <th class="pt-0 pb-0">Alamat</th>
                                            <td class="pt-0 pb-0">{{$student->address ?? "Tidak Diketahui"}}</td>
                                        </tr>
                                        <tr>
                                            <th class="pt-0 pb-0">Nama Ayah</th>
                                            <td class="pt-0 pb-0">{{$student->father_name ?? "Tidak Diketahui"}}</td>
                                        </tr>
                                        <tr>
                                            <th class="pt-0 pb-0">Nama Ibu</th>
                                            <td class="pt-0 pb-0">{{$student->mother_name ?? "Tidak Diketahui"}}</td>
                                        </tr>
                                        <tr>
                                            <th class="pt-0 pb-0">Nama Wali</th>
                                            <td class="pt-0 pb-0">{{$student->guardian ?? "Tidak Ada"}}</td>
                                        </tr>
                                        <tr>
                                            <th class="pt-0 pb-0">Jenis Kelamin </th>
                                            <td class="pt-0 pb-0">{{$student->gender}}</td>
                                        </tr>
                                        <tr>
                                            <th class="pt-0 pb-0">Golongan Darah</th>
                                            <td class="pt-0 pb-0">{{$student->blood_type ?? "Tidak Diketahui"}}</td>
                                        </tr>
                                        <tr>
                                            <th class="pt-0 pb-0">Asal Sekolah</th>
                                            <td class="pt-0 pb-0">{{$student->school_from ?? "Tidak Diketahui"}}</td>
                                        </tr>
                                        <tr>
                                            <th class="pt-0 pb-0">kelas</th>
                                            <td class="pt-0 pb-0">{{$student->classroom->name ?? "Tidak Diketahui"}}</td>
                                        </tr>
                                        <tr>
                                            <th class="pt-0 pb-0">No BPJS</th>
                                            <td class="pt-0 pb-0">{{$student->no_bpjs ?? "Tidak Diketahui"}}</td>
                                        </tr>
                                        <tr>
                                            <th class="pt-0 pb-0">Faskes BPJS</th>
                                            <td class="pt-0 pb-0">{{$student->faskes_bpjs ?? "Tidak Diketahui"}}</td>
                                        </tr>
                                        <tr>
                                            <th class="pt-0 pb-0">Umur Saat Ini</th>
                                            <td class="pt-0 pb-0">{{$age ?? ""}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                
                            </div>
                            <div class="card-footer">
                                <a href="{{route('siswa.index')}}" class="btn btn-primary">Kembali</a>
                            </div>
                            </div>
                            
                          </form>
                    </div>
                    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                        <div class="card">
                            <div class="card-body">
                              <h3 class="card-title">Edit Profile2</h3>
                              <p>sdada</p>
                            </div>
                            <div class="card-footer text-right">
                              <button type="submit" class="btn btn-primary">Update Profile</button>
                            </div>
                          </div>
                    </div>
                    
                </div>
              
            </div>
          </div>
        
    </div>
</section>
@endsection

@section('custom-script')
<script type="text/javascript">
    
</script>
@endsection