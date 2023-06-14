@extends('admin.parent')

@section('content')
    <form action="{{ route('siswa.store') }}" method="post">
        @csrf
        @method('POST')

        <label for="" class="form-label"> Name Siswa </label>
        <input type="text" class="form-control" name="name">

        <label for="" class="form-label">Phone Siswa</label>
        <input type="number" class="form-control" name="phone">

        <label for="" class="form-label">Address Siswa</label>
        <textarea 
            class="form-control" cols="30" rows="10" 
            name="address"></textarea>

        
            <button type="submit" class="btn btn-primary mt-3">Add Siswa</button>
        
    </form>
@endsection
