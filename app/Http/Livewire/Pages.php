<?php

namespace App\Http\Livewire;

use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Comment;
use App\Models\Pages as ModelsPages;
use Livewire\Component;


class Pages extends Component
{
    public $comment;
    public $param_id;
    // toggle the comment form
    public $toggleShow;

    public function mount($route){
        $this->param_id=$route;
    }
    public function getPageById(){
        return ModelsPages::find($this->param_id);
    }

    protected $rules = [
        'comment' => 'required|max:100'
    ];

    public function updatedToggleShow(){
        $this->resetValidation();
    }

    public function submitComment(){
        $this->validate();

        Comment::create([
            'comment'=>$this->comment,
            'pages_id'=>$this->param_id
        ]);
        $this->comment='';
        
    }

    public function getCommentsById(){
       return Comment::where('pages_id', $this->param_id)->get();
      
    }


    public function render()
    {
        return view('livewire.pages', ['query'=>$this->getPageById(), 'comments'=>$this->getCommentsById()]);
    }

}