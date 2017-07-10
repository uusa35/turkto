@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-4 col-md-push-4" style="margin-top: 20%;">
            <div class="panel panel-default">
                <div class="panel-heading">Resend Activation Token</div>
                <div class="panel-body">
                    <form action="{{ action('HomeController@postResendActivation') }}" method="post" class="form-horizontal">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="email">email</label>
                                <input type="email" name="email" id="" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-4 col-lg-push-8">
                                <input type="submit" name="submit" class="btn btn-default">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection