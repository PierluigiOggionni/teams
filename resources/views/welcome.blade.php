@extends('layout')

@section('content')
<div class="jumbotron">
 <h1>test microsoft graph</h1>
 <p class="lead">test app for microsoft graph api</p>
 @if(isset($userName))
   <h4>Welcome {{ $userName }}!</h4>
   
 @else
   <a href="/signin" class="btn btn-primary btn-large">Click here to sign in</a>
 @endif
</div>
@endsection
