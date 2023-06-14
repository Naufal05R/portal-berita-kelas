@extends('admin.parent')


@section('content')
    <div class="container card">

        <a href="{{ route('siswa.create') }}" class="btn btn-primary mb-3">
            add Siswa
        </a>

        <div class="container">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>No</td>
                        <td>Name</td>
                        <td>Phone</td>
                        <td>Address</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($siswa as $row)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->phone }}</td>
                            <td>{{ $row->address }}</td>
                            <td>
                                <a href="{{ route('siswa.show', $row->id) }}" class="btn btn-primary m-1">
                                    Show
                                </a>

                                <a href="{{ route('siswa.edit', $row->id) }}" class="btn btn-warning">
                                    Edit
                                </a>
                                
                                <form action="{{ route('siswa.destroy', $row->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger m-1" type="submit">
                                        Delete
                                    </button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection
