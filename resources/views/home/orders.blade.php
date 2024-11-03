<!DOCTYPE html>
<html>

<head>
 @include('home.css')

 <style>

    .div_deg
    {
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 50px;
    }

    table
    {
        border: 2px solid black;
        text-align: center;
    }

    th{
        border: 2px solid black;
        text-align: center;
        color: white;
        font: 20px;
        font-weight: bold;
        background-color: black;
        width: 800px;
    }

    td{

border: 1px solid skyblue;

    }
    
    .cart_value
    {
        text-align: center;
        margin-bottom: 70px;
        padding: 18px;
    }
.order_deg
{
    padding: 150px;
    margin-top: -200px; 
}

label
{
    display: inline-block;
    width: 150px;
}

.div_gap
{
    padding: 20px;
}
 </style>
</head>

<body>
  <div class="hero_area">
    <!-- header section strats -->
   @include('home.header')
    <!-- end header section -->
    <!-- slider section -->
   

    <!-- end slider section -->
  </div>
  <!-- end hero area -->

  <!-- shop section -->

 

  <!-- end shop section -->
  <div class="div_deg">



<table>

<tr>
    <th>Name</th>

    <th>Receiver Address</th>

    <th>Phone</th>

    <th>Product Title</th>

    <th>Product Price</th>

    <th>Product Image</th>

    <th>Status</th>

</tr>

<?php
$value = 0;




?>
@foreach ($data as $data)
    

<tr>
    <td>{{$data->name}}</td>
    <td>{{$data->rec_address}}</td>
    <td>{{$data->phone}}</td>
    <td>{{$data->product->title}}</td>
    <td>{{$data->product->price}}</td>
    <td>
        <img width="150" src="/products/{{$data->product->image}}" alt="">
    </td>

    <td>
        @if($data-> status =='in progress')
        <span style="color: red">{{$data->status}}</span>
        @elseif($data-> status =='On the way')
        <span style="color: yellow">{{$data->status}}</span>
        @else
        <span style="color: green">{{$data->status}}</span>
       @endif
    </td>

    
</tr>



@endforeach

</table>
  </div>

  <div class="cart_value">


  </div>





  <!-- contact section -->



  <!-- end contact section -->

   
@include('home.footer')
  <!-- info section -->





<script>
    function confirmation(ev)
    {
        ev.preventDefault();

        var urlToRedirect = ev.currentTarget.getAttribute('href');

        console.log(urlToRedirect);

        swal({
            title: "Are You Sure You Want To Delete",
            text: "This delete will be permanent",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })

        .then((willCancel)=>{

            if(willCancel){
                window.location.href=urlToRedirect;
            }

        })
    }
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>