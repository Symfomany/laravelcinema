@extends('layout')


@section('famille')
    Gerer les administrateurs
@endsection

@section('content')

    <div class="row admin-form theme-primary animated fadeIn">
        <div class="col-md-8">

            <div class="panel panel-primary panel-bordered">

                <div class="panel-heading">
                    <h3>Editer d'un administrateur <i>{{ $administrator->firstname }} {{ $administrator->lastname }}</i></h3>
                </div>
                <div class="panel-body">
                    <form enctype='multipart/form-data'  novalidate method="post"
                          action="{{ route('administrators_store', ['id' => $administrator->id]) }}"  >

                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group form-group-md">
                                    <label for="title" class="control-label">Prénom</label>

                                    <div class="input-group">
                                          <span class="input-group-addon">
                                            <i class="fa fa-pencil"></i>
                                          </span>
                                        <input value="{{ $administrator->firstname }}" required placeholder="Ex: Julien"
                                               type="text" name="firstname" class="form-control">

                                    </div>
                                    @if ($errors->has('firstname'))
                                        <p class="help-block text-danger">
                                            {{ $errors->first('firstname') }}
                                        </p>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group form-group-md">
                                    <label for="title" class="control-label">Nom</label>

                                    <div class="input-group">
                                          <span class="input-group-addon">
                                            <i class="fa fa-pencil"></i>
                                          </span>
                                        <input value="{{ $administrator->lastname }}" required placeholder="Ex: Boyer"
                                               type="text" name="lastname" class="form-control">

                                    </div>
                                    @if ($errors->has('lastname'))
                                        <p class="help-block text-danger">
                                            {{ $errors->first('lastname') }}
                                        </p>
                                    @endif
                                </div>


                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group form-group-md">
                                    <label for="title" class="control-label">Email</label>

                                    <div class="input-group">
                                              <span class="input-group-addon">
                                                <i class="fa fa-envelope"></i>
                                              </span>
                                        <input value="{{ $administrator->email }}" required placeholder="Ex: julien@meetserious.com"
                                               type="text" name="email" class="form-control">

                                    </div>
                                    @if ($errors->has('email'))
                                        <p class="help-block text-danger">
                                            {{ $errors->first('email') }}
                                        </p>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">

                                <div class="form-group form-group-md">
                                    <label for="image" class="field prepend-icon append-button file">
                                        <span class="button btn-primary">Choisir une image</span>
                                        <input required onchange="document.getElementById('image').value = this.value;" accept="image/*" capture="capture" type="file" id="image" name="image" class="gui-file">
                                        <input type="text" class="gui-input" id="image" placeholder="Image du profil">
                                        <label class="field-icon">
                                            <i class="fa fa-upload"></i>
                                        </label>
                                    </label>
                                    <div class="img-responsive">
                                        <img  src="{{ $administrator->photo }}"
                                              class="img-responsive col-md-3"
                                                />
                                    </div>
                                    @if ($errors->has('image'))
                                        <p class="help-block text-danger">
                                            {{ $errors->first('image') }}
                                        </p>
                                    @endif
                                </div>
                            </div>

                        </div>


                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group form-group-md">
                                    <label for="title" class="control-label">Mot de passe</label>

                                    <div class="input-group">
                                          <span class="input-group-addon">
                                            <i class="fa fa-lock"></i>
                                          </span>
                                        <input required placeholder="******"
                                               type="password" name="password" class="form-control">

                                    </div>
                                    @if ($errors->has('password'))
                                        <p class="help-block text-danger">
                                            {{ $errors->first('password') }}
                                        </p>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">

                                <div class="form-group form-group-md">
                                    <label for="title" class="control-label">Resaisissez votre mot de passe</label>

                                    <div class="input-group">
                                      <span class="input-group-addon">
                                        <i class="fa fa-lock"></i>
                                      </span>
                                        <input  required placeholder="******"
                                               type="password" name="password_confirmation" class="form-control">

                                    </div>
                                    @if ($errors->has('password_confirmation'))
                                        <p class="help-block text-danger">
                                            {{ $errors->first('password_confirmation') }}
                                        </p>
                                    @endif
                                </div>
                            </div>

                        </div>

                        <div class="form-group form-group-md">

                            <label class="field prepend-icon">
                                <textarea class="gui-textarea" id="description" name="description" placeholder="Année de naissance, culutures, passions...">{{ $administrator->description }}</textarea>
                                <label for="comment" class="field-icon">
                                    <i class="fa fa-comments"></i>
                                </label>
                            <span class="input-footer">
                              <strong>Ps:</strong>Raconte qqch sur sa biographie...</span>
                            </label>

                            @if ($errors->has('description'))
                                <p class="help-block text-danger">
                                    {{ $errors->first('description') }}
                                </p>
                            @endif
                        </div>




                        <div class="form-group">

                            <label class="switch switch-primary">
                                <input @if( $administrator->super_admin == 1) checked @endif type="checkbox" name="super_admin" id="t4" value="1" checked="">
                                <label for="t4" data-on="Oui" data-off="Non"></label>
                                <span>Utilisateur est t-il super administrateur?</span>
                            </label>

                            @if ($errors->has('super_admin'))
                                <p class="help-block text-danger">{{ $errors->first('super_admin') }}</p>
                            @endif

                        </div>

                        <hr />


                        <button  type="submit" class="btn btn-lg btn-primary">
                            <i class="fa fa-save"></i> Editer cetutilisateur
                        </button>


                        {{ csrf_field() }}

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection