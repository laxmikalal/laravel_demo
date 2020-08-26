@extends('devices.layout')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Demo Application</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('devices.create') }}"> Create New device</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <button>
      <a class="btn btn-info" href="{{ route('import') }}">Import</a>
    </button>
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Type</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($devices as $device)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $device->name }}</td>
            <td>{{ $device->type }}</td>
            <td>
                <form action="{{ route('devices.destroy',$device->id) }}" method="POST">
   
                    <a class="btn btn-info" href="{{ route('devices.show',$device->id) }}">Show</a>
    
                    <a class="btn btn-primary" href="{{ route('devices.edit',$device->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  
    {!! $devices->links() !!}
      
@endsection