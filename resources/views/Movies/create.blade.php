{{--Héritage de ma vue mère--}}
@extends('layout')

@section('famille')
    Créer un film
@endsection




@section('css')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/plugins/select2/css/core.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/plugins/datepicker/css/bootstrap-datetimepicker.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/plugins/summernote/summernote.css') }}">
@endsection



@section('js')
    @parent
    <script src="{{ asset('vendor/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('vendor/plugins/jquerymask/jquery.maskedinput.min.js') }}"></script>
    <script src="{{ asset('vendor/plugins/summernote/summernote.min.js') }}"></script>
    <script src="{{ asset('vendor/plugins/markdown/markdown.js') }}"></script>
    <script src="{{ asset('vendor/plugins/markdown/bootstrap-markdown.js') }}"></script>

    <script src="{{ asset('vendor/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('vendor/plugins/datepicker/js/bootstrap-datetimepicker.min.js') }}"></script>

    <script src="{{ asset('js/form.js') }}"></script>

@endsection





@section('content')

    <div class="row admin-form theme-primary">
        <div class="col-md-12">

            <div class="panel">

                <div class="panel-heading">
                    <span class="panel-title"><i class="fa fa-plus"></i> Création de film</span>
                </div>


                <div class="panel-body">


                    <form enctype='multipart/form-data'  novalidate method="post" action="{{ route('movies_store') }}" class="form-horizontal" id="form-validate"  enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="type" class="control-label">Type</label>

                            <select name="type" class="form-control">
                                <option value="long-metrage">Long-Métrage</option>
                                <option value="court-metrage">Court-Métrage</option>
                            </select>
                        </div>

                        <div class="form-group form-group-md">
                            <label for="title" class="control-label">Titre</label>

                            <div class="input-group">
                                  <span class="input-group-addon">
                                    <i class="fa fa-pencil"></i>
                                  </span>
                                <input value="{{ old('title') }}" required placeholder="Votre titre" type="text"
                                       name="title" class="form-control">

                            </div>
                            @if ($errors->has('title'))
                                <p class="help-block text-danger">
                                    {{ $errors->first('title') }}
                                </p>
                            @endif
                        </div>


                        <div class="form-group form-group-md">
                            <label for="title" class="control-label">Date de sortie</label>

                            <div class="input-group">
                                  <span class="input-group-addon">
                                    <i class="fa fa-clock-o"></i>
                                  </span>
                                <input value="{{ old('date_release') }}" required placeholder="dd/mm/YYYY"
                                       type="text" name="date_release" class="datepicker form-control">

                            </div>
                            @if ($errors->has('date_release'))
                                <p class="help-block text-danger">
                                    {{ $errors->first('date_release') }}
                                </p>
                            @endif
                        </div>

                        {{--<div class="section">--}}
                            {{--<label class="field prepend-icon append-button file">--}}
                                {{--<span class="button btn-primary">Choose File</span>--}}
                                {{--<input type="file" class="gui-file" name="file1" id="file1" onchange="document.getElementById('uploader1').value = this.value;">--}}
                                {{--<input type="text" class="gui-input" id="uploader1" placeholder="Please Select A File">--}}
                                {{--<label class="field-icon">--}}
                                    {{--<i class="fa fa-upload"></i>--}}
                                {{--</label>--}}
                            {{--</label>--}}
                        {{--</div>--}}

                        <div class="form-group form-group-md">
                            <div class="section">

                                <label for="image" class="field prepend-icon append-button file">
                                <span class="button btn-primary">Choisir une image</span>
                                <input required onchange="document.getElementById('image').value = this.value;" accept="image/*" capture="capture" type="file" id="image" name="image" class="gui-file">
                                <input type="text" class="gui-input" id="image" placeholder="Choisissez une image de film">
                                <label class="field-icon">
                                    <i class="fa fa-upload"></i>
                                </label>
                            </div>
                            @if ($errors->has('image'))
                                <p class="help-block text-danger">
                                    {{ $errors->first('image') }}
                                </p>
                            @endif

                        </div>




                        <div class="form-group">
                            <label for="synopsis" class="control-label">Synopsis</label>

                    <textarea placeholder="Votre synopsis..." name="synopsis" class="markdown form-control">{{ old('synopsis') }}</textarea>
                            @if ($errors->has('synopsis'))
                                <p class="help-block text-danger">
                                    {{ $errors->first('synopsis') }}
                                </p>
                            @endif

                        </div>

                        <div class="form-group">
                            <label for="description" class="control-label">Description</label>

                    <textarea placeholder="Votre description..." name="description" class="wysiwyg form-control">{{ old('description') }}</textarea>

                            @if ($errors->has('description'))
                                <p class="help-block text-danger">
                                    {{ $errors->first('description') }}
                                </p>
                            @endif
                        </div>

                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="lang" class="col-sm-2 control-label">Langue</label>
                                        <select name="lang" value="{{ old('lang') }}" class="form-control form-group-margin">
                                            <option>fr</option>
                                            <option>en</option>
                                            <option>en_US</option>
                                        </select>
                                        @if ($errors->has('lang'))
                                            <p class="help-block text-danger">{{ $errors->first('lang') }}</p>
                                        @endif
                                </div> <!-- / .form-group -->
                            </div> <!-- / .form-group -->

                            <div class="col-md-4">

                                <div class="form-group">
                                    <label for="bo" class="control-label">Bande originale</label>
                                        <select name="bo" value="{{ old('bo') }}" class="form-control form-group-margin">
                                            <option>VF</option>
                                            <option>VOSTFR</option>
                                            <option>VOST</option>
                                            <option>VO</option>
                                        </select>
                                        @if ($errors->has('bo'))
                                            <p class="help-block text-danger">{{ $errors->first('bo') }}</p>
                                        @endif
                                </div> <!-- / .form-group -->
                            </div> <!-- / .form-group -->

                            <div class="col-md-4">

                                <div class="form-group">
                                    <label for="distributeur" class="col-sm-2 control-label">Distributeur</label>
                                    <input placeholder="ex: Warner Bros" name="distributeur" value="{{ old('distributeur') }}" class="form-control">
                                    @if ($errors->has('distributeur'))
                                        <p class="help-block text-danger">{{ $errors->first('distributeur') }}</p>
                                    @endif
                                </div> <!-- / .form-group -->
                            </div> <!-- / .form-group -->

                            <div class="col-md-4">

                                <div class="form-group">
                                    <label for="duree" class="control-label">Durée (h)</label>
                                        <input placeholder="ex: 2h." type="text" name="duree" value="{{ old('duree') }}" class="slider-countbox form-control" id="duree">
                                    <div class="slider-wrapper slider-primary">
                                        <div id="slider" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all slider-primary"></div>
                                    </div>
                                    @if ($errors->has('duree'))
                                        <p class="help-block text-danger">{{ $errors->first('duree') }}</p>
                                    @endif
                                </div> <!-- / .form-group -->
                            </div> <!-- / .form-group -->



                            <div class="col-md-4">

                                <div class="form-group">
                                    <label for="budget" class="control-label">Budget (€)</label>
                                        <input placeholder="ex: 50 000 000€" type="text" name="budget" value="{{ old('budget') }}" class="form-control" id="budget">
                                        @if ($errors->has('budget'))
                                            <p class="help-block text-danger">{{ $errors->first('budget') }}</p>
                                        @endif
                                </div> <!-- / .form-group -->
                            </div> <!-- / .form-group -->

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="annee" class="control-label">Année</label>
                                        <input type="text" name="annee" value="{{ old('annee') }}" class="form-control" id="annee" placeholder="2015">
                                        <p class="help-block">Format accepté : YYYY</p>
                                        @if ($errors->has('annee'))
                                            <p class="help-block text-danger">{{ $errors->first('annee') }}</p>
                                        @endif
                                </div>
                            </div> <!-- / .form-group -->



                        </div>




                        <button type="submit" class="btn btn-lg btn-primary">
                            <i class="fa fa-check"></i> Enregistrer ce film
                        </button>

                    </form>
                </div>

            </div>
        </div>
@endsection