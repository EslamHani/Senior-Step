<!-- your sidebar here -->
<div class="sidebar" data-color="purple" data-background-color="white">
  <div class="logo">
    <a href="{{ route('landing') }}" class="simple-text logo-normal">
      Senior Step
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item {{ is_active('home') }}">
        <a class="nav-link" href="{{ route('admin.home') }}">
          <i class="material-icons">dashboard</i>
          <p>Dashboard</p>
        </a>
      </li>
      <li class="nav-item {{ is_active('users') }}">
        <a class="nav-link" href="{{ route('users.index') }}">
          <i class="fa fa-users" aria-hidden="true"></i>
          <p>Users</p>
        </a>
      </li>
      <li class="nav-item {{ is_active('categories') }}">
        <a class="nav-link" href="{{ route('categories.index') }}">
          <i class="fa fa-puzzle-piece" aria-hidden="true"></i>
          <p>Categories</p>
        </a>
      </li>
      <li class="nav-item {{ is_active('courses') }}">
        <a class="nav-link" href="{{ route('courses.index') }}">
          <i class="material-icons">featured_video</i>
          <p>Courses</p>
        </a>
      </li>
      <li class="nav-item {{ is_active('videos') }}">
        <a class="nav-link" href="{{ route('videos.index') }}">
          <i class="material-icons">video_library</i>
          <p>Videos</p>
        </a>
      </li>
      <li class="nav-item {{ is_active('questions') }}">
        <a class="nav-link" href="{{ route('questions.index') }}">
          <i class="fa fa-question-circle" aria-hidden="true"></i>
          <p>Questions</p>
        </a>
      </li>
      <li class="nav-item {{ is_active('topics') }}">
        <a class="nav-link" href="{{ route('topics.index') }}">
          <i class="fa fa-newspaper-o" aria-hidden="true"></i>
          <p>Topics</p>
        </a>
      </li>
      <li class="nav-item {{ is_active('files') }}">
        <a class="nav-link" href="{{ route('files.index') }}">
          <i class="fa fa-file-text" aria-hidden="true"></i>
          <p>Files</p>
        </a>
      </li>
      <li class="nav-item {{ is_active('messages') }}">
        <a class="nav-link" href="{{ route('messages.index') }}">
          <i class="material-icons">contact_mail</i>
          <p>Messages</p>
        </a>
      </li>
      <li class="nav-item {{ is_active('skills') }}">
        <a class="nav-link" href="{{ route('skills.index') }}">
          <i class="fa fa-tasks" aria-hidden="true"></i>
          <p>Skills</p>
        </a>
      </li>
      <li class="nav-item {{ is_active('tags') }}">
        <a class="nav-link" href="{{ route('tags.index') }}">
          <i class="fa fa-tags" aria-hidden="true"></i>
          <p>Tags</p>
        </a>
      </li>
      <li class="nav-item {{ is_active('pages') }}">
        <a class="nav-link" href="{{ route('pages.index') }}">
          <i class="material-icons">gradient</i>
          <p>Pages</p>
        </a>
      </li>
    </ul>
  </div>
</div>