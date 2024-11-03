<!DOCTYPE html>
<html>
  <head> 
   @include('admin.admincss')
   <style>
.div_deg
{
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 10px;
}

.table_deg
{
    border: 3px solid greenyellow;

}

th{
    background-color: skyblue;
    color: white;
    font-size: 19px;
    font-weight: bold;
    padding: 10px;
    text-align: center;
}

td
{
    border: 1px solid skyblue;
     text-align: center;
    color: white;
    padding: 50px;
}

input[type='search']
{
  width: 500px;
  height: 60px;
  margin-left: 50px;
}

   </style>
  </head>
  <body>
    @include('admin.header')


    @include('admin.sidebar')

      <!-- Sidebar Navigation end-->
      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">

       <!-- Test-->

       <form action="{{url('product_search')}}" method="get">
        @csrf
        <input type="search" name="search">
        <input type="submit" class="btn btn-secondary" value="Search">
       </form>

       <div class="div_deg">

        <table class="table_deg">
            <tr>
            <th> Product Title</th>
            <th>Description</th>
            <th>Category</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Image</th>
            <th>Edit</th>
            <th>Delete</th>
            </tr>

            @foreach ($datas as $data)
                
            <tr>
                <td>{{$data->title}}</td>
                <td>{!!Str::limit($data->description,50)!!}</td>
                <td>{{$data->category}}</td>
                <td>{{$data->price}}</td>
                <td>{{$data->quantity}}</td>
                <td>
                    <img height="120" width="120" src="products/{{$data->image}}" alt="">
                </td>

                <td>
                  <a class="btn btn-success" href="{{url('edit_product',$data->id)}}">Edit</a>
                </td>

                <td>
                  <a class="btn btn-danger" onclick="confirmation(event)"  href="{{url('delete_product',$data->id)}}">Delete</a>
                </td>
              
                
            </tr>


            @endforeach  


        </table>

        
        

    </div>

    <div style="display: flex; flex-direction: row; align-items: center; justify-content: center; padding: 30px;">
    {{ $datas->links() }}
    </div>

<!--Test -->
          </div>
      </div>
    </div>
    <!-- JavaScript files-->
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
    <script src="{{asset('admincss/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('admincss/vendor/popper.js/umd/popper.min.js')}}"> </script>
    <script src="{{asset('admincss/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('admincss/vendor/jquery.cookie/jquery.cookie.js')}}"> </script>
    <script src="{{asset('admincss/vendor/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('admincss/vendor/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('admincss/js/charts-home.js')}}"></script>
    <script src="{{asset('admincss/js/front.js')}}"></script>
  </body>
</html>