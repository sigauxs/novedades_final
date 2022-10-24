<?php

namespace App\Http\Livewire;

use App\Models\CenterCost;
use App\Models\Employee;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

class AllEmployee extends Component
{

    use WithPagination;

    public $centerCosts;


    public $search = '';
    public $identification;
    public $fullname;



    public function mount(){

        $this->centerCosts = CenterCost::where('name', '!=' , "admin")->get();

    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {

        $employees = Employee::query()
        ->when($this->search, fn($query, $search) => $query->WhereRaw('LOWER("first_name") LIKE ?',['%'.trim(strtolower($this->search)).'%']))
        ->when($this->search, fn($query, $search) => $query->orWhereRaw('LOWER("last_name") LIKE ?',['%'.trim(strtolower($this->search)).'%']))
        ->when($this->identification,function($query){ return $query->where('identification',$this->identification);})
        ->paginate(10);


        return view('livewire.all-employee', compact('employees'));
    }
}
