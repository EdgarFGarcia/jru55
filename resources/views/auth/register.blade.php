@extends('layouts.app')

@section('content')
<div class="container">
    @if(count($errors) > 0)
    @foreach($errors->all() as $error)
        <div class="alert alert-danger">
            {{$error}}
        </div>
    @endforeach
    @endif

    @if(session('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-success">
            {{session('error')}}
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                        @csrf

                        <div class="form-group row">
                            {{Form::label('name', 'Username', ['class' => 'col-md-2 col-form-label text-md-right'])}}
                            {{Form::text('name', '', ['class' => 'col-md-8 form-control', 'id' => 'username', 'required', 'autofocus', 'placeholder' => 'Username *'])}}
                        </div>

                        <div class="form-group row">
                            {{Form::label('idNumber', 'ID Number', ['class' => 'col-md-2 col-form-label text-md-right'])}}
                            {{Form::text('idNumber', '', ['class' => 'col-md-8 form-control', 'id' => 'username', 'required', 'autofocus', 'placeholder' => 'Username *'])}}
                        </div>

                        <div class="form-group row">
                            {{Form::label('password', 'Password *', ['class' => 'col-md-2 col-form-label text-md-right'])}}
                            {{Form::password('password', ['class' => 'col-md-8 form-control', 'required', 'placeholder' => 'Password *'])}}
                        </div>

                        <div class="form-group row">
                            {{Form::label('password_confirmation', 'Confirm Password', ['class' => 'col-md-2 col-form-label text-md-right'])}}
                            {{Form::password('password_confirmation', ['class' => 'col-md-8 form-control', 'placeholder' => 'Confirm Password *'])}}
                        </div>

                        <div class="form-group row">
                            {{Form::label('firstname', 'Firstname', ['class' => 'col-md-2 col-form-label text-md-right'])}}
                            {{Form::text('firstname', '', ['class' => 'col-md-8 form-control', 'id' => 'firstname', 'required', 'autofocus', 'placeholder' => 'Firstname *'])}}
                        </div>

                        <div class="form-group row">
                            {{Form::label('middlename', 'Middlename', ['class' => 'col-md-2 col-form-label text-md-right'])}}
                            {{Form::text('middlename', '', ['class' => 'col-md-8 form-control', 'id' => 'middlename', 'required', 'autofocus', 'placeholder' => 'Middlename *'])}}
                        </div>

                        <div class="form-group row">
                            {{Form::label('lastname', 'Lastname', ['class' => 'col-md-2 col-form-label text-md-right'])}}
                            {{Form::text('lastname', '', ['class' => 'col-md-8 form-control', 'id' => 'lastname', 'required', 'autofocus', 'placeholder' => 'Lastname *'])}}
                        </div>

                        <div class="form-group row">
                            {{Form::label('gender', 'Gender', ['class' => 'col-md-2 col-form-label text-md-right'])}}
                            <select name="gender" id="gender" class="col-md-8 form-control" required autofocus>
                                <option value="">SELECT</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                                <a href="/" type="submit" class="btn btn-danger">
                                    Cancel
                                </a>
                            </div>
                        </div>

                        {{--<div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>--}}
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
