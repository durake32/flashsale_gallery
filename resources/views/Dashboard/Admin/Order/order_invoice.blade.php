<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Invoice</title>

    <style type="text/css">
        * {
            font-family: Verdana, Arial, sans-serif;
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
        .font{
            font-size: 15px;
        }
        .authority {
            /*text-align: center;*/
            float: right
        }
        .authority h5 {
            margin-top: -10px;
            color: #ee4130;
            /*text-align: center;*/
            margin-left: 35px;
        }
        .thanks p {
            color: #ee4130;;
            font-size: 16px;
            font-weight: normal;
            font-family: serif;
            margin-top: 20px;
        }
    </style>

</head>
<body>

<table width="100%" style="background: #F7F7F7; padding:0 20px 0 20px;">
    <tr>
        <td valign="top">
            <br><br>
             <img src="{{ public_path('/Asset/logo.png')}}" alt="" width="250"/>
            <pre class="font" >

            </pre>
        </td>
        <td align="right">
            <pre class="font" >
               Dailomaa Multipurpose Pvt. Ltd.
               Pan No : 606837206
               Website : www.dailomaa.com
               Email: info@dailomaa.com <br>
               Tel: 01-5314021 <br>
               Bafal-13, Kathmandu<br>

            </pre>
        </td>
    </tr>

</table>


<table width="100%" style="background:white; padding:2px;""></table>

<table width="100%" style="background: #F7F7F7; padding-bottom: 25px;" class="font">
    <tr>
        <td>
            <p class="font" style="margin-left: 20px;">
                <strong>Name:</strong> {{ $order->name }}<br>
                <strong>Email:</strong> {{ $order->email }} <br>
                <strong>Phone:</strong> {{ $order->phone }} <br>
                <strong>Address:</strong> {{ $order->address }} <br>
            </p>
        </td>
        <td>
            <p class="font">
            <h3><span style="color: #ee4130;">Invoice:</span> #{{$order->random_id}}</h3>
            Order Date: {{ $order->created_at }} <br>
            Delivery Date: {{ $order->delivery_date }} <br>
            Payment Type :
            @if ($order->payment_id == 1)
           Esewa
           @elseif($order->payment_id == 2)
           CellPay
           @elseif($order->payment_id == 3)
           Fonepay
           @elseif($order->payment_id == 4)
            Cash On Delivery
           @endif </span>
            </p>
        </td>
    </tr>
</table>
<br/>
<h3>Products</h3>


<table width="100%">
    <thead style="background-color: #ee4130; color:#FFFFFF;">
    <tr class="font">
        <th>Product Name</th>
        <th>Quantity</th>
        <th>Unit Price </th>
        <th>Total </th>
    </tr>
    </thead>
    <tbody>

    @foreach($orderItem as $item)
        <tr class="font">
            <td align="center"> {{ $item->product->name }}</td>
            <td align="center">{{ $item->quantity }}</td>
            <td align="center">Rs.{{ $item->price }}</td>
            <td align="center">Rs.{{ $item->price * $item->quantity }} </td>
        </tr>
    @endforeach
    <td>

    </td>
    </tbody>

</table>
<br>
<table width="100%" style=" padding:0 10px 0 10px;">
    <tr>
        <td align="right" >
             <br>
            <h2><span style="color: #ee4130;">Delivery Charge : {{ $order->delivery_charge }}</h2>
           <h2><span style="color: #ee4130;">Total : {{ $order->total_amount}}</h2>
        </td>
    </tr>
</table>
<div class="thanks mt-3">
    <p>Thanks For Buying With Us..!!</p>
</div>
<div class="authority float-right mt-5">
    <p>-----------------------------------</p>
    <h5>Authorized Signature:</h5>
</div>
</body>
</html>
