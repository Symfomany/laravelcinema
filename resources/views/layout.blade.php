{{--inclusion du header--}}
@include('Partial/_header')

{{--inclusion de la sidebar--}}
@include('Partial/_sidebar')


<section id="content_wrapper">
    @section('content')
    @show
</section>

{{--inclusion du footer--}}
@include('Partial/_footer')



