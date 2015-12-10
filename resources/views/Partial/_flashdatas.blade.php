@if (session('success'))
    <div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <i class="fa fa-times"></i> {{ session('success') }}
    </div>
@endif

@if (session('warning'))
    <div class="alert alert-warning">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <i class="fa fa-times"></i> {{ session('warning') }}
    </div>
@endif

@if (session('info'))
    <div class="alert alert-info">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <i class="fa fa-times"></i> {{ session('info') }}
    </div>
@endif

@if (session('danger'))
    <div class="alert alert-danger">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <i class="fa fa-times"></i> {{ session('danger') }}
    </div>
@endif