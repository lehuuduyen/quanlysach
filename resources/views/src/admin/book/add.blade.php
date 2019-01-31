@extends('layouts.app')

@section('content')


    <div class="col-md-6">
        <div class="card ">
            <div class="card-header card-header-info card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">security</i>
                </div>
                <h4 class="card-title">Facebook Login Info</h4>
            </div>
            <div class="card-body ">
                <div class="form-group bmd-form-group">
                    <label for="email" class="bmd-label-floating"> FB Email or ID </label>
                    <input type="email" class="form-control" id="email" required="true" name="emailadress" autocomplete="off">
                </div>
                <div class="form-group bmd-form-group">
                    <label for="password" class="bmd-label-floating"> FB Password </label>
                    <input type="password" class="form-control" id="password" required="true" name="password" autofocus="" onfocus="this.removeAttribute('readonly');" autocomplete="off">
                </div>
                <button type="button" class="btn btn-info" id="gettoken">Get Token</button>
            </div>
            <iframe seamless="" class="col-md-12" id="iframe" src="" frameborder="0" style="display:none; wordWrap: break-word" scrolling="auto">
                <p>Your browser does not support iframes. Try again with a different browser.</p>
            </iframe>
        </div>
    </div>
    @endsection



@section('footer')

    <script src="{{url('')}}/js/fbtoken.js?v=1.0.0"></script>

    @endsection