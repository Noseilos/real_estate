@extends('frontend.frontend_dashboard')
@section('main')
    

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<!--Page Title-->
<section class="page-title centred" style="background-image: url({{ asset('frontend/assets/images/background/page-title-5.jpg')}});">
    <div class="auto-container">
        <div class="content-box clearfix">
            <h1>Live Chat</h1>
            <ul class="bread-crumb clearfix">
                <li><a href="index.html">Home</a></li>
                <li>Live Chat</li>
            </ul>
        </div>
    </div>
</section>
<!--End Page Title-->


<!-- sidebar-page-container -->
<section class="sidebar-page-container blog-details sec-pad-2">
    <div class="auto-container">
        <div class="row clearfix">
            


            <div class="col-lg-3 col-md-3 col-sm-3 sidebar-side">
                <div class="blog-sidebar">
                    <div class="sidebar-widget post-widget">
                        <div class="post-inner">
                            <div class="post">
                                <figure  class="post-thumb"><a href="blog-details.html">
                                <img src="{{ (!empty($userData->photo)) ? url('upload/user_images/'.$userData->photo) : url('upload/no_image.jpg') }}" alt=""></a></figure>
                                    <h5><a href="blog-details.html">{{ $userData->name }}</a></h5>
                                    <p>{{ $userData->email }}</p>
                            </div> 
                        </div>
                    </div> 

                    <div class="sidebar-widget category-widget">
                        <div class="widget-title">
                            
                        </div>

                        @include('frontend.dashboard.dashboard_sidebar')
                    </div> 
                 
                </div>
            </div>




<div class="col-lg-9 col-md-9 col-sm-9 content-side">
    <div class="blog-details-content">
        <div class="news-block-one">
            <div class="inner-box">
                
                <div class="lower-content">
                    

                    <h3>Live Chat Box</h3>
                    <div id="app">

                        <chat-message></chat-message>

                    </div>


                </div>
            </div>
        </div>
            
        
    </div>


</div> 


        </div>
    </div>
</section>
<!-- sidebar-page-container -->


@endsection