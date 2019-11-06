@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <h2>{{ __('profile.Profile') }}</h2>

                    <div class="card-body">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('profile') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('profile.E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$user->email}}" required autocomplete="email" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('profile.Complete Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{$user->name}}" required autocomplete="email" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="lang" class="col-md-4 col-form-label text-md-right">{{ __('profile.Pref Lang') }}</label>

                                <div class="col-md-6">
                                   <select id="lang" name="lang">
                                   @foreach ($languages as $key => $value)
                                       <option value="{{ $key }}"
                                               @if ($key == $user->pref_lang))
                                               selected="selected"
                                               @endif
                                       >{{ $value }}</option>
                                   @endforeach
                                   </select>


                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('profile.Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password">

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="newPassword" class="col-md-4 col-form-label text-md-right">{{ __('profile.New Password') }}</label>

                                <div class="col-md-6">
                                    <input id="newPassword" type="password" class="form-control" name="newPassword"/>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="confirmNewPassword" class="col-md-4 col-form-label text-md-right">{{ __('profile.Confirm New Password') }}</label>

                                <div class="col-md-6">
                                    <input id="confirmNewPassword" type="password" class="form-control" name="confirmNewPassword"/>

                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('profile.Save') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
    </div>
    </div>
@endsection
