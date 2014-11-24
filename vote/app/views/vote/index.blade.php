@extends('layout')

@section('content')
<div class="container">
    <ul class="players-list">
        @foreach ($players as $player)
        <li class="players-list-item">
            @if ($player->pid % 2 == 0)
                <div class="left">
                    {{ HTML::image('images/players/' . $player->pid . '.png', $alt=$player->name, $attributes = array('class' => 'player')) }}
                    <div class="info">
                        <div class="name">
                            <p>{{ $player->pid }}&nbsp; {{ $player->name }}</p>
                        </div>
<!--                        <div class="count">票数：{{ $player->counts }}</div>-->
                        <a href="#" class="btn-vote" data-id="{{ $player->pid }}" data-name="{{ $player->name }}">
                            {{ HTML::image('images/left-vote-button.png', $alt="vote", $attributes = array()) }}
                        </a>
                    </div>
                </div>
            @else
                <div class="right">
                    {{ HTML::image('images/players/' . $player->pid . '.png', $alt=$player->name, $attributes = array('class' => 'player')) }}
                    <div class="info">
                        <a href="#" class="btn-vote" data-id="{{ $player->pid }}" data-name="{{ $player->name }}">
                            {{ HTML::image('images/right-vote-button.png', $alt="vote", $attributes = array()) }}
                        </a>
                        <div class="name">
                            <p>{{ $player->pid }}&nbsp; {{ $player->name }}</p>
                        </div>
<!--                        <div class="count">票数：{{ $player->counts }}</div>-->
                    </div>
                </div>
            @endif
        </li>
        @endforeach
    </ul>
</div>

<div id="vote-form">
    <div class="form-container">
        @if (Session::get('count') >= 3)
        <h1 class="title">你今天已经投过三次了哟！明天再来吧。</h1>
        <div class="form-field">
            <button class="btn btn-large btn-primary btn-close">确定</button>
        </div>
        @else
        <h1 class="title">请使用学校学号密码进行身份验证</h1>
        {{ Form::open(array('url' => 'vote', 'method' => 'post')) }}
        <div class="form-field">
            <div class="field-label">选手：</div>
            <div class="field-value">
                <span class="chosen-player">1</span>
                {{ Form::hidden('pid'); }}
            </div>
        </div>
        @if (Session::get('username'))
        <div class="form-field form-current-user">
            <div class="field-label">学号：</div>
            <div class="field-value">
                <span>{{ Session::get('username') }}</span>
                <span><a href="#" id="switch-user">切换账号</a></span>
            </div>
        </div>
        <div class="auth-form hidden">
            <div class="form-field">
                <div class="field-label">学号：</div>
                <div class="field-value">{{ Form::text('username'); }}</div>
            </div>

            <div class="form-field">
                <div class="field-label">密码：</div>
                <div class="field-value">{{ Form::password('password'); }}</div>
            </div>
        </div>
        @else
        <div class="form-field">
            <div class="field-label">学号：</div>
            <div class="field-value">{{ Form::text('username'); }}</div>
        </div>

        <div class="form-field">
            <div class="field-label">密码：</div>
            <div class="field-value">{{ Form::password('password'); }}</div>
        </div>
        @endif
        <div class="field-submit">{{ Form::submit('提交', array('class' => 'btn btn-primary btn-large')); }}</div>
        <div class="error"></div>
        @endif
        <span class="close">X</span>
    </div>
</div>

@stop