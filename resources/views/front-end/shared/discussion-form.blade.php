<div class="form-group">
    <label for="title">Title</label>
    <input type="text" name="title" value="{{ isset($discussion->title) ? $discussion->title  : old('title') }}" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Title">
    @error('title')
        <span style="color: red;">{{ $message }}</span>
    @enderror
</div>

<div class="form-group">
    <label for="category1">Category</label>
    <select name="cat_id" class="form-control  @error('cat_id') is-invalid @enderror" id="category1">
        <option value="">Choose Category</option>
        @foreach($categories as $category)
        <option value="{{ $category->id }}" {{ isset($discussion->cat_id) && $discussion->cat_id == $category->id ? 'selected' : '' }} {{ old('cat_id') == $category->id ? 'selected' : '' }}>
            {{ $category->category_name }}
        </option>
        @endforeach
    </select>
    @error('cat_id')
        <span style="color: red;">{{ $message }}</span>
    @enderror
</div>

<div class="form-group">
    <label for="body">Body</label>
    <textarea class="form-control  @error('body') is-invalid @enderror" name="body" placeholder="what's in your mind ?" id="body" rows="3">{{ isset($discussion->body) ? $discussion->body   : old('body') }}</textarea>
    @error('body')
        <span style="color: red;">{{ $message }}</span>
    @enderror
</div>

<div class="form-group">
    <label for="image">Image</label>
    <input type="file" name="image" class="form-control  @error('image') is-invalid @enderror" id="image">
    @error('image')
        <span style="color: red;">{{ $message }}</span>
    @enderror
</div><br>
