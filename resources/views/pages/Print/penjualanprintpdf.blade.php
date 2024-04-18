<html>
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <style>
    @page {
      /* size: 76mm 296mm; */
      margin: 8px;
      break-inside: avoid;
      /* margin-top: 5px auto; */
    }
    @font-face {
        font-family: 'Open Sans';
        src: url({{ storage_path("fonts/static/OpenSans/OpenSans-Bold.ttf") }}) format("truetype");
        font-weight: 700;
        font-style: normal;
    }
    
    @font-face {
        font-family: 'Open Sans';
        src: url({{ storage_path("fonts/static/OpenSans/OpenSans-BoldItalic.ttf") }}) format("truetype");
        font-weight: 700;
        font-style: italic;
    }
    
    @font-face {
        font-family: 'Open Sans';
        src: url({{ storage_path("fonts/static/OpenSans/OpenSans-ExtraBold.ttf") }}) format("truetype");
        font-weight: 800;
        font-style: normal;
    }
    
    @font-face {
        font-family: 'Open Sans';
        src: url({{ storage_path("fonts/static/OpenSans/OpenSans-ExtraBoldItalic.ttf") }}) format("truetype");
        font-weight: 800;
        font-style: italic;
    }
    
    @font-face {
        font-family: 'Open Sans';
        src: url({{ storage_path("fonts/static/OpenSans/OpenSans-Light.ttf") }}) format("truetype");
        font-weight: 300;
        font-style: normal;
    }
    
    @font-face {
        font-family: 'Open Sans';
        src: url({{ storage_path("fonts/static/OpenSans/OpenSans-LightItalic.ttf") }}) format("truetype");
        font-weight: 300;
        font-style: italic;
    }
    
    @font-face {
        font-family: 'Open Sans';
        src: url({{ storage_path("fonts/static/OpenSans/OpenSans-Medium.ttf") }}) format("truetype");
        font-weight: 500;
        font-style: normal;
    }
    
    @font-face {
        font-family: 'Open Sans';
        src: url({{ storage_path("fonts/static/OpenSans/OpenSans-MediumItalic.ttf") }}) format("truetype");
        font-weight: 500;
        font-style: italic;
    }
    
    @font-face {
        font-family: 'Open Sans';
        src: url({{ storage_path("fonts/static/OpenSans/OpenSans-Regular.ttf") }}) format("truetype");
        font-weight: 400;
        font-style: normal;
    }
    
    @font-face {
        font-family: 'Open Sans';
        src: url({{ storage_path("fonts/static/OpenSans/OpenSans-SemiBold.ttf") }}) format("truetype");
        font-weight: 600;
        font-style: normal;
    }
    
    @font-face {
        font-family: 'Open Sans';
        src: url({{ storage_path("fonts/static/OpenSans/OpenSans-SemiBoldItalic.ttf") }}) format("truetype");
        font-weight: 600;
        font-style: italic;
    }
    
    @font-face {
        font-family: 'Open Sans';
        src: url({{ storage_path("fonts/static/OpenSans/OpenSans-Italic.ttf") }}) format("truetype");
        font-weight: 400;
        font-style: italic;
    }
    .container{
      position: static;
      margin-left: 7px;
    }
    .split-para{ 
      display:block;
      /* margin:10px; */
      margin:0px;
    }
    /* .split-para span { 
      display:block; float:right ;width:50%; margin-left:10px; margin-right: 20px;
    } */
    .split-para span { 
      /* display:block; float:right; padding-right:7px; padding-top:2px; */
      display:block; float:right; padding-right:7px; padding-top:0px;
    }
    body {
        /* font-family: 'Roboto';font-size: 16px; */
        font-family: 'Open Sans', sans-serif;        
    }
    h1,h2,h3,h4,h5,h6 {
        font-family: 'Open Sans', sans-serif;
    }
    h1{
        font-size: 20px;
        word-wrap: break-word;
        white-space: normal;
        margin-top: 0;
        margin-bottom: 0;
    }
    h5{
        font-size: 15px;
    }
    h3{
        font-size: 17px;
    }
    p  
    { 
      word-wrap: break-word
    } 
  </style>
</head>
</html>
<body style="page-break-inside: avoid;">
  <center style="padding-top: 3px">
      <img src="{{'data:image/png;base64,'.base64_encode(file_get_contents(public_path('/assets/img/cherry.jpg')))}}" alt="barcode" width="200" id="bgimg"/>
      <h1 id="text_code">{{ strtoupper($penjualan->no_bon) }}</h1>
      {{-- <h5 style="margin-bottom: 0;">{{ $address->alamat }}</h5> --}}
      {{-- <h5 style="margin-bottom: 0;">{{ $tpenjualanh->no }}</h5> --}}
  </center>
  <hr style="border-style: dashed; size: 1px;">
  {{-- <div class="timezone" hidden>{{ date_default_timezone_set('Asia/Jakarta') }}</div> --}}
  <h5 class="split-para" style="margin: 0px auto; text-align:left;">PEMESAN : {{ $penjualan->pemesan }}</h5>
  <h5 class="split-para" style="margin: 0px auto; text-align:left;">PENERIMA : {{ $penjualan->nama }}</h5>
  <h5 class="split-para" style="margin: 0px auto; text-align:left;">NO HP : {{ $penjualan->phone }}</h5>
  <h5 class="split-para" style="margin: 0px auto; text-align:left;">ALAMAT PENERIMA : {{ $penjualan->alamat }}</h5>
  <hr style="border-style: dashed; size: 1px;">
  @php $counter = 0; @endphp
  @php $subtot = 0; @endphp
  @php $qty = 0; @endphp
  @php $disc = 0; @endphp
  @php $final_disc = 0; @endphp
  @for($i = 0; $i < sizeof($penjualands); $i++) @php $counter++; @endphp
  @php $counter++; @endphp
     <h5 style="margin: 0px auto; text-align:left;">{{ $penjualands[$i]->code." ".$penjualands[$i]->nama}}</h5>
     <h5 class="split-para" style="margin: 0px auto; text-align:left;">{{ number_format($penjualands[$i]->quantity, 0, '.', '')." Pcs x Rp.". number_format($penjualands[$i]->harga)}} <span><h5 style="margin: 0px auto; float:right;">{{ number_format($penjualands[$i]->total) }}</h5></span></h5>
  @endfor
  <hr style="border-style: dashed; size: 1px;">
  <h5 class="split-para" style="margin: 0px auto; text-align:left;">-<span><h5 style="margin: 0px auto; float:right;">TOTAL : RP.{{ number_format($penjualan->grandtot) }}</h5></span></h5>
  <hr style="border-style: dashed; size: 1px;">
  <center style="margin: 0px auto"><h5 style="margin: 0px auto">** Terima Kasih **</h5></center>
  {{-- <h5 class="split-para" style="margin: 0px auto; text-align:left;">** Terima Kasih **<span><h5 style="margin: 0px auto; float:right;"></h5></span></h5> --}}
  <hr style="border-style: dashed; size: 1px;">
  <h5 class="split-para" style="margin: 0px auto; text-align:left;">Instagram : atfashion.official<span><h5 style="margin: 0px auto; float:right;"></h5></span></h5>
  <h5 class="split-para" style="margin: 0px auto; text-align:left;">Facebook : officialbrandartfashion<span><h5 style="margin: 0px auto; float:right;"></h5></span></h5>
</body>