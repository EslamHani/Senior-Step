<div class="form-group">
    <label style="text-align: center; font-size: 16px;">
        Add Steps
    </label>
    <i class="fa fa-plus" aria-hidden="true" wire:click="increment" style="cursor: pointer;"></i>
    @foreach($steps as $step)
    <div style="margin-bottom: 10px;" wire:key="{{ $loop->index }}">
    	<input type="text" class="form-control" name="stepsName[]" placeholder="Step {{ $loop->index + 1 }}"  autocomplete="off" value="{{ $step['name'] }}" style="width: 95%; display: inline;">
    	<input type="hidden" class="form-control" name="stepsId[]" value="{{ $step['id'] }}">
        <span wire:click="remove({{ $loop->index }})" style="color: red; cursor: pointer;">
        	<i class="fa fa-times" aria-hidden="true"></i>
        </span>
    </div>
    @endforeach
</div>
