<div>

<select wire:model="centerCostFilter">
    <option value="">Selecciona el area</option>
     @foreach ($centerCosts as $centerCost)
         <option value="{{ $centerCost->id }}">{{ $centerCost->name }}</option>
     @endforeach
</select>

<input type="text" wire:model="search">

@foreach ($employees as $employee)

<p>{{$employee->first_name}}</p>

@endforeach


{{ $employees->links()}}

</div>
