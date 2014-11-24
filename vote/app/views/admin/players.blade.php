@extends('admin.layout')

@section('content')

<div class="container" id="result">
    <h1 class="title">选票结果</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>编号</th>
                <th>姓名</th>
                <th>票数</th>
            </tr>
        </thead>
        <tbody>
            @foreach($players as $player)
            <tr>
                <td>{{ $player->pid  }}</td>
                <td>{{ $player->name  }}</td>
                <td>{{ $player->counts  }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@stop