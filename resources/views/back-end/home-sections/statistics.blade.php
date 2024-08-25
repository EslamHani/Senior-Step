<div class="row">
<div class="col-lg-3 col-md-6 col-sm-6">
  <div class="card card-stats">
    <div class="card-header card-header-info card-header-icon">
      <div class="card-icon">
        <i class="fa fa-puzzle-piece" aria-hidden="true"></i>
      </div>
      <p class="card-category">Categories</p>
      <h3 class="card-title">{{ App\Models\Category::count() }}</h3>
    </div>
    <div class="card-footer">
      <div class="stats">
        <i class="material-icons">arrow_forward</i>
        <a href="{{ route('categories.index') }}" style="color: gray;">All Categories</a>
      </div>
    </div>
  </div>
</div>
<div class="col-lg-3 col-md-6 col-sm-6">
  <div class="card card-stats">
    <div class="card-header card-header-success card-header-icon">
      <div class="card-icon">
        <i class="material-icons">featured_video</i>
      </div>
      <p class="card-category">Courses</p>
      <!-- <h3 class="card-title">{{ App\Models\Course::count() }}</h3> -->
    </div>
    <div class="card-footer">
      <div class="stats">
        <i class="material-icons">arrow_forward</i>
        <a href="{{ route('courses.index') }}"  style="color: gray;">All Courses</a>
      </div>
    </div>
  </div>
</div>
<div class="col-lg-3 col-md-6 col-sm-6">
  <div class="card card-stats">
    <div class="card-header card-header-primary card-header-icon">
      <div class="card-icon">
        <i class="material-icons">video_library</i>
      </div>
      <p class="card-category">Videos</p>
      <h3 class="card-title">{{ App\Models\Video::count() }}</h3>
    </div>
    <div class="card-footer">
      <div class="stats">
        <i class="material-icons">arrow_forward</i>
        <a href="{{ route('videos.index') }}"  style="color: gray;">All Videos</a>
      </div>
    </div>
  </div>
</div>
<div class="col-lg-3 col-md-6 col-sm-6">
  <div class="card card-stats">
    <div class="card-header card-header-default card-header-icon">
      <div class="card-icon">
        <i class="fa fa-comments" aria-hidden="true"></i>
      </div>
      <p class="card-category">Comments</p>
      <h3 class="card-title">{{ App\Models\Comment::count() }}</h3>
    </div>
    <div class="card-footer">
      <div class="stats">
        <i class="material-icons">arrow_forward</i>
        <a href="#comments"  style="color: gray;">Latest Comments</a>
      </div>
    </div>
  </div>
</div>
<div class="col-lg-3 col-md-6 col-sm-6">
  <div class="card card-stats">
    <div class="card-header card-header-default card-header-icon">
      <div class="card-icon">
        <i class="fa fa-users" aria-hidden="true"></i>
      </div>
      <p class="card-category">Users</p>
      <h3 class="card-title">{{ App\Models\User::count() }}</h3>
    </div>
    <div class="card-footer">
      <div class="stats">
        <i class="material-icons">arrow_forward</i>
        <a href="{{ route('users.index') }}"  style="color: gray;">All Users</a>
      </div>
    </div>
  </div>
</div>
<div class="col-lg-3 col-md-6 col-sm-6">
  <div class="card card-stats">
    <div class="card-header card-header-danger card-header-icon">
      <div class="card-icon">
        <i class="fa fa-file-text" aria-hidden="true"></i>
      </div>
      <p class="card-category">PDF Files</p>
      <h3 class="card-title">{{ App\Models\File::count() }}</h3>
    </div>
    <div class="card-footer">
      <div class="stats">
        <i class="material-icons">arrow_forward</i>
        <a href="{{ route('files.index') }}"  style="color: gray;">All Files</a>
      </div>
    </div>
  </div>
</div>
<div class="col-lg-3 col-md-6 col-sm-6">
  <div class="card card-stats">
    <div class="card-header card-header-warning card-header-icon">
      <div class="card-icon">
        <i class="fa fa-question-circle" aria-hidden="true"></i>
      </div>
      <p class="card-category">Questions</p>
      <h3 class="card-title">{{ App\Models\Question::count() }}</h3>
    </div>
    <div class="card-footer">
      <div class="stats">
        <i class="material-icons">arrow_forward</i>
        <a href="{{ route('questions.index') }}"  style="color: gray;">All Question</a>
      </div>
    </div>
  </div>
</div>
<div class="col-lg-3 col-md-6 col-sm-6">
  <div class="card card-stats">
    <div class="card-header card-header-info card-header-icon">
      <div class="card-icon">
        <i class="fa fa-tags" aria-hidden="true"></i>
      </div>
      <p class="card-category">Tags</p>
      <h3 class="card-title">{{ App\Models\Tag::count() }}</h3>
    </div>
    <div class="card-footer">
      <div class="stats">
        <i class="material-icons">arrow_forward</i>
        <a href="{{ route('tags.index') }}"  style="color: gray;">All Tags</a>
      </div>
    </div>
  </div>
</div>
</div>