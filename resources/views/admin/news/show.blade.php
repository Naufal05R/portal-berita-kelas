@extends('admin.parent')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">News Show</h5>

            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="bi bi-house-door"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{ route('news.index') }}">News</a></li>
                    <li class="breadcrumb-item active">Show</li>
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

            <div class="card p-3">

                <div class="col-md-12">
                    <label for="inputNewsName" class="form-label">Title News</label>
                    <input type="text" class="form-control" id="inputNewsName" 
                        value="{{ $news->title }}" name="title" readonly>
                </div>

                <div class="col-md-12">
                    <label for="inputImageNews" class="form-label">Image News</label>
                    <img src="{{ $news->image }}" id="inputImageNews" class="w-50 form-control" alt="">
                </div>

                <div class="col-md-12">
                    <label for="inputCategoryNews" class="form-label">Category News</label>
                    <select id="inputCategoryNews" class="form-select" name="category_id" required>
                        <option value="{{ $news->category->id }}">{{ $news->category->name }}</option>
                    </select>
                </div>


                <div class="col-md-12">
                    <label class="form-label">Description News</label>
                    <div class="card p-3">
                        {!! $news->description !!}
                    </div>
                </div>

                <div class="text-center">
                    <a href="{{ route('news.edit', $news->id) }}" class="btn btn-warning">
                        <i class="bi bi-pencil"></i> Edit
                    </a>
                </div>

            </div>

        </div>
    </div>
@endsection
