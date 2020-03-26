@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-start">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('My Information') }}</div>

                    <div class="card-body">
                        <form method="POST" action="/user/{{ $user->id }}/edit" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="firstname" class="col-md-4 col-form-label text-md-right">{{ __('First name') }} </label>
                                <div class="col-md-6">
                                    <input id="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ $user->firstname }}" disabled autocomplete="firstname" autofocus>
                            </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Username') }} </label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" disabled autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="birth_year" class="col-md-4 col-form-label text-md-right">{{ __('Birth Year') }}</label>

                                <div class="col-md-6">
                                    <input id="birth_year" type="number" class="form-control" name="birth_year"  min="1900" max="{{ now()->year }}" step="1" autocomplete="birth_year" value="{{ $user->birth_year }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                                <div class="col-md-6">
                                    <input id="address" type="text" class="form-control" name="address" value="{{ $user->street_name }}" autocomplete="address">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('City') }}</label>

                                <div class="col-md-6">
                                    <input id="city" type="text" class="form-control" name="city" value="{{ $user->city_name }}" autocomplete="city">
                                </div>
                            </div>

                            {{--Maybe we can remove zip code - we need to check with google maps api --}}
                            <div class="form-group row">
                                <label for="zip_code" class="col-md-4 col-form-label text-md-right">{{ __('Zip Code') }}</label>

                                <div class="col-md-6">
                                    <input id="zip_code" type="number" class="form-control" name="zip_code" min="0" value="{{ $user->zip_code }}" autocomplete="zip_code">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone_number" class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}</label>

                                <div class="col-md-6">
                                    <input id="phone_number" type="tel" class="form-control" placeholder="+38591123123"
                                           pattern="(([+][(]?[0-9]{1,3}[)]?)|([(]?[0-9]{4}[)]?))\s*[)]?[-\s\.]?[(]?[0-9]{1,3}[)]?([-\s\.]?[0-9]{3})([-\s\.]?[0-9]{3,4})"
                                           name="phone_number" value="{{ $user->phone_number }}" autocomplete="phone_number">
                                    <small>+385...and your number</small>
                                </div>

                                @error('phone_number')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label for="about_me" class="col-md-4 col-form-label text-md-right">{{ __('About Me') }}</label>

                                <div class="col-md-6">
                                    <textarea id="about_me" class="form-control" name="about_me" autocomplete="about_me" placeholder="Something about myself">{{ $user->description }}</textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="profile_pic" class="col-md-4 col-form-label text-md-right">{{ __('Profile Image') }}</label>

                                <div class="col-md-6">
                                    <input id="profile_pic" type="file" class="form-control" name="profile_pic" autocomplete="profile_pic">
                                </div>
                            </div>

                            @if ($user->user_type == True)
                            <div class="form-group row">
                                <label for="multiple_images" class="col-md-4 col-form-label text-md-right">{{ __('Multiple Images') }}</label>
                                <div class="col-md-6">
                                    <input id="multiple_images" type="file" class="form-control" name="multiple_images[]" autocomplete="multiple_images" multiple>
                                    <strong>You can upload multiple images only if you are Business!</strong>
                                </div>
                            </div>
                            @endif

                            <div class="form-group row">
                                <label for="user_type" class="col-md-4 col-form-label text-md-right">{{ __('Account Type') }}</label>

                                <div class="col-md-6">
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn active btn-outline-quest">
                                            <input type="radio" name="user_type" id="user_type" value=0 autocomplete="off"
                                                   {{ !$user->user_type ? 'checked' : '' }}> Private
                                        </label>
                                        <label class="btn btn-outline-quest">
                                            <input type="radio" name="user_type" id="user_type" value=1 autocomplete="off"
                                                {{ $user->user_type ? 'checked' : '' }}> Business
                                        </label>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-success">
                                        {{ __('Submit Changes') }}
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
