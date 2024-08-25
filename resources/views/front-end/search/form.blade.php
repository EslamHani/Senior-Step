<div class="form-group" style="margin-top: 50px;">
	<form method="get" 
		  action="{{ route('courses') }}" 
		  class="form-inline my-2 my-lg-0">

		<input type="search" 
			   id="search"
			   name="search" 
			   pattern="[^'\x22]+" 
			   placeholder="Search by course name" 
			   class="form-control mr-sm-2" 
			   style="width: 75%; height: 47px; font-size: 17px; display: inline;" 
			   value="{{ isset($search) && $search != '' ? $search : '' }}" 
			   autocomplete="off" 
			   required>

		<button type="submit" 
				class="btn btn-danger my-2 my-sm-" 
				style="display: inline; color: white; height: 47px;">
		    	<i class="fa fa-search" aria-hidden="true" style="font-size: 18px;"></i>
		</button>
	</form>
</div>






