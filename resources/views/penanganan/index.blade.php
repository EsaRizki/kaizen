@extends('vendor.backpack.base.layout')

@section('content')
<div class="container-fluid spark-screen">
    <div class="row justify-content-center">
        <div class="col-md-10 col-md-offset-1">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Daftar Penanganan</li>
            </ol>
        </nav> 
        <div class="box box-default">
            <div class="box-header with-border">
                <h2 class="panel-title">{{ __('Penanganan') }}</h2>
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
                                <tr>
                                    <td>Petugas</td>
                                    <td>Pelapor</td>
                                    <td>Nama Ruangan</td>
                                    <td>Lampiran</td>
                                    <td>Status</td>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($penanganan as $log)
                                @if ($log->users->id == Auth::id())
                                <tr>
                                    <td>{{ $log->users['name'] }}</td>
                                    <td>{{ $log->duplikats->pengaduans->first()->users->name }}</td>
                                    <td>{{ $log->duplikats->pengaduans->first()->tempats->nama }}</td>
                                    <td><a href="{{ route('lampiran.unduh', $log->id) }}" class="btn btn-primary btn-sm glyphicon glyphicon-save">Unduh</a></td>
{{-- Status --}}
                                    @if(App\Pengajuan::where('penanganan_id',$log->id)->first() != null && !isset(App\Pengajuan::where('penanganan_id',$log->id)->orderBy('created_at', 'desc')->first()->status))
                                        <td>Menunggu konfirmasi
                                        </td> 
                                    @endif


                                    @if(isset(App\Pengajuan::where('penanganan_id',$log->id)->orderBy('created_at', 'desc')->first()->status) && App\Pengajuan::where('penanganan_id',$log->id)->orderBy('created_at', 'desc')->first()->status->status == 0)
                                        <td>Ditolak</td>
                                    @endif


                                    @if(isset(App\Pengajuan::where('penanganan_id',$log->id)->orderBy('created_at', 'desc')->first()->status) && App\Pengajuan::where('penanganan_id',$log->id)->orderBy('created_at', 'desc')->first()->status->status == 1 && is_null(App\Pengajuan::where('penanganan_id',$log->id)->orderBy('created_at', 'desc')->first()->status->orderBy('created_at', 'desc')->first()->penilaian))
                                        <td>Diterima</td>
                                    @endif

                                    @if(isset(App\Pengajuan::where('penanganan_id',$log->id)->orderBy('created_at', 'desc')->first()->status) && App\Pengajuan::where('penanganan_id',$log->id)->orderBy('created_at', 'desc')->first()->status->status == 1 && !is_null(App\Pengajuan::where('penanganan_id',$log->id)->orderBy('created_at', 'desc')->first()->status->orderBy('created_at', 'desc')->first()->penilaian))
                                        <td>Dinilai</td>
                                    @endif

{{-- Action  --}}
                                    @if(App\Pengajuan::where('penanganan_id',$log->id)->first() == null)
                                        <td>
                                            <a class="btn btn-primary" href="{{ route('penanganan.post_id', $log->id) }}">Ajukan</a>
                                        </td>
                                    @endif

                                    @if(App\Pengajuan::where('penanganan_id',$log->id)->first() != null && !isset(App\Pengajuan::where('penanganan_id',$log->id)->orderBy('created_at', 'desc')->first()->status))
                                        <td>
                                            <a class="btn btn-primary disabled">Ajukan</a>
                                        </td> 
                                    @endif

                                    @if(isset(App\Pengajuan::where('penanganan_id',$log->id)->orderBy('created_at', 'desc')->first()->status) && App\Pengajuan::where('penanganan_id',$log->id)->orderBy('created_at', 'desc')->first()->status->status == 0)
                                        <td><a class="btn btn-primary" href="{{ route('penanganan.post_id', $log->id) }}">Ajukan</a></td>
                                    @endif
                                    
                                    @if(isset(App\Pengajuan::where('penanganan_id',$log->id)->orderBy('created_at', 'desc')->first()->status) && App\Pengajuan::where('penanganan_id',$log->id)->orderBy('created_at', 'desc')->first()->status->status == 1)
                                        <td><a class="btn btn-primary disabled">Ajukan</a></td>
                                    @endif
                                    
                                </tr>    
                                @endif
                                @empty
                                <tr>
                                    <td colspan="2">Tidak ada data</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                        {{ $penanganan->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
