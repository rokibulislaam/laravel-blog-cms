<div class="container">
  {{-- display blog from database --}}
  <br/><br/>
    <div class="post_label_wrapper">
      <h5 class="post_label">Blog posts</h5>
    </div>
      @foreach ($blog_posts as $blog_post)
      
        <div class="row mt-4">
          
          <div class="col-lg-6 col-sm-12 col-md-6">
              <div class="blog_img">
                <img class="" src="{{ asset('storage/blog_top_img/'.$blog_post->heading_img) }}" alt="blog image" width="100%" height="200px">
              </div>
          </div>
       

          <div class="col-lg-6 col-sm-12 col-md-6 p-2 blog_content">
            <h3>{{ $blog_post->title }}</h3>
            <p class>{!! Str::limit(($blog_post->content) , 200, '...')  !!}</p>
            <p><a href="{{ 'page/'.$blog_post->id }}" class="read_more">Continue reading...</a></p>
          </div>
      
        </div>
        <hr>
        <br>
       
      @endforeach
  
      {{-- 'page/'.{{ $blog_post->slug }} --}}
  
</div>
