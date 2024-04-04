@extends('layouts.main')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Data Produk</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Data Produk</a></div>
            <div class="breadcrumb-item"><a class="text-muted">Data Produk / Pemesan</a></div>
        </div>
    </div>
    @php
        // $mbank_save = session('mbank_save');
        // $mbank_updt = session('mbank_updt');
        // $mbank_dlt = session('mbank_dlt');
    @endphp
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                @include('layouts.flash-message')
            </div>
        </div>
        <div class="row">        
            <div class="col-12 col-md-6 col-lg-6">
                <form action="" method="POST">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h4>Data Barang / Produk</h4>
                        </div>
                        <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nama Barang</label>
                                            <input type="text" class="form-control" name="nama_brg" id="nama_brg">
                                        </div>
                                        <div class="form-group">
                                            <label>Satuan</label>
                                            <input type="text" class="form-control" name="satuan" id="satuan">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Harga Jual</label>
                                            <input type="text" class="form-control" name="harga" id="harga">
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="card-footer text-right">                            
                            <button class="btn btn-primary mr-1" type="submit" 
                            formaction="{{ route('produkpost') }}" id="confirm">Save</button>                                
                            <button class="btn btn-secondary" type="reset">Cancel</button>
                        </div>
                    </div>
                </form>
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
                                        <th scope="col" class="border border-5" style="text-align: center;">Nama Barang</th>
                                        <th scope="col" class="border border-5" style="text-align: center;">Harga</th>
                                        <th scope="col" class="border border-5" style="text-align: center;">Satuan</th>
                                        <th scope="col" class="border border-5" style="text-align: center;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $counter = 0 @endphp
                                    @foreach($datas as $data => $item)
                                    @php $counter++ @endphp
                                    <tr>
                                        <th scope="row" class="border border-5" style="text-align: center;">{{ $counter }}</th>
                                        <td class="border border-5" style="text-align: center;">{{ $item->nama_brg }}</td>
                                        <td class="border border-5" style="text-align: center;">{{ number_format($item->hrgjual, 2, '.', ',') }}</td>
                                        <td class="border border-5" style="text-align: center;">{{ $item->satuan }}</td>
                                        <td style="text-align: center;" class="d-flex justify-content-center">
                                            <a href="/produk/{{ $item->id }}/edit"
                                                class="btn btn-icon icon-left btn-primary"><i class="far fa-edit">
                                                    Edit</i></a>
                                            <form action="/produk/delete/{{ $item->id }}" id="del-{{ $item->id }}"
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
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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

    // VALIDATE TRIGGER
    $("#harga").keyup(function(e){
        if (/\D/g.test(this.value)){
            // Filter non-digits from input value.
            this.value = this.value.replace(/\D/g, '');
        }
    });
    function submitDel(id){
        $('#del-'+id).submit()
    }
    $(document).on("click","#confirm",function(e){
        // Validate ifnull
        nama_brg = $("#nama_brg").val();
        satuan = $("#satuan").val();
        harga = $("#harga").val();
        if (nama_brg == ""){
            swal('WARNING', 'Nama Barang Tidak boleh kosong!', 'warning');
            return false;
        }else if (satuan == ""){
            swal('WARNING', 'Satuan Tidak boleh kosong!', 'warning');
            return false;
        }else if (harga == ""){
            swal('WARNING', 'Harga Tidak boleh kosong!', 'warning');
            return false;
        }
    });
</script>
@endsection