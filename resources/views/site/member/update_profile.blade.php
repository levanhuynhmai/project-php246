@extends('site.layout.member')
@section('content')
    <div class="content-panel">
        <form class="form-horizontal" enctype="multipart/form-data" method="post"
              action="{{ base_url('member/update-profile') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label"><i class="fa fa-info" aria-hidden="true"></i> Last Name</label>

                <input type="text" class="form-control" name="last_name"
                       value="{{ old('last_name', $member->last_name) }}">
            </div>

            <div class="mb-3">
                <label class="form-label"><i class="fa fa-info" aria-hidden="true"></i> First Name (*)</label>
                <input type="text" class="form-control" required name="first_name"
                       value="{{ old('first_name', $member->first_name) }}">
            </div>

            <div class="mb-3">
                <label class="form-label"><i class="fa fa-envelope-o" aria-hidden="true"></i> Email</label>

                <input type="text" class="form-control" @if(!empty($member->email)) readonly
                       @endif value="{{ old('email', $member->email) }}">
            </div>
            <div class="mb-3">
                <label class="form-label"><i class="fa fa-phone-square" aria-hidden="true"></i> Phone</label>

                <input type="text" class="form-control" name="phone" value="{{ old('phone', $member->phone) }}">
            </div>

            <div class="mb-3">
                <label class="form-label"><i class="fa fa-map-pin" aria-hidden="true"></i> Address</label>

                <input type="text" class="form-control" name="address"
                       value="{{ old('address', $member->address) }}">
            </div>

            <div class="mb-3">
                <button class="btn btn-primary" type="submit"><i class="fa fa-save" aria-hidden="true"></i> Update Profile</button>

                <div class="loginbox-textbox">
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <p class="text-danger">- {{$error}}</p>
                        @endforeach
                    @endif
                </div>
            </div>
        </form>
    </div>

@endsection