<div class="row">
  <div class="col-md-12">
    <div class="card" id="comments">
      <div class="card-header card-header-primary">
        <h4 class="card-title ">Control Comments</h4>
        <p class="card-category">Here You Can  delete Comments</p>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table">
            <thead class=" text-primary">
              <tr>
              <th>
                  Name
              </th>
              <th>
                  email
              </th>
              <th>
                  Comment
              </th>
              <th>
                  Video Name
              </th>
              <th>
                  Course Name
              </th>
              <th>
                date
              </th>
              <th style="text-align: right">
                Control
              </th>
            </tr></thead>
            <tbody>
              @foreach($comments as $comment)
              <tr>
                <td>
                  <a href="{{ route('users.edit', ['id' => $comment->user->id]) }}" style="color: black">
                    {{ $comment->user->name }}
                </a>
                </td>
        <td>
          <a href="{{ route('users.edit', ['id' => $comment->user->id]) }}" style="color: black">
            {{ $comment->user->email }}
          </a>
        </td>
        <td>{{ substr($comment->comment, 0, 20) }}{{ strlen($comment->comment) > 20 ? "..." : "" }}</td>
        <td>
          <a href="{{ route('videos.edit', ['id' => $comment->video->id]) }}" style="color: black">
          {{ substr($comment->video->video_name, 0, 20) }}{{ strlen($comment->video->video_name) > 20 ? '...' : '' }}
          </a>
        </td>
        <td>{{ $comment->video->course->course_name }}</td>
            <td>{{ $comment->created_at->diffForHumans() }}</td>
                <td class="td-actions text-right">
                <form action="{{ route('comments.destroy', ['id' => $comment->id])}}" method="post">
        @csrf
        @method('delete')
        <button type="submit" rel="tooltip" title="" class="btn btn-danger btn-link btn-sm" data-original-title="Remove Comment" name="delete_btn">
        <i class="material-icons">close</i>
        </button>
        </form>
                 </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="card">
      <div class="card-header card-header-primary">
        <h4 class="card-title ">Control Users</h4>
        <p class="card-category">Here You Can edit / delete user</p>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table">
            <thead class=" text-primary">
              <tr>
              <th>
                Email
              </th>
              <th>
                Verified 
              </th>
              <th>
                date
              </th>
              <th style="text-align: right">
              	Control
              </th>
            </tr></thead>
            <tbody>
            	@foreach($users as $user)
              <tr>
                <td>
                  {{ $user->email }}
                </td>
                <td>
                  {{ $user->verified == 1 ? 'Verified' : 'Unverified' }}
                </td>
                <td>
                  {{ $user->created_at->diffForHumans() }}
                </td>
                <td class="td-actions text-right">
                	<a href="{{ route('users.edit', ['id' => $user->id]) }}" rel="tooltip" title="" class="btn btn-primary btn-link btn-sm" data-original-title="Edit User">
				<i class="material-icons">edit</i>
				</a>
              	<form action="{{ route('users.destroy', ['id' => $user->id])}}" method="post"  style="display:inline;">
				@csrf
				@method('delete')
				<button type="submit" rel="tooltip" title="" class="btn btn-danger btn-link btn-sm" data-original-title="Remove User" name="delete_btn">
				<i class="material-icons">close</i>
				</button>
				</form>
                 </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="card">
      <div class="card-header card-header-primary">
        <h4 class="card-title ">Control Messages</h4>
        <p class="card-category">Here You Can  replay / delete message</p>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table">
            <thead class=" text-primary">
              <tr>
              <th>
                 Name
              </th>
              <th>
                Replay Message
              </th>
              <th>
                date
              </th>
              <th style="text-align: right">
              	Control
              </th>
            </tr></thead>
            <tbody>
            	@foreach($messages as $message)
              <tr>
                <td>
                  {{ $message->name }}
                </td>
               
			  <td>{{ $message->replay == 1 ? 'Done' : 'Not Done' }}</td>
    			  <td>{{ $message->created_at->diffForHumans() }}</td>
                <td class="td-actions text-right">
              	<form action="{{ route('messages.destroy', ['id' => $message->id])}}" method="post">
              		<a href="{{ route('messages.edit', ['id' => $message->id]) }}" rel="tooltip" title="" class="btn btn-primary btn-link btn-sm" data-original-title="Replay Message">
		        <i class="material-icons">edit</i>
		        </a>
				@csrf
				@method('delete')
				<button type="submit" rel="tooltip" title="" class="btn btn-danger btn-link btn-sm" data-original-title="Remove Message">
				<i class="material-icons" name="delete_btn">close</i>
				</button>
				</form>
                 </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
 </div>