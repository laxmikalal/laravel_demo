@extends('devices.layout')
  
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Import CSV</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('devices.index') }}"> Back</a>
        </div>
    </div>
</div>

    <!-- Message -->
     @if(Session::has('message'))
        <p >{{ Session::get('message') }}</p>
     @endif
   
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<!-- Form -->
     <form method='post' action='{{ route('import_process') }}' enctype='multipart/form-data' >
       {{ csrf_field() }}
       <input type='file' name='import_file' >
       <input type='submit' name='submit' value='Import'>
     </form>


   
@endsection