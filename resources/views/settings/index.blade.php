@extends('layouts.app')

@section('title') Integrations @stop

@section('content')
    <div id='main-content' role='main'>
        <div class='campaigns-page'>
            <div class='vt-page-header'>
                <div class='vt-page-title'>
                    <h3>
                        <i class='glyphicon glyphicon-cog'></i>
                        Integrations
                    </h3>
                </div>
            </div>
            <div class='vt-page'>
                <div class='vt-default-page'>
                    @include('layouts.alerts.messages')
                    <div class='vt-settings-container'>
                        <div class='vt-option-container'>
                            <a class='logo'>
                                <img src='/assets/img/GetResponse.png'>
                                Get Response
                            </a>
                            <div class='buttons'>
                                @if(isset($emailSettings['GetResponse']))
                                    {!! Form::model($emailSettings['GetResponse'],['url' => 'settings/email-api-disconnect/'.$emailSettings['GetResponse']->id, 'method' => 'DELETE' ]) !!}
                                @else
                                    {!! Form::open(['url' => 'settings/get-response-api-connect', 'method' => 'post' ]) !!}
                                @endif
                                    <div class='input-group'>
                                        {!! Form::text('api_key', null , [ 'class' => 'form-control' , 'placeholder' => 'API Key' , isset($emailSettings['GetResponse'])?'disabled':'' ]) !!}
                                        <span class='input-group-btn'>
                                            @if(isset($emailSettings['GetResponse']))
                                                {!! Form::submit('Disconnect', [ 'class' => 'btn btn-danger' ]) !!}
                                            @else
                                                {!! Form::submit('Connect', [ 'class' => 'btn btn-success' ]) !!}
                                            @endif
                                        </span>
                                    </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                        <div class='vt-option-container'>
                            <a class='logo'>
                                <img src='/assets/img/Aweber.png'>
                                Aweber
                            </a>
                            @if(isset($emailSettings['Aweber']))
                                {!! Form::model($emailSettings['Aweber'],['url' => 'settings/email-api-disconnect/'.$emailSettings['Aweber']->id, 'method' => 'DELETE', 'class' => 'pull-right' ]) !!}
                            @else
                                {!! Form::open(['url' => 'settings/connect-aweber-api', 'method' => 'post', 'class' => 'pull-right' ]) !!}
                            @endif
                                <div class='buttons '>
                                    <div class="pull-left settings_text">Click the Connect button and you will be asked to login into the account.</div>
                                    <div class="pull-right">
                                        <span class=''>
                                            @if(isset($emailSettings['Aweber']))
                                                {!! Form::submit('Disconnect', [ 'class' => 'btn btn-danger' ]) !!}
                                            @else
                                                {!! Form::submit('Connect', [ 'class' => 'btn btn-success' ]) !!}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            {!! Form::close() !!}
                        </div>

                        <div class='vt-option-container'>
                            <a class='logo'>
                                <img src='/assets/img/MailChimp2.png'>
                                MailChimp
                            </a>
                            <div class='buttons'>
                                @if(isset($emailSettings['MailChimp']))
                                    {!! Form::model($emailSettings['MailChimp'],['url' => 'settings/email-api-disconnect/'.$emailSettings['MailChimp']->id, 'method' => 'DELETE' ]) !!}
                                @else
                                    {!! Form::open(['url' => 'settings/connect-mail-chimp-api', 'method' => 'get' ]) !!}
                                @endif
                                    <div class="input-group">
                                        {!! Form::text('mailchimp_api_key', null , [ 'class' => 'form-control' , 'placeholder' => 'Api Key' , isset($emailSettings['MailChimp'])?'disabled':'' ]) !!}
                                        <span class='input-group-btn'>
                                            @if(isset($emailSettings['MailChimp']))
                                                {!! Form::submit('Disconnect', [ 'class' => 'btn btn-danger' ]) !!}
                                            @else
                                                {!! Form::submit('Connect', [ 'class' => 'btn btn-success' ]) !!}
                                            @endif
                                        </span>
                                    </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                        <div class='vt-option-container'>
                            <a class='logo'>
                                <img src='/assets/img/facebook.png'>
                                Facebook
                            </a>                                            
                            @if(null!== Auth::user()->facebookAccount)
                                <div class='buttons'>
                                    <a target="_blank" class="btn btn-danger" href="/fb/disconnect">Disconnect</a>
                                </div>                                
                            @else
                                <div class='buttons'>
                                    <a target="_blank" class="btn btn-success" href="{{ $facebook_login }}">Connect</a>
                                </div>
                            @endif
                        </div>
                        <div class='vt-option-container'>
                            <a class='logo'>
                                <img src='/assets/img/twitter.png'>
                                Twitter
                            </a>                            
                            @if(null!== Auth::user()->twitterAccount)
                                <div class='buttons'>
                                    <a target="_blank" class="btn btn-danger" href="/twitter/disconnect">Disconnect</a>
                                </div>
                            @else
                                <div class='buttons'>
                                    <a target="_blank" class="btn btn-success" href="/twitter">Connect</a>
                                </div>                                
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection