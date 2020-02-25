@extends('welcome')
@section('content')
<div class="container">
    @if($ReplyStatus == 'Y')
    <div class="alert alert-dark text-center justify-content-center" role="alert">
        您於{{$ReplyDate}}填過，非常感謝您的填寫
    </div>
    @else
    <div class="alert alert-dark text-center justify-content-center" role="alert">
        感謝您的填寫
    </div>
    @endif
</div>
@endsection

