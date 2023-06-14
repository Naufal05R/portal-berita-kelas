@extends('frontend.parent')

@section('content')
    <h3 class="category-title">Detail Category</h3>

    @foreach ($news as $row)
        <div class="d-md-flex post-entry-2 small-img">
            <a href="{{ route('detailNews', $row->slug) }}" class="me-4 thumbnail">
                <img src="{{ $row->image }}" alt="" class="img-fluid">
            </a>
            <div>
                <div class="post-meta"><span class="date">{{ $row->category->name }}</span> <span
                        class="mx-1">&bullet;</span>
                    <span>{{ $row->created_at }}</span>
                </div>
                <h3>
                    <a href="{{ route('detailNews', $row->slug) }}">{{ $row->title }}</a>
                </h3>
                <p>
                    {!! Str::words($row->description, '15') !!}
                </p>

                <div class="d-flex align-items-center author">
                    <div class="photo">
                        <img src="{{ asset('frontend/assets/img/person-2.jpg') }}" alt="" class="img-fluid">
                    </div>
                    <div class="name">
                        <h3 class="m-0 p-0">Wade Warren</h3>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Paging -->
    <div class="text-start py-4">
        <div class="custom-pagination">
            <a href="#" class="prev">Prevous</a>
            <a href="#" class="active">1</a>
            <a href="#">2</a>
            <a href="#">3</a>
            <a href="#">4</a>
            <a href="#">5</a>
            <a href="#" class="next">Next</a>
        </div>
    </div><!-- End Paging -->
@endsection
