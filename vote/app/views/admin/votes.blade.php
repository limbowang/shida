@extends('admin.layout')

@section('content')

<div class="container" id="result">
    <h1 class="title">投票结果</h1>
    {{ Form::open(array('url' => '/admin/votes', 'method' => 'get')) }}
    <div class="row" style="margin-top: 10px">
      <div class="col-lg-3">
        <div class="input-group">
          <input type="text" class="form-control" name="id">
          <span class="input-group-btn">
            <button class="btn btn-default" type="submit">搜索</button>
          </span>
        </div><!-- /input-group -->
      </div><!-- /.col-lg-6 -->
    </div><!-- /.row -->
    {{ Form::close() }}
    <table class="table table-striped">
        <thead>
            <tr>
                <th>学号</th>
                <th>选手</th>
                <th>投票时间</th>
            </tr>
        </thead>
        <tbody>
            @foreach($votes as $vote)
            <tr>
                <td>{{ $vote->sid  }}</td>
                <td>{{ $vote->pid  }}</td>
                <td>{{ $vote->created_at  }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $votes->links();  }}
</div>
@stop