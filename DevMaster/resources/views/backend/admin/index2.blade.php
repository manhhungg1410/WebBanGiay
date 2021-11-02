@extends('backend.layout.index')

@section('content')

    <section class="content">
        <div class="timeline-item">

            <h3 class="timeline-header"><a href="#">{{Auth::user()->role->name}} {{Auth::user()->name}}</a>. Welcome you comeback to admin website...</h3>
            <hr>
            <div class="timeline-body">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe width="600" height="445" src="https://www.youtube.com/embed/wVk9lbf7Tuk"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>

        </div>
    </section>

@endsection


