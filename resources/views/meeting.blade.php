@extends('layout')

@section('content')
<h1>Create online meeting</h1>
    @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
            @php
                Session::forget('success');
            @endphp
        </div>
        @endif
   
        <form method="POST" action="{{ url('onlineMeetingCreate') }}">
  
             @csrf
  
            <div class="form-group">
                <label>Subject:</label>
                <input type="text" name="subject" class="form-control" placeholder="Subject">
                @if ($errors->has('subject'))
                    <span class="text-danger">{{ $errors->first('subject') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label>Guest Name:</label>
                <input type="text" name="name" class="form-control" placeholder="Guest Name">
                @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label>Guest Name:</label>
                <input type="email" name="email" class="form-control" placeholder="Email">
                @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
            </div>
    
            
            <div class="form-group">

            </div>
                <label>Start time:</label>
               <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                    <input type="text" class="form-control datetimepicker-input" name="startDateTime" data-target="#datetimepicker1"/>
                    <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
                @if ($errors->has('startDateTime'))
                    <span class="text-danger">{{ $errors->first('startDateTime') }}</span>
                @endif
            </div>
    
            
   
            <div class="form-group">
                <button class="btn btn-success btn-submit">Submit</button>
            </div>
        </form>
       
@endsection