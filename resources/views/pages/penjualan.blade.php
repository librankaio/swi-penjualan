@extends('layouts.main')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Penjualan</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Penjualan</a></div>
            <div class="breadcrumb-item"><a class="text-muted">Penjualan / Pemesanan</a></div>
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
                        <h4>Penjualan / Pemesanan</h4>
                    </div>
                    <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>No Bon</label>
                                        <input type="text" class="form-control" name="no_bon" id="no_bon">
                                    </div>
                                    <div class="form-group">
                                        <label>Tanggal Bon</label>
                                        <input type="date" class="form-control" name="tgl_bon" value="{{ date("Y-m-d") }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Jenis</label>
                                        <input type="text" class="form-control" name="jenis" id="jenis">
                                    </div>
                                    <div class="form-group">
                                        <label>Pengiriman</label>
                                        <select class="form-control select2" name="pengiriman" id="pengiriman">
                                            <option disabled selected>--Select Pengiriman--</option>
                                            <option>Ojek Online</option>
                                            <option>Pickup</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Pemesan</label>
                                        <select class="form-control select2" name="pemesan" id="pemesan">
                                            <option disabled selected>--Select Pemesan--</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input type="text" class="form-control" name="nama" id="nama">
                                    </div>
                                    <div class="form-group">
                                        <label>No HP</label>
                                        <input type="text" class="form-control" name="hp" id="hp">
                                    </div>
                                    <div class="form-group">
                                        <label>Alamat Pengiriman</label>
                                        <textarea class="form-control" style="height:100px" name="alamat"></textarea>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="card-footer text-right">                            
                            <button class="btn btn-primary mr-1" type="submit" 
                            formaction="#" id="confirm">Save</button>                                
                            <button class="btn btn-secondary" type="reset">Cancel</button>
                    </div>
                </div>
            </div>           
        </div>
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="datatable">
                                <thead>
                                    <tr>
                                        <th scope="col" class="border border-5" style="text-align: center;">No</th>
                                        <th scope="col" class="border border-5" style="text-align: center;">Nama</th>
                                        <th scope="col" class="border border-5" style="text-align: center;">Qty</th>
                                        <th scope="col" class="border border-5" style="text-align: center;">Harga</th>
                                        <th scope="col" class="border border-5" style="text-align: center;">Total</th>
                                        <th scope="col" class="border border-5" style="text-align: center;">Action</th>
                                    </tr>
                                </thead>
                                {{-- <tbody>
                                    @php $counter = 0 @endphp
                                    @foreach($datas as $data => $item)
                                    @php $counter++ @endphp
                                    <tr>
                                        <th scope="row" class="border border-5" style="text-align: center;">{{ $counter }}</th>
                                        <td class="border border-5" style="text-align: center;">{{ $item->code }}</td>
                                        <td class="border border-5" style="text-align: center;">{{ $item->name }}</td>
                                        <td style="text-align: center;" class="d-flex justify-content-center">
                                            <a href="/mwarna/{{ $item->id }}/edit"
                                                class="btn btn-icon icon-left btn-primary"><i class="far fa-edit">
                                                    Edit</i></a>
                                            <form action="/mwarna/delete/{{ $item->id }}" id="del-{{ $item->id }}"
                                                method="POST" class="px-2">
                                                @csrf
                                                <button class="btn btn-icon icon-left btn-danger"
                                                    id="del-{{ $item->id }}" type="submit"
                                                    data-confirm="WARNING!|Do you want to delete {{ $item->name }} data?"
                                                    data-confirm-yes="submitDel({{ $item->id }})"><i
                                                        class="fa fa-trash">
                                                        Delete</i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody> --}}
                            </table>
                        </div>
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
        kode = $("#kode").val();
        nama = $("#nama").val();
        if (kode == ""){
            swal('WARNING', 'Kode Tidak boleh kosong!', 'warning');
            return false;
        }else if (nama == ""){
            swal('WARNING', 'Nama Tidak boleh kosong!', 'warning');
            return false;
        }
    });
</script>
@endsection