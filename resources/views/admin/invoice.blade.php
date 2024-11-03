<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <center>
        <h3>Customer Name:  {{$data->name}}</h3>

        <h3>Customer Address:  {{$data->rec_address}}</h3>

        <h3>Customer Phone Number:  {{$data->phone}}</h3>

        <h2>Product Title:  {{$data->product->title}}</h2>

        <h2>Product Price:  {{$data->product->price}}</h2>

        <img height="250" width="300" src="products/{{$data->product->image}}" alt="">

        
    </center>


</body>
</html>