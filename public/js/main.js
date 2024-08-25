$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('#update').hide();
$('#updateReply').hide();
$('#commentId').hide();
$('#save').show();
$('#replyImageDiv').hide();

//View comments function
function viewData(videoId = null, authId = null){
  $.ajax({
    type: "GET",
    dataType: "json",
    url: "/video/"+videoId+"/comments",
    success: function(response){
      var count = 0;
      var rows = '';
      if(response.length != 0){
          $.each(response, function(key, value){
            rows += '<div>';
            rows += '<div style="display: inline-block; margin-right: 5px;  position: relative;">';
            rows += '<span style="position: absolute; top: 50px; font-weight: bold; font-size: 10px; left: 6px;">Level '+value.user.level+'</span>';
            rows += '<a href="/profile/'+value.user.id+'" target="_self">';
            rows += '<img src="'+value.user.image+'"  width="50" height="50" alt="" style="border-radius: 50px;">';
            rows += '</a>';
            rows += '</div>';
            rows += '<strong class="strong" style="margin-top: -10px;">';
            rows += '<a href="/profile/'+value.user.id+'" class="anchor" style="color: black; margin-left: 5px;">'+value.user.name+'</a>';
            rows += '</strong>';
            rows += '<strong class="dot">.</strong>';
            if(value.user.permission == 1){
            rows += '<span class="cm-5">( Admin )</span>';
            rows += '<strong class="dot">.</strong>';
            }
            rows += '<small class="cm-6">'+parseTwitterDate(value.created_at)+'</small>';
            rows += '<div style="margin-left: 60px; margin-top: -15px;" class="cm-7">';
            rows += '<p style="font-family: sans-serf;">'+value.comment+'</p>';
            rows += '</div>';
            if(value.user.id == authId){
            rows += '<button type="button" class="btn btn-dafault btn-link btn-sm cm-8" onclick="editData('+value.id+')"  style="margin-left: 50px;  margin-top: -5px;"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</button>';
            rows += '<button type="button" class="btn btn-dafault btn-link btn-sm cm-8" onclick="deleteData('+value.id+')" style="margin-top: -5px;"><i class="fa fa-trash" aria-hidden="true"></i>Delete</button>';
            var style = "margin-left: 0px;";
            }else{
              style = "margin-left: 50px;";
            }
            if(value.replies.length != 0){
            rows += '<button type="button" class="btn btn-dafault btn-link btn-sm cm-8" onclick="show('+value.id+')" style="margin-top: -5px;'+style+'"><i class="fa fa-reply-all" aria-hidden="true"></i>Replies</button>';
            }
            if(value.replies.length != 0){
              rows += '<div style="margin-left: 50px; margin-top: 40px; position: relative;" class="cm-9" id="replies_'+value.id+'">';
              for(var i = 0; i < value.replies.length; i++){
                rows += '<div>';
                rows += '<div style="display: inline-block; margin-right: 5px;">';
                rows += '<span style="position: absolute; top: 50px; font-weight: bold; font-size: 10px; left: 5px;">Level '+value.replies[i].user.level+'</span>';
                rows += '<a href="/profile/'+value.replies[i].user.id+'" target="_self">';
                rows += '<img src="'+ value.replies[i].user.image +'"  width="50" height="50" alt="" style="border-radius: 50px;">';
                rows += '</a>';
                rows += '</div>';
                rows += '<strong class="strong" style="margin-top: -10px;">';
                rows += '<a href="/profile/'+value.replies[i].user.id+'" class="anchor" style="color: black; margin-left: 5px;">'+value.replies[i].user.name+'</a>';
                rows += '</strong>';
                rows += '<strong class="dot">.</strong>';
                if(value.replies[i].user.permission == 1){
                rows += '<span class="cm-5">( Admin )</span>';
                rows += '<strong class="dot">.</strong>';
                }
                rows += '<small class="cm-6">'+parseTwitterDate(value.replies[i].created_at)+'</small>';
                rows += '<div style="margin-left: 60px; margin-top: -15px;" class="cm-7">';
                rows += '<p style="font-family: sans-serf;">'+value.replies[i].replay_comment+'</p>';
                rows += '</div>';
                if(value.replies[i].user.id == authId){
                  rows += '<button type="button" class="btn btn-dafault btn-link btn-sm cm-8" onclick="editReply('+value.replies[i].id+')"  style="margin-left: 50px;  margin-top: -5px;"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</button>';
                  rows += '<button type="button" class="btn btn-dafault btn-link btn-sm cm-8" onclick="deleteReply('+value.replies[i].id+')" style="margin-top: -5px;"><i class="fa fa-trash" aria-hidden="true"></i>Delete</button>';
                }
                rows += '</div><br>';
              }
              rows += '</div>';
            }
            rows += '</div><br>';
            ++count;
          });
          
      }else{
        rows += "<div class='col-md-12 cm-6'><center>No Comments Yet...</center></div>"
      }
      $('#comments-body').html(rows);
      $('#count').html(count);
    }
  });
}

viewData($('#watchid').val(), $('#authId').val());

