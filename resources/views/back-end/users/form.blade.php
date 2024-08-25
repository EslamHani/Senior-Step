<div class="row">
    <div class="col-md-6">
        @php $input = 'name' @endphp
        <div class="form-group bmd-form-group">
            <label class="bmd-label-floating">Username</label>
            <input type="text" class="form-control @error($input) is-invalid @enderror" name="{{$input}}" value="{{ isset($row->{ $input}) ? $row->name : old($input)}}" autocomplete="off">
            @error($input)
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        @php $input = 'email' @endphp
        <div class="form-group bmd-form-group">
            <label class="bmd-label-floating">Email address</label>
            <input type="email" class="form-control @error($input) is-invalid @enderror" name="{{$input}}" value="{{ isset($row->{$input}) ? $row->email : old($input) }}" autocomplete="off">
            @error($input)
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        @php $input = 'password' @endphp
        <div class="form-group bmd-form-group">
            <label class="bmd-label-floating">Password</label>
            <input type="password" name="{{ $input }}" value="{{ old($input) }}" class="form-control @error($input) is-invalid @enderror" autocomplete="off">
            @error($input)
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        @php $input = "image" @endphp
        <input type="file" name="{{$input}}" class="form-control @error($input) is-invalid @enderror" style="margin-top: 8px">
        @error($input)
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="col-md-6">
        <div class="form-group">
            @php $select = "country" @endphp
    	    <select id="inputState" class="form-control" name="{{$select}}">
    	        <option value="" {{ isset($row->{$select}) && $row->{$select} == "" ? 'selected': '' }}>Choose Country</option>
    	        <option value="Egypt" {{ isset($row->{$select}) && $row->{$select} == "Egypt" ? 'selected': '' }}>Egypt</option>
    	        <option value="Saudi Arabia" {{ isset($row->{$select}) && $row->{$select} == "Saudi Arabia" ? 'selected': '' }}>Saudi Arabia</option>
    	        <option value="USA" {{ isset($row->{$select}) && $row->{$select} == "USA" ? 'selected': '' }}>USA</option>
    	        <option value="England" {{ isset($row->{$select}) && $row->{$select} == "England" ? 'selected': '' }}>England</option>
    	    </select>
    	</div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
        @php $select = "permission" @endphp
            <select id="inputState" class="form-control @error($select) is-invalid @enderror" name="{{$select}}">
              <option value="" {{ isset($row->{$select}) && $row->{$select} == "" ? 'selected': '' }}>Choose Permission</option>
              <option value="1" {{ isset($row->{$select}) && $row->{$select} == 1 ? 'selected': '' }}>Admin</option>
              <option value="2" {{ isset($row->{$select}) && $row->{$select} == 2 ? 'selected': '' }}>User</option>
            </select>
            @error($select)
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
        @php $select = "verified" @endphp
            <select id="inputState" class="form-control @error($select) is-invalid @enderror" name="{{$select}}">
              <option value="" {{ isset($row->{$select}) && $row->{$select} == "" ? 'selected': '' }}>Verification</option>
              <option value="0" {{ isset($row->{$select}) && $row->{$select} == 0 ? 'selected': '' }}>False</option>
              <option value="1" {{ isset($row->{$select}) && $row->{$select} == 1 ? 'selected': '' }}>True</option>
            </select>
            @error($select)
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group bmd-form-group" style="margin-top: 15px;">
        <label class="bmd-label-floating">Level</label>
        @php $input = "level" @endphp
            <input type="number" class="form-control @error($input) is-invalid @enderror" name="{{$input}}" value="{{ isset($row->{$input})? $row->{$input} : old($input) }}" max="50" min="1" autocomplete="off">
            @error($input)
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group bmd-form-group">
        @php $input = "address" @endphp
            <label class="bmd-label-floating">Adress</label>
            <input type="text" class="form-control @error($input) is-invalid @enderror" name="{{$input}}" value="{{ isset($row->{$input})? $row->{$input} : old($input) }}" autocomplete="off">
            @error($input)
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <div class="form-group bmd-form-group">
             @php $input = "bio" @endphp
                <label class="bmd-label-floating">Bio</label>
                <textarea class="form-control @error($input) is-invalid @enderror" rows="5" name="{{ $input }}">{{ isset($row->{$input}) ? $row->{$input} : old($input) }}</textarea>
                @error($input)
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
    </div>
</div>