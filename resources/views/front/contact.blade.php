
@extends('front.layouts.master')
@section('title','Contact')
@section('bg','https://webcmstavtech.tav.aero/uploads/59f9875dc0e79a3594308ad3/static-pages/main-images/contact-us_1.jpg')
@section('content')

<form method="POST", action="{{route('contact.post')}}">
    @csrf
    @if(session('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>
    @endif
    @if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
        <ul> {{$error}}</ul>

        @endforeach
    </div>
    @endif
    <div class="col-md-8 mx-auto">
        <p>Want to get in touch? Fill out the form below to send me a message and I will get back to you as soon as possible!</p>
      <div class="control-group">
        <div class="form-group floating-label-form-group controls">
          <label>Name</label>
        <input type="text" class="form-control" placeholder="Name" value="{{old('name')}}" name="name" required>
          <p class="help-block text-danger"></p>
        </div>
      </div>
      <div class="control-group">
        <div class="form-group floating-label-form-group controls">
          <label>Email Address</label>
          <input type="email" class="form-control" placeholder="exp:bla@bla.com" value="{{old('email')}}" name="email" required>
          <p class="help-block text-danger"></p>
        </div>
      </div>
      <div class="control-group">
        <div class="form-group col-xs-12 floating-label-form-group controls">
          <label>Phone Number</label>
          <input type="tel" class="form-control" placeholder="exp:5444445555" name="phone" value="{{old('phone')}}" required>
          <p class="help-block text-danger"></p>
        </div>
      </div>
      <div class="control-group">
        <div class="form-group floating-label-form-group controls">
          <label>Message</label>
          <textarea rows="5" class="form-control" placeholder="Message" name="message" value="{{old('message')}}" required></textarea>
          <p class="help-block text-danger"></p>
        </div>
      </div>
      <br>
      <div id="success"></div>
      <button type="submit" class="btn btn-primary" name="sendMessageButton">Send</button>
    </form>
  </div>
  @endsection
