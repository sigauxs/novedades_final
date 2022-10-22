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
    public $centerCostFilter;
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



        $employees = Employee::whereRaw('LOWER("first_name") LIKE ?',['%'.trim(strtolower($this->search)).'%'])
                    ->orWhereRaw('LOWER("last_name") LIKE ? ', ['%'.trim(strtolower($this->search)).'%'])->where(function (Builder $query) {
                        return $query->where('center_cost_id', $this->centerCostFilter);
                    })->paginate(10);

        /*$employees =  Employee::query()
        ->when($this->centerCostFilter, function($query){
          $query->where('center_cost_id',$this->centerCostFilter);
        })->paginate(10);*/

        return view('livewire.all-employee', compact('employees'));
    }
}
