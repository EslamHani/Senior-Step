@extends('layouts.app')

@section('title')
	{{ $course->course_name }}
@endsection

@push('css')
    <style type="text/css">
        .table-question th{
            background: #f5593d;
            color: #fff;
        }
        .form-check-input {
            margin-left: -1.25rem;
        }
        .form-check {
            padding-left: 1.25rem;
        }
        .questionNumber{
            font-size: 15px;
            margin-top: -10px;
        }
        .form-section{
            display: none;
        }
        .form-section.current{
            display: inherit;
        }
    </style>
@endpush

@include('layouts.image-banner', ['CurrentPage' => 'Quiz'])

@section('content')
<div class="section">
    <div class="container" style="margin-top: -70px;">
        <div class="row" style="margin-bottom: 30px;">
            <div class="col-md-12">
                <h3 class="title" style="font-family: 'Noticia Text', serif; float: left;">
                    {{ $course->course_name }} : Quiz
                </h3>
                @auth
                    @if(is_null($testResult) && count($course->questions) > 0)
                        <span id="demo" class="timeExam"></span>
                        <span class="timeExam1">Time left for this quiz : </span>
                    @endif
                @endauth
                <div class="clearfix"></div><hr>
            </div>
        </div>
        <div class="row"> 
            @guest
                <div class="col-md-6 offset-md-3">
                     @include('front-end.shared.login-register-redirect', ['disc' => 'To Start Quiz'])
                </div>
            @else
                <div class="col-md-12">
                    @if(!is_null($testResult))
                        <div class="col-md-8 offset-md-2">
                            @include('front-end.quizes.card-exam')
                        </div>
                    @else
                        @if(count($course->questions) > 0)
                           @include('front-end.quizes.exam-form')
                        @else
                            <center>
                                <p style="font-weight: bold; font-family: sans-serif;">
                                    The Exam Will Be Ready Soon...
                                </p>
                            </center>
                        @endif
                    @endif
                </div>
            @endguest
        </div>
    </div>
</div>
@endsection

@push('js')
<script> 
    $(function(){
        var $sections = $('.form-section');

        function navigateTo(index){
            $sections.removeClass('current').eq(index).addClass('current');
            $('.form-navigation .previous').toggle(index>0);
            var atTheEnd = index >= $sections.length-1;
            $('.form-navigation .next').toggle(!atTheEnd);
            $('.form-navigation [type=submit]').toggle(atTheEnd);
        }

        function curIndex()
        {
            return $sections.index($sections.filter('.current'));
        }

        $('.form-navigation .previous').click(function() {
            navigateTo(curIndex()-1);
        });

        $('.form-navigation .next').click(function(){
            navigateTo(curIndex()+1);
        });

        navigateTo(0);
    });
    // Deadline counter time
    var deadline = new Date().getTime() + 7200000;  // Two Hours
    var x = setInterval(function() { 
    var now = new Date().getTime(); 
    var t = deadline - now; 
    //var days = Math.floor(t / (1000 * 60 * 60 * 24)); 
    var hours = Math.floor((t%(1000 * 60 * 60 * 24))/(1000 * 60 * 60)); 
    var minutes = Math.floor((t % (1000 * 60 * 60)) / (1000 * 60)); 
    var seconds = Math.floor((t % (1000 * 60)) / 1000); 
    document.getElementById("demo").innerHTML = hours + ":" + minutes + ":" + seconds; 
        if (t < 0) { 
            clearInterval(x); 
            document.getElementById("demo").innerHTML = "Time is over"; 
        } 
    }, 1000);

    // Automatic click on button if time is over
    setInterval(function () {document.getElementById("myButtonId").click();}, 7200000);
</script> 
@endpush