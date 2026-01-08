<?php

namespace App\Livewire\User;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout("components.layout.user")]
class FindFriends extends Component
{
    public $users = [];
    public function mount(){
        // get user keyword search if any
        $query = request()->get("query","");
    
        if($query){
            $this->users = \App\Models\User::where("id","!=","".auth()->user()->id)
           ->where(function($q) use ($query){
                $q->where("fname","like","%".$query."%")
                  ->orWhere("lname","like","%".$query."%")
                  ->orWhere("email","like","%".$query."%");})
            ->get();
        }   else {
            $this->users = \App\Models\User::where("id","!=",auth()->user()->id)->get();
        }    
    }
    public function render()
    {
        return view('livewire.user.find-friends',["users"=>$this->users]);
    }
}






