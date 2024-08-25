@if ($paginator->hasPages())
    <div class="d-flex justify-content-between">
        <div class="p-2 bd-highlight">
            @if ($paginator->onFirstPage())
                <a class="page-link">Previous</a> 
            @else
                <a class="page-link" wire:click="previousPage">Previous</a>
            @endif
        </div>
        {{-- Next Page Link --}}
        <div class="p-2 bd-highlight">
            @if ($paginator->hasMorePages()) 
                <a class="page-link" wire:click="nextPage">Next</a>
            @else
                <a class="page-link">Next</a>
            @endif        
        </div>
    </div>

    @if(!$paginator->hasMorePages())
        <button type="submit" id="myButtonId" class="btn btn-success" 
                style="margin-top: 20px;" onclick="timeExam()">
            Submit
        </button>
    @endif

@endif