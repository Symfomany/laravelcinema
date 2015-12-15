{{--Header logout --}}
@include('Partial/_header_logout')


<section id="content_wrapper">

    <section id="content">
         @section('content')@show
    </section>

</section>

@include('Partial/_footer')
