<?php

namespace App\Http\Livewire\Admin;

use App\Models\Pages;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\WithPagination;
use Livewire\Component;
use Livewire\WithFileUploads;

class Backend extends Component
{
    use WithPagination;
    use WithFileUploads;
    // public Pages $page;
    public $show;
    public $contentId;
    public $title;
    public $slug;
    public $content;
    public $img;
    public $handleLocalFile;

    public function mount() {
        $this->show = false;
    }

    public function doShow() {
        $this->show = true;
    }

    public function doClose() {
        $this->show = false;
        $this->resetValidation();
        $this->reset('title', 'slug', 'content','handleLocalFile', 'img');
    }

    public function showModal() {
        $this->doShow();
        $this->resetValidation();
        $this->reset('title', 'slug', 'content','handleLocalFile', 'img');
    }

    // run after title property is updated
    function updatedTitle(){
        $lowercase = strtolower($this->title);
        $toSlugFormat = str_replace(' ', '-',$lowercase);
        $this->slug=$toSlugFormat;
    }

     // run after img property is updated
     public function updatedImg(){
         $this->handleLocalFile = '';
     }

    protected $rules = [
        'title'=>'required|max:30|min:10',
        'slug' => 'required|max:30|min:10|unique:pages,slug',
        'content' => 'required',
        'img'=>'required|max:1000000|mimes:jpeg,jpg,png,gif'
    ];
    

    // creating post 
    public function handleSubmitCreate() {
       $this->validate();
      
       Pages::create([
            'title'=>$this->title,
            'slug'=>$this->slug,
           'content'=>$this->content,
           'heading_img'=>$this->img->getClientOriginalName(),
           'userId' =>Auth::user()->id
       ]);
       $this->img->storeAs('public/blog_top_img', $this->img->getClientOriginalName());
       $this->resetValidation();
       $this->reset();
        // Close Modal After Logic
        $this->doClose();
    }

// updating modal form with data by specific id from the edit button
    public function edit($id){
        $page= Pages::find($id);
        $this->title = $page->title;
        $this->slug=$page->slug;
        $this->content=$page->content;
        $this->contentId=$id;
        $this->handleLocalFile=$page->heading_img;
        $this->doShow();

    }


    // handling of edited content
    public function handleSubmitEdit(){
        $this->validate();
        Pages::find($this->contentId)->update([
            'title'=>$this->title,
            'slug'=>$this->slug,
            'content'=>$this->content,
            'heading_img'=>$this->img->getClientOriginalName(),
            'userId' =>Auth::user()->id
        ]);
        $this->img->storeAs('public/blog_top_img', $this->img->getClientOriginalName());
        $this->resetValidation();
        $this->reset();
        // Close Modal After Logic
        $this->doClose();
    }

// delete post by id
    public function deleteContent($id){
        Pages::destroy($id);
    }


    // extract model posted by the current user
    public function getModelByUser(){
      return Pages::where("userId", Auth::id());
    }

    public function render()
    {
        return view('livewire.admin.backend', ['page_model'=>$this->getModelByUser()->paginate(7)]);
    }
}