//Save Comment Function
function saveData(){
  var comment  = $('#myText').val();
  var video_id = $('#video_id').val();
  $.ajax({
    type: "POST",
    dataType: "json",
    data: {comment: comment, video_id: video_id},
    url: "/savedata",
    success: function(response){
      clearData();
      var authId = "";
      $.each(response, function(k, v){
        authId += v.user.id;
      }); 
      viewData(video_id, authId);
      $('#save').show();
    }
  });
}

//Cleare data from from after save
function clearData(){
  $('#myText').val('');
}

//Edit Comment Function
function editData(id){
  $('#save').hide();
  $('#updateReply').hide();
  $('#update').show();
  $.ajax({
    type: "GET",
    dataType: "json",
    url: "/edit/"+id+"/comment",
    success: function(response){
      $('#video_id').val(response.video_id);
      $('#myText').val(response.comment);
      $('#commentId').val(response.id);
    }
  });
}

//Edit Reply Comment Function
function editReply(id){
  $('#save').hide();
  $('#update').hide();
  $('#updateReply').show();
  $.ajax({
    type: "GET",
    dataType: "json",
    url: "/edit/"+id+"/comment/reply",
    success: function(response){
      $('#video_id').val(response.comment.video_id);
      $('#myText').val(response.replay_comment);
      $('#commentId').val(response.id);
    }
  });
}

// Update Comment Function
function updateData(){
  var video_id = $('#video_id').val();
  var comment  = $('#myText').val();
  var id   = $('#commentId').val();
  $.ajax({
    type: "PATCH",
    dataType: "json",
    data: {video_id: video_id, comment: comment},
    url: "/update/"+id+"/comment",
    success: function(response){
      var authId = "";
      $.each(response, function(key, value){
        authId = value.user.id;
      });
      viewData(video_id, authId);
      clearData();
      $('#save').show();
      $('#update').hide();
      $('#updateReply').hide();
    }
  });
}

// Update Reply Comment Function
function updateCommentReply(){
  var video_id = $('#video_id').val();
  var reply  = $('#myText').val();
  var id   = $('#commentId').val();
  $.ajax({
    type: "PATCH",
    dataType: "json",
    data: {video_id: video_id, replay_comment: reply},
    url: "/update/"+id+"/comment/reply",
    success: function(response){
      var authId = "";
      $.each(response, function(key, value){
        authId = value.user.id;
      });
      viewData(video_id, authId);
      clearData();
      $('#save').show();
      $('#update').hide();
      $('#updateReply').hide();
    }
  });
}


// Delete comment function
function deleteData(id){
  $.ajax({
    type: "DELETE",
    dataType: "json",
    url: "/delete/comment/"+id,
    success: function(response){ 
      var authId = "";
      var video_id = "";
      $.each(response, function(key, value){
        authId += value.user.id;
        video_id += value.video_id;
      });
      viewData(video_id, authId);
    }
  });
}

// Delete Comment Reply Function
function deleteReply(id){
   $.ajax({
    type: "DELETE",
    dataType: "json",
    url: "/delete/comment/reply/"+id,
    success: function(response){ 
      var authId = "";
      var video_id = "";
      $.each(response, function(key, value){
        authId += value.user.id;
        video_id += value.comment.video_id;
      });
      viewData(video_id, authId);
    }
  });
}

// SlideToggle Function //
function show($id){
  $('#replies_'+$id).slideToggle();
}

// Start Ago time function //
function parseTwitterDate(tdate) {
    var system_date = new Date(Date.parse(tdate));
    var user_date = new Date();
    if (K.ie) {
        system_date = Date.parse(tdate.replace(/( \+)/, ' UTC$1'))
    }
    var diff = Math.floor((user_date - system_date) / 1000);
    if (diff <= 1) {return "just now";}
    if (diff < 20) {return diff + " seconds ago";}
    if (diff < 40) {return "half a minute ago";}
    if (diff < 60) {return "less than a minute ago";}
    if (diff <= 90) {return "one minute ago";}
    if (diff <= 3540) {return Math.round(diff / 60) + " minutes ago";}
    if (diff <= 5400) {return "1 hour ago";}
    if (diff <= 86400) {return Math.round(diff / 3600) + " hours ago";}
    if (diff <= 129600) {return "1 day ago";}
    if (diff < 604800) {return Math.round(diff / 86400) + " days ago";}
    if (diff <= 2629746) {return Math.round(diff / 604800) + " week ago";}
    if (diff <= 31556952) {return Math.round(diff / 2629746) + " month ago";}
    if (diff <= 946708560) {return Math.round(diff / 31556952) + " year ago";}
    return "on " + system_date;
}

// from http://widgets.twimg.com/j/1/widget.js
var K = function () {
    var a = navigator.userAgent;
    return {
        ie: a.match(/MSIE\s([^;]*)/)
    }
}
// Start Ago time function //



// Image Preview //
$("#imgInp").change(function() {
  if (this.files && this.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('#myImg').attr('src', e.target.result);
      $('#profileImage').attr('src',  e.target.result);
    }
    reader.readAsDataURL(this.files[0]); // convert to base64 string
  }
});
// Image preview //

// Image Preview //
$("#file").change(function() {
  if (this.files && this.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('#replyImage').attr('src', e.target.result);
      $('#replyImageDiv').show();
    }
    reader.readAsDataURL(this.files[0]); // convert to base64 string
  }
});
// Image preview //

