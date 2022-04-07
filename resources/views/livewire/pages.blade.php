<div class="container mt-4">
    <div class="d-flex flex-column align-items-center justify-content-center border-2" >
        <div class="w-75">
            <div class="each_post_title mt-4">
                <h2 class="">{{ $query->title }}</h2> 
             </div>
             <div class="each_post_header_img">
                 <img class="img-fluid" src="{{ asset('storage/blog_top_img/'.$query->heading_img) }}" width="700px">
             </div>
          
             <div class="each_post_content mt-4">
              <p>{!! $query->content !!}</p>
             </div>
             <br>
             <hr>
        </div>
    </div>

</div>  



