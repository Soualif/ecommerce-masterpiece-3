@if (count($breadcrumbs))

    <!-- Start Banner Area -->
 <section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                @foreach($breadcrumbs as $breadcrumb)
                    @if ($breadcrumb->url && !$loop->last)
                    <a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a> <i class="bi bi-arrow-right"></i>
                    @else
                    <a class="active"><h1>{{ $breadcrumb->title }}</h1></a>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</section>
<!-- End Banner Area -->

@endif

