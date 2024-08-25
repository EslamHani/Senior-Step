<div>
  	<div class="form-group">
        <label style="text-align: center; font-size: 16px;">
            Add Steps
        </label>
        <i class="fa fa-plus" aria-hidden="true" wire:click="increment" style="cursor: pointer;"></i>
        @foreach($steps as $step)
        <div style="margin-bottom: 10px;" wire:key="{{ $step }}">
        	<input type="text" class="form-control" name="steps[]" placeholder="Step {{ $step +1 }}"  autocomplete="off" style="width: 95%; display: inline;">
            <span wire:click="remove({{ $step }})"style="color: red; cursor: pointer;">
            <i class="fa fa-times" aria-hidden="true"></i>
            </span>
        </div>
        @endforeach
    </div>
</div>
