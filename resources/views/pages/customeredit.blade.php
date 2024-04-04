@extends('layouts.main')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Data Customer Edit</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Data Customer</a></div>
            <div class="breadcrumb-item"><a class="text-muted">Data Customer / Pemesan</a></div>
        </div>
    </div>
    @php
        // $mbank_save = session('mbank_save');
        // $mbank_updt = session('mbank_updt');
        // $mbank_dlt = session('mbank_dlt');
    @endphp
    <div class="section-body">
    <form action="" method="POST">
        @csrf
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                @include('layouts.flash-message')
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Data Customer / Pemesan</h4>
                    </div>
                    <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama Pemesan</label>
                                        <input type="text" class="form-control" name="nama_pemesan" id="nama_pemesan" value="{{ $customer->nama_pemesan }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Penerima</label>
                                        <input type="text" class="form-control" name="nama_penerima" id="nama_penerima" value="{{ $customer->nama_penerima }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>No HP</label>
                                        <input type="text" class="form-control" name="hp" id="hp" value="{{ $customer->phone }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Alamat Pengiriman</label>
                                        <textarea class="form-control" style="height:100px" name="alamat">{{ $customer->alamat }}</textarea>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="card-footer text-right">                            
                            <button class="btn btn-primary mr-1" type="submit" 
                            formaction="/customer/{{ $customer->id }}" id="confirm">Update</button>                                
                            <button class="btn btn-secondary" type="reset">Cancel</button>
                    </div>
                </div>
            </div>            
        </div>
    </form>
    </div>
</section>
@stop
@section('botscripts')
<script type="text/javascript">
    $('#datatable').DataTable({
        // "ordering":false,
        "bInfo" : false
    });

    $(".alert button.close").click(function (e) {
        $(this).parent().fadeOut(2000);
    });

    function submitDel(id){
        $('#del-'+id).submit()
    }
    $(document).on("click","#confirm",function(e){
        // Validate ifnull
        nama_pemesan = $("#nama_pemesan").val();
        nama_penerima = $("#nama_penerima").val();
        hp = $("#hp").val();
        alamat = $("#alamat").val();
        if (nama == ""){
            swal('WARNING', 'Nama Pemesan Tidak boleh kosong!', 'warning');
            return false;
        }else if (nama_penerima == ""){
            swal('WARNING', 'Nama Penerima Tidak boleh kosong!', 'warning');
            return false;
        }else if (hp == ""){
            swal('WARNING', 'No HP Tidak boleh kosong!', 'warning');
            return false;
        }else if (alamat == ""){
            swal('WARNING', 'Alamat Tidak boleh kosong!', 'warning');
            return false;
        }
    });
</script>
@endsection