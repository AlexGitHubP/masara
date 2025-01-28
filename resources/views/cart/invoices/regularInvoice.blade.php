<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>Nr. factură: E2I#NC#K2846</title>

<style type="text/css">
    * {
        font-family: DejaVu Sans;
    }
    table{
        font-size: x-small;
    }
    tfoot tr td{
        font-weight: bold;
        font-size: x-small;
    }
    .gray {
        background-color: lightgray
    }
    .w-100{
        width: 100%;
    }
    .w-50{
        width:50%;   
    }
    .w-85{
        width:85%;   
    }
    .w-15{
        width:15%;   
    }
    .m-0{
        margin: 0px;
    }
    .p-0{
        padding: 0px;
    }
    .pt-5{
        padding-top:5px;
    }
    .mt-10{
        margin-top:10px;
    }
    .gray-color{
        color:#5D5D5D;
    }
    .text-bold{
        font-weight: bold;
    }
    

    .bill-tbl table tr, .bill-tbl th, .bill-tbl td{
        border: 1px solid #d2d2d2;
        border-collapse:collapse;
        padding:7px 8px;
    }
    .bill-tbl table tr th{
        background: #F4F4F4;
        font-size:15px;
    }
    .bill-tbl table tr td{
        font-size:13px;
    }
    .bill-tbl table{
        border-collapse:collapse;
    } 
</style>

</head>
<body>

  <table width="100%">
    <tr>
        <td valign="top"><img src="{!! $shopDetails->brand_logo !!}" alt="" width="150"/></td>
        <td align="right">
            {{-- <h3>{{ $shopDetails->company_name }}</h3> --}}
            <strong>Nr. factură:</strong> E2I#NC#K2846<br/>
            <strong>ID comandă:</strong> E2I#NC#K2846<br/>
            <strong>Data emitere:</strong> {{$orderDetails['created_at']}}
        </td>
    </tr>

  </table>

  <div class="table-section bill-tbl w-100 mt-10">
    <table class="table w-100 mt-10">
        <tr>
            <th class="w-50">Furnizor</th>
            <th class="w-50">Cumpărător</th>
        </tr>
        <tr>
            <td>
                <div class="box-text">
                    <p><strong>Adresă: </strong>{{ $shopDetails->company_name }}</p>
                    <p><strong>CUI: </strong>{{ $shopDetails->company_cui }}</p>
                    <p><strong>Nr. registrul comerțului: </strong>{{ $shopDetails->company_registru_comert }}</p>
                    <p><strong>IBAN: </strong>{{ $shopDetails->company_iban }}</p>
                    <p><strong>Bancă: </strong>{{ $shopDetails->company_bank }}</p>
                </div>
            </td>
            <td>
                <div class="box-text">
                    <p><strong>Adresă: </strong>{{ $shopDetails->company_name }}</p>
                    <p><strong>CUI: </strong>{{ $shopDetails->company_cui }}</p>
                    <p><strong>Nr. registrul comerțului: </strong>{{ $shopDetails->company_registru_comert }}</p>
                    <p><strong>IBAN: </strong>{{ $shopDetails->company_iban }}</p>
                    <p><strong>Bancă: </strong>{{ $shopDetails->company_bank }}</p>
                </div>
            </td>
        </tr>
    </table>
</div>

  <br/>

  <table width="100%">
    <thead style="background-color: lightgray;">
      <tr>
        <th>#</th>
        <th>Produs</th>
        <th>Cantitate</th>
        <th>Preț unitar</th>
        <th>Total</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($cartInfos['cartItems'] as $key => $cartItem) 
        @php $key = $key + 1; @endphp
        <tr>
            <th scope="row">{{$key}}</th>
            <td align="left">{{$cartItem['name']}}</td>
            <td align="center">{{$cartItem['amount']}}</td>
            <td align="center">{{$cartItem['price']}}</td>
            <td align="center">{{$cartItem['price']}}</td>
        </tr>      
        @endforeach 
    </tbody>

    <tfoot>
        <tr>
            <td colspan="3"></td>
            <td align="right">Subtotal</td>
            <td align="right">{{$cartInfos['totalCart']['subtotal']}} RON</td>
        </tr>
        <tr>
            <td colspan="3"></td>
            <td align="right">Livrare</td>
            <td align="right">{{$cartInfos['totalCart']['deliveryFee']}} RON</td>
        </tr>
        <tr>
            <td colspan="3"></td>
            <td align="right">TVA</td>
            <td align="right">{{$cartInfos['totalCart']['calculatedTva']}} RON</td>
        </tr>
        <tr>
            <td colspan="3"></td>
            <td align="right">Total</td>
            <td align="right" class="gray">{{$cartInfos['totalCart']['totalOrder']}} RON</td>
        </tr>
    </tfoot>
  </table>

</body>
</html>