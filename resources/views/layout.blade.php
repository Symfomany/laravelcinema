{{--inclusion du header--}}
@include('Partial/_header')

{{--inclusion de la sidebar--}}
@include('Partial/_sidebar')


<section id="content_wrapper">

    {{--Fil d'arianne--}}
    @include('Partial/_breadscrumb')

    @include('Partial/_flashdatas')

    <div id="content">
        @section('content')
        @show
    </div>

</section>

{{--inclusion du footer--}}
@include('Partial/_footer')



