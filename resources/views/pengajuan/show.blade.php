@extends('vendor.backpack.base.layout')

@section('content')
<div class="container-fluid spark-screen">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                <li class="breadcrumb-item" aria-current="page"><a href="{{ route('pengajuan.index') }}">Pengajuan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail Pengajuan Pada Kelompok Pengaduan GA{{ $penanganan->duplikats->id }}</li>
            </ol>
        </nav>
        <div class="box box-solid box-primary">
            <div class="box-header with-border">
                <h2 class="panel-title">{{ __('Pengajuan') }}</h2>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                            <i class="fa fa-times"></i></button>
                        </div>
                    </div>

                    <div class="box-body">
                    
                        <div class="table-responsive">
                         <table id="example" class="table table-condensed table-striped">
                            <thead>
                                <tr><th>No</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($penanganan->pengajuans as $e)
                                <tr>
                                        <td>{{ $e->id }}</td>
                                    {{-- <td>
                                        @if (isset($e->foto) && $e->foto)
                                            <img class="img-rounded img-thumbnail" style="width: 10rem; height: 10rem" src="{!!asset('img/'.$e->foto)!!}">
                                        @else
                                            Foto belum di upload
                                        @endif
                                    </td> --}}
                                    <td>{{ $e->created_at->format('d/m/Y H:i') }}</td>
                                    @include('pengajuan.status')
                                    <td>
                                        <a href="#" class="btn btn-primary btn-xs" data-toggle="modal" data-target={{ '#' . $e->id . '-modal' }}><span class=" glyphicon glyphicon-eye-open" aria-hidden="true" data-toggle="tooltip" title="Lihat"></span></a>
                                        @include('pengajuan.modalView')
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr><th>No</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
