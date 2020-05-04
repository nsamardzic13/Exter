@extends('layouts.app')

@section('content')
    <div class="container flex">
        <div class="row pt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h4 style="margin-top: 5px">My Information</h4></div>

                    <div class="card-body">
                        <form method="POST" action="/user/{{ $user->id }}/edit" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="firstname" class="col-md-4 col-form-label text-md-right">{{ __('First name') }}
                                    <span class="addon"><i class="fas fa-user"></i></span></label>
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
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}
                                    <span class="addon"><i class="fa fa-paper-plane"></i></span></label>

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
                                <label for="birth_year" class="col-md-4 col-form-label text-md-right">{{ __('Birth Year') }}
                                <span class="addon"><i class="fas fa-calendar"></i></span></label>

                                <div class="col-md-6">
                                    <input id="birth_year" type="number" class="form-control" name="birth_year"  min="1900" max="{{ now()->year }}" step="1" autocomplete="birth_year" value="{{ $user->birth_year }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}
                                <span class="addon"><i class="fas fa-map-marked-alt"></i></span></label>

                                <div class="col-md-6">
                                    <input id="address" type="text" class="form-control" name="address" value="{{ $user->street_name }}" autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone_number" class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}
                                <span class="addon"><i class="fas fa-phone"></i></span></label>

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
                                <label for="about_me" class="col-md-4 col-form-label text-md-right">{{ __('About Me') }}
                                <span class="addon"><i class="fas fa-edit"></i></span></label>

                                <div class="col-md-6">
                                    <textarea id="about_me" class="form-control" name="about_me" autocomplete="about_me" placeholder="Something about myself">{{ $user->description }}</textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="profile_pic" class="col-md-4 col-form-label text-md-right">{{ __('Profile Image') }}
                                <span class="addon"><i class="fas fa-image"></i></span></label>

                                <div class="col-md-6">
                                    <input id="profile_pic" type="file" class="form-control inputfile" name="profile_pic" autocomplete="profile_pic">
                                    <label for="profile_pic"><i class="fas fa-upload" style="margin-right: 4px"></i> Choose a file</label>
                                </div>
                            </div>

                            @if ($user->user_type == True)
                            <div class="form-group row">
                                <label for="multiple_images" class="col-md-4 col-form-label text-md-right">{{ __('Multiple Images') }}
                                <span class="addon"><i class="fas fa-images"></i></span></label>
                                <div class="col-md-6">
                                    <input id="multiple_images" type="file" class="form-control inputfile" name="multiple_images[]" autocomplete="multiple_images" multiple>
                                    <label for="multiple_images"><i class="fas fa-upload" style="margin-right: 4px"></i> Choose files</label>
                                    <p style="margin-top: 1px"><strong>You can upload multiple images for gallery only if you are Business!</strong></p>
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
                                    <button type="submit" class="btn btn-success submit">
                                        Submit changes
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4" style="text-align: center">
                <img src="{{ asset('images/landing/settings.svg')}}" style="width: 320px; margin-top: 80px">
                <div class="zoom">
                    <div class="icon-stack-sm mb-3" style="margin-top:15px"><i class="fas fa-question-circle"></i></div>
                    <h4>Too much information?</h4>
                    <p>To make your experience of exploring events more easier and faster we need some additional information.
                    And if you are added to a group it would be nice if they could find out something about you :) </p>
                </div>
            </div>
        </div>
    </div>
@endsection
