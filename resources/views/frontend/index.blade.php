@extends('frontend.parent')

@section('content')
    <h3 class="category-title">Berita ZenBlog</h3>

    <div class="col-12">
        <div class="swiper sliderFeaturedPosts">
            <div class="swiper-wrapper">

                @foreach ($slider as $row)
                    <div class="swiper-slide">
                        <a href="{{ $row->url }}" class="img-bg d-flex align-items-end"
                            style="background-image: url('{{ $row->image }}');">
                            <div class="img-bg-inner">
                                <h2>The Best Homemade Masks for Face (keep the Pimples Away)</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem neque est mollitia!
                                    Beatae
                                    minima assumenda repellat harum vero, officiis ipsam magnam obcaecati cumque maxime
                                    inventore repudiandae quidem necessitatibus rem atque.</p>
                            </div>
                        </a>
                    </div>
                @endforeach

            </div>

            <div class="custom-swiper-button-next">
                <span class="bi-chevron-right"></span>
            </div>
            <div class="custom-swiper-button-prev">
                <span class="bi-chevron-left"></span>
            </div>

            <div class="swiper-pagination"></div>
        </div>
    </div>

    {{-- <div class="carousel-inner">
        @php $i = 1; @endphp
        @foreach ($slider as $row)
            <div class="carousel-item {{ $i == '1' ? 'active' : '' }}">
                @php $i++; @endphp
                <img src="{{ $row->image }}" class="d-block w-100" alt="...">
            </div>
        @endforeach
    </div> --}}

    @forelse ($news as $row)
        <div class="d-md-flex post-entry-2 small-img mt-3">
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
    @empty
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-octagon me-1"></i>
            Tidak ada Berita
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endforelse
@endsection
