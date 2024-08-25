<div class="container">
    <div class="row">
        <div class="col-md-8 ml-auto mr-auto">
            <h2 class="text-center">Contact Us</h2>
            <form class="contact-form" method="post" action="{{ route('storeMessage') }}">
                @csrf
                <div class="row">
                <div class="col-md-6">
                    @php $input = 'name' @endphp 
                    <label>Name</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">
                            <i class="nc-icon nc-single-02"></i>
                          </span>
                        </div>
                        <input type="text" class="form-control  @error($input) is-invalid @enderror" pattern="[A-Za-z].{2,}" placeholder="Name" name="{{$input}}" value="{{ old($input) }}" autocomplete="off" required>
                        @error($input)
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                     @php $input = 'email' @endphp 
                  <label>Email</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">
                            <i class="nc-icon nc-email-85"></i>
                          </span>
                        </div>
                        <input type="email" class="form-control  @error($input) is-invalid @enderror" placeholder="Email" name="{{$input}}" value="{{ old($input) }}" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" autocomplete="off" required>
                        @error($input)
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
              </div>
                @php $input = "message" @endphp
                <label>Message</label>
                <textarea class="form-control @error($input) is-invalid @enderror" name="{{ $input }}" rows="4" placeholder="Your Message" pattern=".{8,}">{{ old($input) }}</textarea>
                @error($input)
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <div class="row">
                    <div class="col-md-4 ml-auto mr-auto">
                      <button class="btn btn-danger btn-lg btn-fill">Send Message</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>