
    <div class="container">
      <div class="d-flex rounded-2 justify-content-end bg-dark p-3 shadow-sm">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal" wire:click='showModal'>
                Create
              </button>
      </div>
      <hr/>



{{-- table for displaying pages --}}
      <div>
        <table class="table table-striped table-hover table-responsive">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Title</th>
              <th scope="col">Slug/url</th>
              <th scope="col">Image</th>
              <th scope="col">Content</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>
           @foreach ($page_model as $pages)
           <tr>
            <th scope="">{{ $pages->id }}</th>
            <td>{{ $pages->title }}</td>
            <td> <a href="{{ url('page/'.$pages->id ) }}">{{ $pages->slug }}</a></td>
            <td> <img src="{{ asset('storage/blog_top_img/'.$pages->heading_img ) }}" width="70px" height="70px"/></td>
            <td> {!! Str::limit($pages->content, 100, $end='................') !!} </td>
            <td><button class="btn btn-primary" wire:click='edit({{ $pages->id }})'>Edit</button></td>
            <td><button class="btn btn-danger" wire:click='deleteContent({{ $pages->id }})'>Delete</button></td>
          </tr>
           @endforeach
            
          </tbody>
        </table>
        {{ $page_model->links() }}
      </div>
{{-- end table --}}



 {{-- Modal section for creating  --}}
    <div class="modal fade @if($show === true) show @endif" id="myExampleModal"
    style="display: @if($show === true)
            block
    @else
            none
    @endif;"
    tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal</h5>
                    <button class="btn-close btn-close"  
                            type="button"
                            aria-label="Close"
                            wire:click.prevent="doClose()">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body">

                  <form enctype="multipart/form-data">
                  @if ($img)
                      Photo Preview:
                      <img src="{{ $img->temporaryUrl() }}" width="100px" height="100px"> 
                  @else
                   <img src="{{ asset('storage/blog_top_img/'.$handleLocalFile )  }}" width="100px" height="100px" alt="no image"> 
                  @endif
                    @csrf
                      <div class="mb-3">
                        <label for="title" class="form-label">Title </label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ $title }}" aria-describedby="title" wire:model='title'>
                        @error('title') <div class="alert alert-danger">{{ $message }}</div> @enderror
                      </div>
                      <div class="mb-3">
                          <label for="url" class="form-label">http://127.0.0.1:8000/ </label>
                          <input type="text" class="form-control" id="url" name="url" value="{{ $slug }}" aria-describedby="url" wire:model='slug' disabled>
                          {{-- @error('slug') <div class="alert alert-danger">{{ $message }}</div>  @enderror --}}
                      </div>

                      <div class='alert alert-primary' wire:loading wire:target='img'>
                          <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                          </div>
                    </div>
                      <div class="mb-3">
                        <label for="img" class="form-label">image</label>
                        <input type="file" class="form-control" id="img" name="img" value="{{ $handleLocalFile}}" aria-describedby="img" wire:model='img'>
                        @error('img') <div class="alert alert-danger">{{ $message }}</div>  @enderror
                    </div>
      
                      <div class="mb-3" style='overflow:auto' wire:ignore>
                          <label for="content" class="form-label">Content</label>
                          <trix-editor
                            class="formatted-content"
                            x-ref="trix"
                            wire:model.debounce.1000ms="content"
                            wire:key="uniqueKey"
                          >
                            {{  $content }}
                          </trix-editor>
                          @error('content')<div class="alert alert-danger">{{ $message }}</div> @enderror
                      </div> 
                      @if ($contentId)
                      <button class="btn btn-secondary" type="submit" wire:click.prevent="handleSubmitEdit()">Edit</button>
                      @else
                      <button class="btn btn-secondary" type="submit" wire:click.prevent="handleSubmitCreate()">Publish</button>
                      @endif
                     
                  </form>
                
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary"
                            type="button"
                            wire:click.prevent="doClose()">Cancel</button>
                </div>
            </div>
        </div>
    </div>
<!-- Let's also add the backdrop / overlay here -->
          <div class="modal-backdrop fade show"
                id="backdrop"
                style="display: @if($show === true)
                        block
                @else
                        none
                @endif;">
          </div>

</div>






