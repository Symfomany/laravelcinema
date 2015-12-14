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
    <script>
        $(document).ready(function(){

        })
    </script>
@endsection



@section('content')

    <div class="row admin-form theme-primary">
        <div class="col-md-12">

            <div class="panel">

                <div class="panel-heading">
                    <span class="panel-title"><i class="fa fa-plus"></i> Création de film</span>
                </div>

                <div class="panel-body">
                    @if(count($errors->all()))
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form enctype='multipart/form-data'  novalidate method="post" action="{{ route('movies_store') }}"  id="form-validate"  enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="type" class="control-label">Type</label>
                                    <select name="type" class="form-control">
                                        <option @if(old('type') == "long-metrage") selected @endif value="long-metrage">Long-Métrage</option>
                                        <option @if(old('type') == "court-metrage") selected @endif value="court-metrage">Court-Métrage</option>
                                    </select>
                                    @if ($errors->has('type'))
                                        <p class="help-block text-danger">
                                            {{ $errors->first('type') }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-9">

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
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group form-group-md">
                                    <div class="input-group">
                                          <span class="input-group-addon">
                                            <i class="fa fa-clock-o"></i>
                                          </span>
                                        <input value="{{ old('date_release') }}" required placeholder="dd/mm/YYYY" type="text" name="date_release" class="datepicker form-control">
                                    </div>
                                    @if ($errors->has('date_release'))
                                        <p class="help-block text-danger">
                                            {{ $errors->first('date_release') }}
                                        </p>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group form-group-md">
                                    <label for="image" class="field prepend-icon append-button file">
                                        <span class="button btn-primary">Choisir une image</span>
                                        <input required onchange="document.getElementById('image').value = this.value;" accept="image/*" capture="capture" type="file" id="image" name="image" class="gui-file">
                                        <input type="text" class="gui-input" id="image" placeholder="Image de film">
                                        <label class="field-icon">
                                            <i class="fa fa-upload"></i>
                                        </label>
                                    </label>
                                    @if ($errors->has('image'))
                                        <p class="help-block text-danger">
                                            {{ $errors->first('image') }}
                                        </p>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-5">
                                <label class="field prepend-icon">
                                    <textarea placeholder="http://youtube.com" class="gui-textarea"
                                              id="comment" name="trailer" placeholder="Text area">{{ old('trailer') }}</textarea>
                                    <label for="comment" class="field-icon">
                                        <i class="fa fa-youtube"></i>
                                    </label>
                                        <span class="input-footer">
                                          <strong>Video:</strong>Youtube, Dailymotion, Vimeo
                                        </span>
                                </label>
                                @if ($errors->has('trailer'))
                                    <p class="help-block text-danger">{{ $errors->first('trailer') }}</p>
                                @endif
                            </div>
                            <div class="form-group">

                                    <label class="switch switch-primary">
                                        <input @if(old('visible')) checked @endif type="checkbox" name="visible" id="t4" value="1" checked="">
                                        <label for="t4" data-on="Oui" data-off="Non"></label>
                                        <span>Film visible ?</span>
                                    </label>
                                    <label class="switch switch-primary">
                                        <input  @if(old('cover')) checked @endif type="checkbox" name="cover" id="t5" value="1" checked="">
                                        <label for="t5" data-on="Oui" data-off="Non"></label>
                                        <span>Film mis en couverture ?</span>
                                    </label>
                                    @if ($errors->has('visible'))
                                        <p class="help-block text-danger">{{ $errors->first('visible') }}</p>
                                    @endif
                                    @if ($errors->has('cover'))
                                        <p class="help-block text-danger">{{ $errors->first('cover') }}</p>
                                    @endif
                                <hr />
                                <div class="row">
                                    <span class="rating block">
                                      <span class="lbl-text">Note de presse</span>
                                      <input @if(old('note_presse') == 1) checked @endif value="1" class="rating-input" id="r5" type="radio" name="note_presse">
                                      <label class="rating-star" for="r5">
                                          <i class="fa fa-star"></i>
                                      </label>
                                      <input @if(old('note_presse') == 2) checked @endif value="2" class="rating-input" id="r4" type="radio" name="note_presse">
                                      <label class="rating-star" for="r4">
                                          <i class="fa fa-star"></i>
                                      </label>
                                      <input  @if(old('note_presse') == 3) checked @endif value="3" class="rating-input" id="r3" type="radio" name="note_presse">
                                      <label class="rating-star" for="r3">
                                          <i class="fa fa-star"></i>
                                      </label>
                                      <input  @if(old('note_presse') == 4) checked @endif value="4" class="rating-input" id="r2" type="radio" name="note_presse">
                                      <label class="rating-star" for="r2">
                                          <i class="fa fa-star"></i>
                                      </label>
                                      <input  @if(old('note_presse') == 5) checked @endif value="5" class="rating-input" id="r1" type="radio" name="note_presse">
                                      <label class="rating-star" for="r1">
                                          <i class="fa fa-star"></i>
                                      </label>
                                    </span>
                                </div>
                                @if ($errors->has('note_presse'))
                                    <p class="help-block text-danger">
                                        {{ $errors->first('note_presse') }}
                                    </p>
                                @endif
                            </div>

                            <div class="form-group">
                                <textarea placeholder="Votre synopsis..." name="synopsis" class="markdown form-control">{{ old('synopsis') }}</textarea>
                                @if ($errors->has('synopsis'))
                                    <p class="help-block text-danger">
                                        {{ $errors->first('synopsis') }}
                                    </p>
                                @endif
                            </div>

                            <div class="form-group">
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
                                        <select name="lang" class="form-control form-group-margin">
                                            <option @if(old('lang') == "fr") selected @endif value="fr">Français</option>
                                            <option @if(old('lang') == "en") selected @endif value="en">Anglais</option>
                                            <option @if(old('lang') == "it") selected @endif value="it">Italien</option>
                                            <option @if(old('lang') == "es") selected @endif value="es">Espagnol</option>
                                        </select>
                                        @if ($errors->has('lang'))
                                            <p class="help-block text-danger">{{ $errors->first('lang') }}</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-4">

                                    <div class="form-group">
                                        <label for="bo" class="control-label">Bande originale</label>
                                        <select name="bo" class="form-control form-group-margin">
                                            <option @if(old('bo') == "vf") selected @endif value="vf">VF</option>
                                            <option @if(old('bo') == "vostfr") selected @endif value="vostfr">VOSTFR</option>
                                            <option @if(old('bo') == "vost") selected @endif value="vost">VOST</option>
                                            <option @if(old('bo') == "vo") selected @endif value="vo">VO</option>
                                        </select>
                                        @if ($errors->has('bo'))
                                            <p class="help-block text-danger">{{ $errors->first('bo') }}</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-4">

                                    <div class="form-group">
                                        <label for="distributeur" class="col-sm-2 control-label">Distributeur</label>
                                        <input placeholder="ex: Warner Bros" name="distributeur" value="{{ old('distributeur') }}" class="form-control">
                                        @if ($errors->has('distributeur'))
                                            <p class="help-block text-danger">{{ $errors->first('distributeur') }}</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-4">

                                    <div class="form-group">
                                        <label for="duree" class="control-label">Durée (h)</label>
                                        <input  type="text" name="duree" value="{{ old('duree') }}" class="slider-countbox form-control" id="duree">
                                        <div class="slider-wrapper slider-primary">
                                            <div id="slider" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all slider-primary"></div>
                                        </div>
                                        @if ($errors->has('duree'))
                                            <p class="help-block text-danger">{{ $errors->first('duree') }}</p>
                                        @endif
                                    </div>
                                </div>



                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="budget" class="control-label">Budget (€)</label>
                                        <input placeholder="ex: 50 000 000€" type="text" name="budget" value="{{ old('budget') }}" class="form-control" id="budget">
                                        @if ($errors->has('budget'))
                                            <p class="help-block text-danger">{{ $errors->first('budget') }}</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="annee" class="control-label">Année</label>
                                        <input type="text" name="annee" value="{{ old('annee') }}" class="form-control" id="annee" placeholder="2015">
                                        <p class="help-block">Format accepté : YYYY</p>
                                        @if ($errors->has('annee'))
                                            <p class="help-block text-danger">{{ $errors->first('annee') }}</p>
                                        @endif
                                    </div>
                                </div>


                                <div class="col-md-4">

                                    <div class="form-group">
                                        <div class="col-sm-10">
                                            <select name="categories_id" value="{{ old('categories_id') }}" class="form-control form-group-margin">
                                                @foreach($categories as $categorie)
                                                    <option @if($categorie->id == old('categories_id')) selected @endif  value="{{ $categorie->id }}">{{ $categorie->title }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('categories_id'))
                                                <p class="help-block text-danger">{{ $errors->first('categories_id') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="col-sm-10">
                                            <select name="actors[]"  multiple="multiple" class="form-control form-group-margin">
                                                @foreach ($actors as $actor)
                                                    <option @if(in_array($actor->id, old('actors', []) )) selected @endif value="{{ $actor->id }}">{{ $actor->firstname }} {{ $actor->lastname }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('actors'))
                                                <p class="help-block text-danger">{{ $errors->first('actors') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="col-sm-10">
                                            <select name="directors[]" multiple="multiple" class="">
                                                @foreach ($directors as $director)
                                                    <option  @if(in_array($director->id, old('directors', []) )) selected @endif  value="{{ $director->id }}">{{ $director->firstname }} {{ $director->lastname }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('directors'))
                                                <p class="help-block text-danger">{{ $errors->first('directors') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <hr />

                            <button style="width: 100%" type="submit" class="btn btn-lg btn-primary">
                                <i class="fa fa-check"></i> Enregistrer ce film
                            </button>

                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection