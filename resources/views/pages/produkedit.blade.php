@extends('layouts.main')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>Data Produk Edit</h1>
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
                                            <input type="text" class="form-control" name="nama_brg" id="nama_brg" value="{{ $produk->nama_brg }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Satuan</label>
                                            <input type="text" class="form-control" name="satuan" id="satuan" value="{{ $produk->satuan }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Harga Jual</label>
                                            <input type="text" class="form-control" name="harga" id="harga" value="{{ number_format($produk->hrgjual, 0, '.', ',') }}">
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="card-footer text-right">                            
                            <button class="btn btn-primary mr-1" type="submit" 
                            formaction="/produk/{{ $produk->id }}" id="confirm">Update</button>                                
                            <button class="btn btn-secondary" type="reset">Cancel</button>
                        </div>
                    </div>
                </form>
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

    $(document).on("click", "#harga", function(e) {
        if (/\D/g.test(this.value)){
        // Filter non-digits from input value.
        this.value = this.value.replace(/\D/g, '');
        }
    });

    $(document).on("change", "#harga", function(e) {
        if($('#harga').val() == ''){
            $('#harga').val(0);
        }
        $(this).val(thousands_separators($(this).val()));
    });

    $(document).on('focusout', '#harga', function(event) 
    {
        event.preventDefault();
        $(this).val(thousands_separators($(this).val()));
    })

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