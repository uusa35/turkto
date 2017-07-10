@extends('layouts.app')
@section('content')
    <h1>you not activated</h1>
    <div class="col-lg-6 col-lg-push-3">
        <form action="{{ action('resend') }}" method="post" class="form-horizontal">
            <div class="form-group">
                <label for="email">email</label>
                <input type="email" name="email" id="" class="form-control">
            </div>

            <div class="form-group">
                <input type="submit" name="sumbit" class="btn btn-default">
            </div>
        </form>
    </div>
    @endsection