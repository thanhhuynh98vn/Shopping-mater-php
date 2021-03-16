@include('templates.shop.header')
@if(Session::has('msgs'))
               <script>
        alert('Bạn cần mua hàng trước khi thanh toán');
                       </script>
@endif
@if(Session::has('success'))
    <script>
        alert('Đơn hàng đã được đặt! Xin cảm ơn');
    </script>
@endif
    <!-- SITE MAIN CONTENT -->

    <main class="main-content">
        
        <section class="main-slideshow flexslider mb30">
            <ul id="slider" class="slides">
                <li class="item"> <a href="#"><img src="{{$publicUrl}}/images/slide_1.jpg" data-url="#" class="slide-img" alt="Lorum Ispum" draggable="false" /></a>
                    <div class="container">p
                        <div class="row-table">
                            <div class="row-cell">
                                <div class="slide-des left">
                                    <h2>Closer than ever</h2>
                                    <p class="slide-text">Pellentesque posuere orci lobortis scelerisque blandit. Quisquemos sodales suscipit tortor ditaemcos condimentum lacus meleifend menean viverra auctor blanditos comodous.</p>
                                    <a class="btn btn--large btn-slide" href="#">Shop the Collection<i class="fa fa-caret-right" aria-hidden="true"></i> </a> </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="item"> <a href="#"><img src="{{$publicUrl}}/images/slide_2.jpg" data-url="#" class="slide-img" alt="Lorum Ispum" draggable="false" /></a>
                    <div class="container">
                        <div class="row-table">
                            <div class="row-cell">
                                <div class="slide-des right">
                                    <h2>Upgrade your Kitchen</h2>
                                    <p class="slide-text">Lorum Ispum. Pellentesque posuere orci lobortis scelerisque blandit.Quisquemos sodales suscipit tortor ditaemcos condimentum lacus meleifend menean viverra auctor blanditos comodous.</p>
                                    <a class="btn btn--large btn-slide" href="#">Shop the Collection<i class="fa fa-caret-right" aria-hidden="true"></i> </a> </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="item flex-active-slide"> <a href="#"><img src="{{$publicUrl}}/images/slide_3.jpg" data-url="#" class="slide-img" alt="comodous" draggable="false"></a> </li>
            </ul>
        </section>
        <script src="{{$publicUrl}}/js/flexslider.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('.flexslider').flexslider({
                    animation:  "fade",
                    slideshowSpeed: 4000,
                    slideshow: true,
                    animationSpeed :500,
                    touch: true,
                    pauseOnHover: true,
                    controlNav:true
                });
            });
        </script>
        <section class="container mb60">
            <div class="col-3-block-banner">
                <div class="row">
                    <div class="col-xs-12 col-sm-4"><a href="#"><img src="{{$publicUrl}}/images/block_banner_1.jpg" alt="" /><span>Home Entertainment</span></a></div>
                    <div class="col-xs-12 col-sm-4"><a href="#"><img src="{{$publicUrl}}/images/block_banner_2.jpg" alt="" /><span>Accessories</span></a></div>
                    <div class="col-xs-12 col-sm-4"><a href="#"><img src="{{$publicUrl}}/images/block_banner_3.jpg" alt="" /><span>Phones &amp; Tablets</span></a></div>
                </div>
            </div>
        </section>
        <section class="container mb60">
            <div class="list list-featured-products">
                <h2 class="section-title">Sản phẩm mới nhất</h2>
                <div class="products">
                    <div class="products-grid productSlider owl-carousel">
                        @foreach($arItems as $arItem)
                            @php
                                $name=$arItem->name;
                $pid=$arItem->pid;
                $name_slug=str_slug($name);
                             $urlDetail=route('shop.products.detail',['slug'=>$name_slug,'id'=>$pid]);
                        @endphp
                        <div class="grid_item">
                            <div class="product_image"> <a href="{{$urlDetail}}"><img src="{{$imgUrl}}/files/{{$arItem->image}}" alt="" /></a>
                                <div class="action-buttons">
                                    {{--<a class="btn-action wishlist" href="wishlist.html" title="Add To Wishlist"><i class="fa fa-heart" aria-hidden="true"></i></a>--}}
                                    <a class="btn-action add-to-cart" href="javascript:void(0)" id="{{$pid}}" title="Mua"><span class="icon icon-cart" aria-hidden="true"></span></a>
                                    <button type="button" class="btn-action btn-quickview" title="Quick View" data-toggle="modal" data-target="#quickView-{{$pid}}"><i class="fa fa-eye" aria-hidden="true"></i></button>
                                </div>
                            </div>
                            <div class="product_detail">
                                <h3 class="product_name"><a href="{{$urlDetail}}">{{$arItem->name}}</a> </h3>
                                <label class="new">New</label>
                                <span class="product_price">{!!number_format( $arItem->unit_price,0,",",".")!!} VND</span> </div>
                        </div>

                            @endforeach

                    </div>
                    @foreach($arItems as $arItem)
                        @php
                            $name=$arItem->name;
                            $pid=$arItem->pid;
                            $name_slug=str_slug($name);
                            $urlDetail=route('shop.products.detail',['slug'=>$name_slug,'id'=>$pid]);
                        @endphp
                        @include('templates.shop._modal')
                    @endforeach
                </div>
            </div>
        </section>
        <script>

            $(document).ready(function () {

                $(".add-to-cart").click(function () {
                    var idCart = $(this).attr('id');
                    var token=$("input[name='_token']").val();
                    $.ajax({
                        url:'{{route('shop.cart.cart')}}',
                        type:'get',
                        cache:false,
                        data:{"_token":token,"idCart":idCart},
                        success:function (data) {
                            alert('Đặt hàng thành công');
                            window.location.reload();
                        },
                        error:function (data) {
                            alert('Sản phẩm tạm thời hết hàng');
                        }
                    });

                });
            });
        </script>
        <section class="block-banner mb60">
            <div class="container">
                {{--<div class="block-banner_caption">--}}
                    {{--<h2>New Collection</h2>--}}
                    {{--<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>--}}
                    {{--<a href="http://www.adornthemes.com/html/nexgeek/product-list.html" title="Shop Now" class="btn btn--large">Shop Now <i class="fa fa-caret-right" aria-hidden="true"></i> </a> </div>--}}
            </div>
        </section>
        <section class="container mb60">
            <div class="list list-trending-products">
                <h2 class="section-title">Sản phẩm xem nhiều nhất</h2>
                <div class="products">
                    <div class="products-grid productSlider owl-carousel">
                        @foreach($views_limit as $limits)
                            @php
                                $name=$limits->name;
                                $pid=$limits->pid;
                                $name_slug=str_slug($name);
                                $urlDetail=route('shop.products.detail',['slug'=>$name_slug,'id'=>$pid]);
                            @endphp
                        <div class="grid_item">
                            <div class="product_image"> <a href="{{$urlDetail}}"><img src="{{$imgUrl}}/files/{{$limits->image}}" alt=""> </a>
                                {{--<div class="action-buttons"> <a class="btn-action wishlist" href="wishlist.html" title="Add To Wishlist"><i class="fa fa-heart" aria-hidden="true"></i></a> <a class="btn-action add-to-cart" href="product-detail.html" title="Select Options"><span class="icon icon-cart" aria-hidden="true"></span></a>--}}
                                    {{--<button type="button" class="btn-action btn-quickview" title="Quick View" data-toggle="modal" data-target="#quickView"><i class="fa fa-eye" aria-hidden="true"></i></button>--}}
                                {{--</div>--}}
                            </div>
                            <div class="product_detail">
                                <h3 class="product_name"><a href="{{$urlDetail}}">{{$limits->name}}</a> </h3>
                                <span class="product_price"><span> {!!number_format( $limits->promotion_price,0,",",".") !!} VND</span></span> </p>
                                <span class="product_price old_price"> <s> {!!number_format( $limits->unit_price,0,",",".") !!} VND</s> </span> </div>
                        </div>
                            @endforeach
                    </div>
                </div>
            </div>
        {{--</section>--}}
        {{--<section class="container-fluid mb60">--}}
            {{--<div class="list list-featured-collection">--}}
                {{--<h2 class="section-title"> All Collections </h2>--}}
                {{--<div class="collections">--}}
                    {{--<div class="collections-grid owl-carousel">--}}
                        {{--<div class="grid_item  text-center"><a href="product-listing.html" title="Browse our Adaptors &amp;amp; Connectors collection" class="collection-image"><img src="{{$publicUrl}}/images/collection-1.jpg" alt=""> <span class="hover-layer"> <span class="collection-name"> Adaptors &amp; Connectors </span> <span class="collections-count"> 1 product </span> </span> </a> </div>--}}
                        {{--<div class="grid_item  text-center"><a href="product-listing.html" title="Browse our Cameras collection" class="collection-image"><img src="{{$publicUrl}}/images/collection-2.jpg" alt=""> <span class="hover-layer"> <span class="collection-name"> Cameras </span> <span class="collections-count"> 13 products </span> </span> </a> </div>--}}
                        {{--<div class="grid_item  text-center"><a href="product-listing.html" title="Browse our Entertainment collection" class="collection-image"><img src="{{$publicUrl}}/images/collection-3.jpg" alt=""> <span class="hover-layer"> <span class="collection-name"> Entertainment </span> <span class="collections-count"> 8 products </span> </span> </a> </div>--}}
                        {{--<div class="grid_item  text-center"><a href="product-listing.html" title="Browse our Health &amp;amp; Beauty collection" class="collection-image"><img src="{{$publicUrl}}/images/collection-4.jpg" alt=""> <span class="hover-layer"> <span class="collection-name"> Health &amp; Beauty </span> <span class="collections-count"> 10 products </span> </span> </a> </div>--}}
                        {{--<div class="grid_item  text-center"><a href="product-listing.html" title="Browse our Home Appliances collection" class="collection-image"><img src="{{$publicUrl}}/images/collection-5.jpg" alt=""> <span class="hover-layer"> <span class="collection-name"> Home Appliances </span> <span class="collections-count"> 18 products </span> </span> </a> </div>--}}
                        {{--<div class="grid_item  text-center"><a href="product-listing.html" title="Browse our Laptops &amp;amp; Computers collection" class="collection-image"><img src="{{$publicUrl}}/images/collection-6.jpg" alt=""> <span class="hover-layer"> <span class="collection-name"> Laptops &amp; Computers </span> <span class="collections-count"> 8 products </span> </span> </a> </div>--}}
                        {{--<div class="grid_item  text-center"><a href="product-listing.html" title="Browse our New Arrivals collection" class="collection-image"><img src="{{$publicUrl}}/images/collection-7.jpg" alt=""> <span class="hover-layer"> <span class="collection-name"> New Arrivals </span> <span class="collections-count"> 15 products </span> </span> </a> </div>--}}
                        {{--<div class="grid_item  text-center"><a href="product-listing.html" title="Browse our Phones &amp;amp; Tablets collection" class="collection-image"><img src="{{$publicUrl}}/images/collection-8.jpg" alt=""> <span class="hover-layer"> <span class="collection-name"> Phones &amp; Tablets </span> <span class="collections-count"> 33 products </span> </span> </a> </div>--}}
                        {{--<div class="grid_item  text-center"><a href="product-listing.html" title="Browse our Phones &amp;amp; Tablets Accessories collection" class="collection-image"><img src="{{$publicUrl}}/images/collection-9.jpg" alt=""> <span class="hover-layer"> <span class="collection-name"> Phones &amp; Tablets Accessories </span> <span class="collections-count"> 3 products </span> </span> </a> </div>--}}
                        {{--<div class="grid_item  text-center"><a href="product-listing.html" title="Browse our Trending Now collection" class="collection-image"><img src="{{$publicUrl}}/images/collection-10.jpg" alt=""> <span class="hover-layer"> <span class="collection-name"> Trending Now </span> <span class="collections-count"> 9 products </span> </span> </a> </div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</section>--}}
        <section class="container mb60">
            <h2 class="section-title"> Brands We Sale </h2>
            <div class="list list-brand">
                <div class="owl-carousel">
                    <div class="item"><a title="Letraset" href="#"><img src="{{$publicUrl}}/images/brandlogo1.png" alt=""></a> </div>
                    <div class="item"><a title="QQ2x" href="#"><img src="{{$publicUrl}}/images/brandlogo2.png" alt=""></a> </div>
                    <div class="item"><a title="bbn" href="#"><img src="{{$publicUrl}}/images/brandlogo3.png" alt=""></a> </div>
                    <div class="item"><a title="classique" href="#"><img src="{{$publicUrl}}/images/brandlogo4.png" alt=""></a> </div>
                    <div class="item"><a title="bbn" href="#"><img src="{{$publicUrl}}/images/brandlogo3.png" alt=""></a> </div>
                    <div class="item"><a title="kamera" href="#"><img src="{{$publicUrl}}/images/brandlogo6.png" alt=""></a> </div>
                    <div class="item"><a title="qq" href="#"><img src="{{$publicUrl}}/images/brandlogo1.png" alt=""></a> </div>
                    <div class="item"><a title="bbn" href="#"><img src="{{$publicUrl}}/images/brandlogo3.png" alt=""></a> </div>
                </div>
            </div>
        </section>
        {{--<section class="container mb60">--}}
            {{--<div class="list list-blog">--}}
                {{--<h2 class="section-title"> Latest From Our Blog </h2>--}}
                {{--<div class="blogs">--}}
                    {{--<div class="blogs-grid owl-carousel">--}}
                        {{--<div class="grid_item">--}}
                            {{--<div class="blogs-grid_box"><img src="{{$publicUrl}}/images/selfi-expert.jpg" alt=""> </div>--}}
                            {{--<div class="blogs-grid_box"> <span  class="datetime"> <span class="day"> 20 </span> <span class="month"> / October </span> </span>--}}
                                {{--<h3><a href="blog-detail.html">New Selfie Expert</a></h3>--}}
                                {{--<p>Lorem ipsum dolor sit amet, duo senserit posidonium eu, ut nostrud reprehendunt cum. Pri cu odio eros dissentiunt. Per no...</p>--}}
                                {{--<p><a href="blog-detail.html" class="read-more">Read more<i class="fa fa-caret-right" aria-hidden="true"></i> </a></p>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="grid_item">--}}
                            {{--<div class="blogs-grid_box"><img src="{{$publicUrl}}/images/beauty_lies.jpg" alt=""> </div>--}}
                            {{--<div class="blogs-grid_box"> <span class="datetime"> <span class="day"> 20 </span> <span class="month"> / October </span> </span>--}}
                                {{--<h3><a href="blog-detail.html">Beauty lies within</a></h3>--}}
                                {{--<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy...</p>--}}
                                {{--<p><a href="blog-detail.html" class="read-more">Read more<i class="fa fa-caret-right" aria-hidden="true"></i> </a></p>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="grid_item">--}}
                            {{--<div class="blogs-grid_box"><img src="{{$publicUrl}}/images/selfi-expert.jpg" alt=""></div>--}}
                            {{--<div class="blogs-grid_box"> <span class="datetime"> <span class="day"> 14 </span> <span class="month"> / October </span> </span>--}}
                                {{--<h3><a href="blog-detail.html">First post</a></h3>--}}
                                {{--<p>This is your store’s blog. You can use it to talk about new product launches, experiences, tips or other news...</p>--}}
                                {{--<p><a href="blog-detail.html" class="read-more">Read more<i class="fa fa-caret-right" aria-hidden="true"></i> </a></p>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</section>--}}
    </main>

    <!-- SITE FOOTER -->
  @include('templates.shop.footer')