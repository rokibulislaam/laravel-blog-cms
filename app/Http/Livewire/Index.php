<?php

namespace App\Http\Livewire;

use App\Models\Pages;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $blog_post =[];
   

    // public function mount(){
    //     $this->blog_post = 
    // }

    // public function setBlogPosts(){
       
    // }


    public function render()
    {
        return view('livewire.index', ['blog_posts'=> Pages::paginate(20)]);
    }
}
