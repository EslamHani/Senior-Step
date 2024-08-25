<div class="row">
    <div class="col-md-6">
        @php $input = 'name' @endphp
        <div class="form-group bmd-form-group">
            <label class="info">Username</label>
            <input type="text" class="form-control" name="{{$input}}" value="{{ isset($user->{ $input}) ? $user->name : old($input)}}" autocomplete="off">
            @error('name')
                <span style="color: red;">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        @php $input = 'email' @endphp
        <div class="form-group bmd-form-group">
            <label class="info">Email address</label>
            <input type="email" class="form-control" name="{{$input}}" value="{{ isset($user->{$input}) ? $user->email : old($input) }}" autocomplete="off">
            @error('email')
                <span style="color: red;">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        @php $input = 'password' @endphp
        <div class="form-group bmd-form-group">
            <label class="info">Password</label>
            <input type="password" name="{{ $input }}" class="form-control" autocomplete="off"  placeholder="Change Your Password" {{ isset(auth()->user()->password) && auth()->user()->password == "" ? 'readonly="readonly"' : '' }} >
            @error('password')
                <span style="color: red;">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="info">Country</label>
            @php $select = "country" @endphp
    	    <select  class="form-control" name="{{$select}}">
    	        <option value="" {{ isset($user->{$select}) && $user->{$select} == "" ? 'selected': '' }}>Choose Country</option>
    	        <option value="Egypt" {{ isset($user->{$select}) && $user->{$select} == "Egypt" ? 'selected': '' }}>Egypt</option>
    	        <option value="Saudi Arabia" {{ isset($user->{$select}) && $user->{$select} == "Saudi Arabia" ? 'selected': '' }}>Saudi Arabia</option>
    	        <option value="USA" {{ isset($user->{$select}) && $user->{$select} == "USA" ? 'selected': '' }}>USA</option>
    	        <option value="England" {{ isset($user->{$select}) && $user->{$select} == "England" ? 'selected': '' }}>England</option>
    	    </select>
            @error('country')
                <span style="color: red;">{{ $message }}</span>
            @enderror
    	</div>
    </div>
    <div class="col-md-12">
        <div class="form-group bmd-form-group">
        @php $input = "image" @endphp
            <div class="form-group">
                <label for="bannerInp">Profile Image</label>
                <div class="input-group mb-3">
                    <input type="file" class="form-control" name="{{ $input }}" style="height: 50px; padding: 15px;" id="imgInp" value="{{ isset($user->{$input}) ? $user->{$input} : '' }}">
                    <div class="input-group-append">
                         <img src="{{ $user->{$input} }}" alt="Profile Image" id="profileImage" width="50" height="50">
                    </div>
                    @error('image')
                        <small class="form-text text-muted">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group bmd-form-group">
        @php $input = "address" @endphp
            <label class="info">Adress</label>
            <input type="text" class="form-control" name="{{$input}}" value="{{ isset($user->{$input})? $user->{$input} : old($input) }}" autocomplete="off">
            @error('address')
                <span style="color: red;">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <div class="form-group bmd-form-group">
             @php $input = "bio" @endphp
                <label class="info">Bio</label>
                <textarea class="form-control" rows="5" name="{{ $input }}">{{ isset($user->{$input}) ? $user->{$input} : old($input) }}</textarea>
                @error('bio')
                    <span style="color: red;">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
</div>