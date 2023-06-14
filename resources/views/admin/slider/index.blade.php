@extends('admin.parent')

@section('content')

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Slider </h5>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="bi bi-house-door"></i></a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('slider.index') }}">Slider</a></li>
                </ol>
            </nav>

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-octagon me-1"></i>
                        {{ $error }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endforeach
            @endif

            <div class="container d-flex justify-content-end">
                <!-- Create Modal -->
                <button type="button" class="btn btn-primary my-auto" data-bs-toggle="modal"
                    data-bs-target="#createCategoryModal">
                    <i class="bx bxs-plus-square"><span> Add Slider</span></i>
                </button>
                @include('admin.slider.create-modal')
                <!-- End Create Modal-->
            </div>

            <div class="card container mt-3">
                <!-- Table with stripped rows -->
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Image</th>
                                <th scope="col">Url</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($slider as $row)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>
                                        <img src="{{ $row->image }}" class="w-50" alt="">
                                    </td>
                                    <td>
                                        <a href="http://{{ $row->url }}" target="_blank" rel="noopener noreferrer">
                                            Link
                                        </a>
                                    </td>
                                    <td>
                                        <!-- Edit Modal -->
                                        <button type="button" class="btn btn-warning m-2" data-bs-toggle="modal"
                                            data-bs-target="#editSliderModal{{ $row->id }}">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </button>
                                        @include('admin.slider.edit-modal')
                                        <!-- End Edit Modal-->

                                        <form action="{{ route('slider.destroy', $row->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger m-2" type="submit">
                                                <i class="bi bi-trash"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- End Table with stripped rows -->
            </div>

        </div>
    </div>
@endsection
