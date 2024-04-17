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
    <form action="" method="POST" id="thisform">
        @csrf
            <div class="section-body">
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
                                                <input type="text" readonly class="form-control" name="no_bon" id="no_bon" value="{{ $penjualan->no_bon }}" >
                                            </div>
                                            <div class="form-group">
                                                <label>Tanggal Bon</label>
                                                <input type="date" class="form-control" name="tgl_bon" value="{{ date("Y-m-d", strtotime($penjualan->tgl_bon)) }}">
                                            </div>
                                            <div class="form-group">
                                                <label>Pengiriman</label>
                                                <select class="form-control select2" name="pengiriman" id="pengiriman">
                                                    <option selected>{{ $penjualan->pengiriman }}</option>
                                                    <option>Ojek Online</option>
                                                    <option>Pickup</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>No HP</label>
                                                <input type="text" class="form-control" name="hp" id="hp" value="{{ $penjualan->phone }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Pemesan</label>
                                                <select class="form-control select2" name="pemesan" id="pemesan">
                                                    <option selected>{{ $penjualan->pemesan }}</option>
                                                    @foreach($customers as $data => $item)                                        
                                                    <option>{{ $item->nama_penerima }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Nama</label>
                                                <input type="text" class="form-control" name="nama" id="nama" value="{{ $penjualan->nama }}">
                                            </div>
                                            <div class="form-group">
                                                <label>Alamat Pengiriman</label>
                                                <textarea class="form-control" style="height:100px" name="alamat" id="alamat">{{ $penjualan->alamat }}</textarea>
                                            </div>
                                        </div>
                                    </div>
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
                                    {{-- <div class="form-group">
                                        <input type="text" class="form-control" id="number_counter" value="0" hidden readonly>
                                    </div> --}}
                                    <table class="table table-bordered" id="datatable">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="border border-5" style="text-align: center;">No</th>
                                                <th scope="col" class="border border-5" style="text-align: center;">Nama</th>
                                                <th scope="col" class="border border-5" style="text-align: center;">Qty</th>
                                                <th scope="col" class="border border-5" style="text-align: center;">Satuan</th>
                                                <th scope="col" class="border border-5" style="text-align: center;">Harga</th>
                                                <th scope="col" class="border border-5" style="text-align: center;">Total</th>
                                                <th scope="col" class="border border-5" style="text-align: center;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $counter = 0; @endphp
                                            @for($i = 0; $i < sizeof($penjualands); $i++) 
                                            @php $counter++; @endphp 
                                            <tr row_id="{{ $counter }}">
                                                <th class='id-header border border-5' style='readonly:true;' headers="{{ $counter }}">{{ $counter }}</th>
                                                <td class='border border-5'><input style='width:120px;' readonly form='thisform' class='namabrgclass form-control' name='nama_brg_d[]' type='text' value='{{ $penjualands[$i]->nama }}'></td>
                                                <td class='border border-5'><input style='width:120px;' form='thisform' class='row_qty qtyclass form-control' name='qty_d[]' id='qty_d_{{ $counter }}' type='text' value='{{ number_format($penjualands[$i]->quantity, 0, '.', '') }}'></td>
                                                <td class='border border-5'><input style='width:120px;' readonly form='thisform' class='satuanclass form-control' name='satuan_d[]' type='text' value='{{ $penjualands[$i]->satuan }}'></td>
                                                <td class='border border-5'><input style='width:120px;' readonly form='thisform' class='hrgjualclass form-control' name='hrgjual_d[]' id='hrgjual_d_{{ $counter }}' type='text' value='{{ number_format($penjualands[$i]->harga, 0, '.', ',') }}'></td>
                                                <td class='border border-5'><input style='width:120px;' readonly form='thisform' class='totalclass form-control' name='total_d[]' id='total_d_{{ $counter }}' type='text' value='{{ number_format($penjualands[$i]->total, 0, '.', ',') }}'></td>
                                                <td class="border border-5"><button title='Delete' class='delete btn btn-primary' value="{{ $counter }}"><i style='font-size:15pt;color:#ffff;' class='fa fa-trash'></i></button></td>
                                                <td class="border border-5" hidden><input style='width:120px;' readonly form='thisform' class='idclass form-control' name='id_d[]' type='text' value='{{ $penjualands[$i]->id }}' id="tbl_detail_id_{{ $counter }}"></td>
                                                <td class="border border-5" hidden><input style='width:120px;' readonly form='thisform' class='delclass form-control' name='deleted_item_d[]' type='text' value='' id="deleted_d_{{ $counter }}"></td>
                                                <td class="border border-5" hidden><input style='width:120px;' readonly form='thisform' class='existdbclass form-control' name='existdb_d[]' type='text' value='{{ $penjualands[$i]->id }}' id="existdb_{{ $counter }}"></td>
                                                </tr>
                                            @endfor
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
                                                        <input type="text" class="form-control" name="grandtot" id="grandtot" form="thisform" value="{{ number_format($penjualan->grandtot, 0, '.', ',') }}" readonly>
                                                    </div>
                                                </div>
                                           </div>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                            <div class="card-footer text-right">                            
                                <button class="btn btn-primary mr-1" type="submit" 
                                formaction="/penjualan/{{ $penjualan->id }}" id="confirm">Update</button>                                
                                <button class="btn btn-secondary" type="reset">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </form>
</section>
@stop
@section('pluginjs')
<script src="{{ asset('assets/js/page/bootstrap-modal.js') }}"></script>
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
        pemesan = $("#pemesan").prop('selectedIndex');
        nama = $("#nama").val();
        pengiriman = $("#pengiriman").prop('selectedIndex');
        alamat = $("#alamat").val();
        hp = $("#hp").val();
        if (nama == ""){
            swal('WARNING', 'Nama Tidak boleh kosong!', 'warning');
            return false;
        }else if (alamat == ""){
            swal('WARNING', 'Alamat Tidak boleh kosong!', 'warning');
            return false;
        }else if (hp == ""){
            swal('WARNING', 'Phone Tidak boleh kosong!', 'warning');
            return false;
        }
    });

    //CSRF TOKEN
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function() {  
            rowCount = $('#number_counter').val();
            counter = parseInt({{ $counter}}) +1;

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
                                // $("#hrg_jual").val(thousands_separators(response[i].hrgjual).toFixed(2));
                                hrgjual = Number(response[i].hrgjual);
                                $("#hrg_jual").val(thousands_separators(hrgjual.toFixed(0)));
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
                total = $("#grandtot").val();
                
                
                if (/\D/g.test(hrg_jual))
                {
                    // Filter comma
                    hrg_jual = hrg_jual.replace(/\,/g,"");
                    hrg_jual = Number(Math.trunc(hrg_jual))
                }

                if (/\D/g.test(total))
                {
                    // Filter comma
                    total = total.replace(/\,/g,"");
                    total = Number(Math.trunc(total))
                }

                sum = Number(hrg_jual) + Number(total);

                qty = 1;
                total = Number(hrg_jual) * qty;
                tablerow = "<tr row_id="+ counter +" id='row_"+counter+"'><th style='readonly:true;' class='border border-5'>" + counter + "</th><td class='border border-5' style='display:none;'><input style='width:120px;' readonly form='thisform' class='numberclass form-control' type='text' value='" + counter + "'></td><td class='border border-5'><input style='width:120px;' readonly form='thisform' class='namabrgclass form-control' name='nama_brg_d[]' type='text' value='" + nama_brg + "'></td><td class='border border-5'><input style='width:120px;' form='thisform' class='row_qty qtyclass form-control' name='qty_d[]' id='qty_d_"+ counter +"' type='text' value='" + qty + "'></td><td class='border border-5'><input style='width:120px;' readonly form='thisform' class='satuanclass form-control' name='satuan_d[]' type='text' value='" + satuan + "'></td><td class='border border-5'><input style='width:120px;' readonly form='thisform' class='hrgjualclass form-control' name='hrgjual_d[]' id='hrgjual_d_"+ counter +"' type='text' value='" + thousands_separators(hrg_jual.toFixed(0)) + "'></td><td class='border border-5'><input style='width:120px;' readonly form='thisform' class='totalclass form-control' name='total_d[]' id='total_d_"+ counter +"' type='text' value='" + thousands_separators(total.toFixed(0)) + "'></td><td class='border border-5'><a title='Delete' class='delete'><i style='font-size:15pt;color:#6777ef;' class='fa fa-trash'></i></a></td><td class='border border-5' hidden><input style='width:120px;' readonly form='thisform' class='idclass form-control' name='id_d[]' type='text' value='new_item' id='tbl_detail_id_"+counter+"'></td><td class='border border-5' hidden><input style='width:120px;' readonly form='thisform' class='delclass form-control' name='deleted_item_d[]' type='text' id='deleted_d_"+counter+"'></td></tr>";
                
                $("#grandtot").val(thousands_separators(sum.toFixed(0)));
                    rowCount++;
                $("#datatable tbody").append(tablerow);

                console.log(counter);
                $('#number_counter').val(counter);

                $("#nama_brg").prop('selectedIndex', 0).trigger('change');
                $("#hrg_jual").val(0);
                $("#satuan").val('');
            });

            // $(document).on("click", ".delete", function(e) {
            //     e.preventDefault();
            //     var r = confirm("Delete Transaksi ?");
            //     if (r == true) {
            //         counter_id = $(this).closest('tr').find('.numberclass').val();
            //         console.log("counter id : "+counter_id);

                    
            //         subtot = $("#total_d_"+ counter_id).val().replaceAll(",", "");
            //         qty_row = $("#qty_d_"+ counter_id).val();

            //         if (/\D/g.test(subtot))
            //         {
            //             // Filter comma
            //             subtot = subtot.replace(/\,/g,"");
            //             subtot = Number(Math.trunc(subtot))
            //         }

            //         old_grandtot = $("#grandtot").val();

            //         if (/\D/g.test(old_grandtot))
            //         {
            //             // Filter comma
            //             old_grandtot = old_grandtot.replace(/\,/g,"");
            //             old_grandtot = Number(Math.trunc(old_grandtot))
            //         }
            //         new_grantot = old_grandtot - subtot

            //         $("#grandtot").val(thousands_separators(new_grantot.toFixed(0)));
            //         $(this).closest('tr').remove();

            //         var table   = document.getElementById('datatable');
            //         for (var i = 1; i < table.rows.length; i++) 
            //         {
            //         var firstCol = table.rows[i].cells[0];
            //         firstCol.innerText = i;
            //         }
            //         rowCount--;
            //     } else {
            //         return false;
            //     }
            // });

            $(document).on("click", ".delete", function(e) {
                e.preventDefault();
                counter_id = $(this).val();
                deleted_stat = 0;
                var r = confirm("Delete Transaksi ?");
                if (r == true) {
                    if(counter_id != 0){
                        console.log(counter_id);

                        subtot = $("#total_d_"+ counter_id).val().replaceAll(",", "");
                        qty_row = $("#qty_d_"+ counter_id).val();

                        if (/\D/g.test(subtot))
                        {
                            // Filter comma
                            subtot = subtot.replace(/\,/g,"");
                            subtot = Number(Math.trunc(subtot))
                        }

                        old_grandtot = $("#grandtot").val();

                        if (/\D/g.test(old_grandtot))
                        {
                            // Filter comma
                            old_grandtot = old_grandtot.replace(/\,/g,"");
                            old_grandtot = Number(Math.trunc(old_grandtot))
                        }
                        new_grantot = old_grandtot - subtot

                        $("#grandtot").val(thousands_separators(new_grantot.toFixed(0)));

                        id_detail = $("#tbl_detail_id_"+counter_id).val()
                        $("#deleted_d_" + counter_id).val(id_detail);
                        $(this).closest('tr').hide();

                       $(this).closest('tr').wrap('<div/>');

                        var table   = document.getElementById('datatable');
                        for (var i = 1; i < table.rows.length; i++) 
                        {
                        var firstCol = table.rows[i].cells[0];
                        firstCol.innerText = i;
                        }
                        counter--;
                        // $(this).closest('tr').unwrap();

                        counter_id = 0;
                    }else{
                        // counter_id = $(this).closest('tr').text();
                        counter_id = $('td').find('.numberclass').val();
                        console.log(counter_id);
                        subtot = $("#total_d_"+ counter_id).val().replaceAll(",", "");
                        qty_row = $("#qty_d_"+ counter_id).val();

                        if (/\D/g.test(subtot))
                        {
                            // Filter comma
                            subtot = subtot.replace(/\,/g,"");
                            subtot = Number(Math.trunc(subtot))
                        }

                        old_grandtot = $("#grandtot").val();

                        if (/\D/g.test(old_grandtot))
                        {
                            // Filter comma
                            old_grandtot = old_grandtot.replace(/\,/g,"");
                            old_grandtot = Number(Math.trunc(old_grandtot))
                        }
                        new_grantot = old_grandtot - subtot

                        $("#grandtot").val(thousands_separators(new_grantot.toFixed(0)));

                        id_detail = $("#tbl_detail_id_"+counter_id).val()
                        $("#deleted_d_" + counter_id).val(id_detail);
                        $(this).closest('tr').remove();
                        
                        var table   = document.getElementById('datatable');
                        for (var i = 1; i < table.rows.length; i++) 
                        {
                        var firstCol = table.rows[i].cells[0];
                        firstCol.innerText = i;
                        }
                        counter--;
                    }  
                } else {
                    return false;
                }
            });

            $(document).on('keyup', '.row_qty', function(event) {
                event.preventDefault(); 
                if (/\D/g.test(this.value)){
                    // Filter non-digits from input value.
                    this.value = this.value.replace(/\D/g, '');
                }
            });

            $(document).on('focusout', '.row_qty', function(event) {
                event.preventDefault();

                console.log("focus out");
                // INITIAL VARIABLE
                var tbl_row = $(this).closest('tr');
                var row_id = tbl_row.attr('row_id');

                this_row_subtot = $('#total_d_'+row_id).val();
                if (/\D/g.test(this_row_subtot))
                {
                    // Filter comma
                    this_row_subtot = this_row_subtot.replace(/\,/g,"");
                    this_row_subtot = Number(Math.trunc(this_row_subtot))
                }

                old_subtot = this_row_subtot;
                this_row_qty = $(this).val();

                this_row_hrg = $('#hrgjual_d_'+row_id).val();
                if (/\D/g.test(this_row_hrg))
                {
                    // Filter comma
                    this_row_hrg = this_row_hrg.replace(/\,/g,"");
                    this_row_hrg = Number(Math.trunc(this_row_hrg))
                }
                 old_grandtot = $('#grandtot').val();
                if (/\D/g.test(old_grandtot))
                {
                    // Filter comma
                    old_grandtot = old_grandtot.replace(/\,/g,"");
                    old_grandtot = Number(Math.trunc(old_grandtot))
                }
                // INITIAL VARIABLE END

                this_row_sum = this_row_hrg * this_row_qty; 

                $('#total_d_'+row_id).val(thousands_separators(this_row_sum.toFixed(0)));
                
                normalize_grandtot = old_grandtot - old_subtot ;
                new_grandtot = this_row_sum + normalize_grandtot
                $('#grandtot').val(thousands_separators(new_grandtot.toFixed(0)))
            })	
        });
</script>
@endsection