<section class="shop_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Our Products
        </h2>

        <div>
<!-- REMEMBER TO IMPLEMEMNT FILTERING BY CATEGORY FOR CUSTOMERS -->
        </div>
      </div>
      <div class="row">

        @foreach ($product as $product )
          
        
        <div class="col-sm-6 col-md-4 col-lg-3">
          <div class="box">
            
              <div class="img-box">
                <img src="products/{{$product->image}}" alt="">
              </div>
              <div class="detail-box">
                <h6>
                  {{$product->title}}
                </h6>
                <h6>
                  Price
                  <span>
                    Kshs{{$product->price}}
                  </span>
                </h6>
              </div>
    <div style="padding: 15px">
      <a class="btn btn-danger" href="{{url('product_details' , $product->id)}}">Details</a>
      <a class="btn btn-primary" href="{{url('add_cart' , $product->id)}}">Add to cart</a>
    </div>

   
          </div>
        </div>
        
        @endforeach
        </div>
      </div>

    </div>
  </section>