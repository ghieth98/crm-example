@extends('layouts.app')
@section('content')
    @if(session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">User Information</div>

        <div class="card-body">
            <form action="{{ route('profile.update') }}" method="post">
                @csrf
                @method('put')

                <div class="form-group">
                    <label class="required" for="first_name">First name</label>
                    <input class="form-control {{ $errors->has('first_name') ? 'is-invaild' : '' }}"
                           type="text" id="first_name" name="first_name"
                           value="{{ old('first_name', auth()->user()->first_name) }}" required>
                    @if($errors->has('first_name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('first_name') }}
                        </div>
                    @endif
                    <span class="help-block"> </span>
                </div>

                <div class="form-group">
                    <label class="required" for="last_name">Last name</label>
                    <input class="form-control {{ $errors->has('last_name') ? 'is-invaild' : '' }}"
                           type="text" id="last_name" name="last_name"
                           value="{{ old('last_name', auth()->user()->last_name) }}" required>
                    @if($errors->has('last_name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('last_name') }}
                        </div>
                    @endif
                    <span class="help-block"> </span>
                </div>

                <div class="form-group">
                    <label class="required" for="address">Address</label>
                    <input class="form-control {{ $errors->has('address') ? 'is-invaild' : '' }}"
                           type="text" id="address" name="address"
                           value="{{ old('address', auth()->user()->address) }}" required>
                    @if($errors->has('address'))
                        <div class="invalid-feedback">
                            {{ $errors->first('address') }}
                        </div>
                    @endif
                    <span class="help-block"> </span>
                </div>

                <div class="form-group">
                    <label class="required" for="phone_number">Phone number</label>
                    <input class="form-control {{ $errors->has('phone_number') ? 'is-invaild' : '' }}"
                           type="text" id="phone_number" name="phone_number"
                           value="{{ old('phone_number', auth()->user()->phone_number) }}" required>
                    @if($errors->has('phone_number'))
                        <div class="invalid-feedback">
                            {{ $errors->first('phone_number') }}
                        </div>
                    @endif
                    <span class="help-block"> </span>
                </div>

                <button class="btn btn-primary" type="submit">
                    Save
                </button>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">Change Password</div>

        <div class="card-body">
            <form action="{{ route('profile.changePassword') }}" method="post">
                @csrf
                <div class="form-group">
                    <label class="required" for="old_password">Old Password</label>
                    <input class="form-control {{ $errors->has('old_password') ? 'is-invaild' : '' }}"
                           type="password" id="old_password" name="old_password" required>
                    @if($errors->has('old_password'))
                        <div class="invalid-feedback">
                            {{ $errors->first('old_password') }}
                        </div>
                    @endif
                    <span class="help-block"> </span>
                </div>

                <div class="form-group">
                    <label class="required" for="new_password">New Password</label>
                    <input class="form-control {{ $errors->has('new_password') ? 'is-invaild' : '' }}"
                           type="password" id="new_password" name="new_password" required>
                    @if($errors->has('new_password'))
                        <div class="invalid-feedback">
                            {{ $errors->first('new_password') }}
                        </div>
                    @endif
                    <span class="help-block"> </span>
                </div>

                <button class="btn btn-primary" type="submit">
                    Save
                </button>
            </form>
        </div>
    </div>
@endsection
