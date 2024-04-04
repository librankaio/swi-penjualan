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
                                        <label>Pengiriman</label>
                                        <select class="form-control select2" name="pengiriman" id="pengiriman">
                                            <option disabled selected>--Select Pengiriman--</option>
                                            <option>Ojek Online</option>
                                            <option>Pickup</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>No HP</label>
                                        <input type="text" class="form-control" name="hp" id="hp">
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
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card" style="border: 1px solid lightblue">
                    <div class="card-header">
                        <h4>Add Items</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama Barang</label>
                                    <select class="form-control select2" id="nama_brg">
                                        <option disabled selected>--Select Barang--</option>
                                        @foreach($barangs as $data => $item)                                        
                                        <option>{{ $item->nama_brg }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Harga Jual</label>
                                    <input type="text" class="form-control" id="hrg_jual" disabled>
                                </div>
                                <div class="form-group">
                                    <a href="" id="addItem">
                                        <i class="fa fa-plus" style="font-size:18pt"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6">                                
                                <div class="form-group">
                                    <label>Satuan</label>
                                    <input type="text" class="form-control" id="satuan" disabled>
                                </div>                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="form-group">
                                <input type="text" class="form-control" id="number_counter" value="0" hidden readonly>
                            </div>
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
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-12 col-md-12 col-lg-12 d-flex justify-content-end">
                            <div class="row px-2">
                                <div class="col-md-12">
                                   <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Total</label>
                                                <input type="text" class="form-control" name="total" form="thisform" id="total" value="0" readonly>
                                            </div>
                                        </div>
                                   </div>
                                </div>
                            </div>
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

    //CSRF TOKEN
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function() {  
            rowCount = $('#number_counter').val();
            $("#nama_brg").on('select2:select', function(e) {
                var nama_brg = $(this).val();
                console.log(nama_brg);
                show_loading()
                $.ajax({
                    url: '{{ route('getproduk') }}', 
                    method: 'post', 
                    data: {'nama_brg': nama_brg}, 
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, 
                    dataType: 'json', 
                    success: function(response) {
                        // console.log(nama_brg);
                        console.log(response);
                        for (i=0; i < response.length; i++) {
                            if(response[i].nama_brg == nama_brg){
                                $("#satuan").val(response[i].satuan);
                                $("#hrg_jual").val(Number(response[i].hrgjual).toFixed(0));
                            }
                        }
                        hide_loading()
                    }
                });
            });

            $(document).on("click", "#addItem", function(e) {
                e.preventDefault();
                if($('#quantity').val() == 0){
                    alert('Quantity tidak boleh 0');
                    return false;
                }

                nama_brg = $("#select2-nama_brg-container").text();
                hrg_jual = $("#hrg_jual").val();
                satuan = $("#satuan").val();
                total = $("#total").val();
                counter = rowCount;
                
                if(counter == 1){
                    if (/\D/g.test(hrg_jual))
                    {
                        // Filter comma
                        hrg_jual = hrg_jual.replace(/\,/g,"");
                        hrg_jual = Number(Math.trunc(hrg_jual))
                    }
                    
                    total_old = $('#total').val();
                    if (/\D/g.test(total_old))
                    {
                        // Filter comma
                        total_old = total_old.replace(/\,/g,"");
                        total_old = Number(Math.trunc(total_old))
                    }
                    
                    total = Number(hrg_jual) + Number(total_old)
                    
                    rowCount++;

                    $("#total").val(total);

                }else{
                    if (/\D/g.test(hrg_jual))
                    {
                        // Filter comma
                        hrg_jual = hrg_jual.replace(/\,/g,"");
                        hrg_jual = Number(Math.trunc(hrg_jual))
                    }
                    sum = Number(hrg_jual) + Number(total);
                    
                    $("#total").val(sum);
                    rowCount++;
                }

                tablerow = "<tr><th style='readonly:true;' class='border border-5'>" + rowCount + "</th><td class='border border-5'><input style='width:120px;' readonly form='thisform' class='namabrgclass form-control' name='nama_brg_d[]' type='text' value='" + nama_brg + "'></td><td class='border border-5'><input style='width:120px;' readonly form='thisform' class='hrgjualclass form-control' name='hrgjual_d[]' type='text' value='" + hrg_jual + "'></td><td class='border border-5'><input style='width:120px;' readonly form='thisform' class='satuanclass form-control' name='satuan_d[]' type='text' value='" + satuan + "'></td><td class='border border-5'><input style='width:120px;' readonly form='thisform' class='hrgjualclass form-control' name='hrgjual_d[]' type='text' value='" + hrg_jual + "'></td><td class='border border-5'><a title='Delete' class='delete'><i style='font-size:15pt;color:#6777ef;' class='fa fa-trash'></i></a></td></tr>";
                
                $("#datatable tbody").append(tablerow);

                console.log(rowCount);
                $('#number_counter').val(rowCount);

                $("#nama_brg").prop('selectedIndex', 0).trigger('change');
                $("#hrg_jual").val(0);
                $("#satuan").val('');
            });
        });
</script>
@endsection