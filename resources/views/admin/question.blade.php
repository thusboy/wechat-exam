@extends('admin.admin')

@section('content-main')
    @foreach ($errors->all() as $error)
        <p class="error-message bg-danger">{{ $error }}</p>
    @endforeach
    <div class="panel panel-default exam-update-panel">
        <div class="panel-heading">添加试题</div>
        <div class="panel-body">
            {!! Form::open(array('url' => 'admin/store-question')) !!}
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('title', '试题') !!}
                        {!! Form::text('title','',array('class' => 'form-control')) !!}
                        {!! Form::hidden('eid',$questions->eid,array('eid'=>'eid')) !!}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        {!! Form::label('score', '试题分数') !!}
                        {!! Form::text('score',1,array('class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <div class="btn btn-default btn-sm btn-inline" id="add-answer">添加答案</div>
                        {!! Form::submit('提交',array("class" => "btn btn-primary btn-sm btn-inline")) !!}
                    </div>
                </div>
            <div class="row">
                <div class="col-md-12">
                <div class="form-group">
                    {!! Form::label('title', '答案') !!}
                </div>
                </div>
            </div>
           <table class="table answer-table">
               <tr>
                   <th>正确答案?</th>
                   <th>答案内容</th>
                   <th><th>
               </tr>
               <tr id="answer1">
                   <td>
                       {!! Form::checkbox('answer[1][yn]') !!}
                   </td>
                   <td>
                       {!! Form::text('answer[1][title]','',array('class' => 'form-control')) !!}
                   </td>
                   <td>
                       <a href="#" id="1" class='answer-remove'><span class="glyphicon glyphicon-remove remove" aria-hidden="true"></span></a>
                   </td>
               </tr>
               <tr id="answer2">
                   <td>
                       {!! Form::checkbox('answer[2][yn]') !!}
                   </td>
                   <td>
                       {!! Form::text('answer[2][title]','',array('class' => 'form-control')) !!}
                   </td>
                   <td>
                       <a href="#" id='2' class='answer-remove'><span class="glyphicon glyphicon-remove remove" aria-hidden="true"></span></a>
                   </td>
               </tr>
           </table>

        </div>
    </div>
        </div>
    {!! Form::close() !!}
    <table class="stand hidden">
        <tr id='answerreplace'>
            <td>
                {!! Form::checkbox('answer[replace][yn]') !!}
            </td>
            <td>
                {!! Form::text('answer[replace][title]','',array('class' => 'form-control')) !!}
            </td>
            <td>
                <a href="#" id='replace' class='answer-remove'><span class="glyphicon glyphicon-remove remove" aria-hidden="true"></span></a>
            </td>
        </tr>
    </table>
    <div class="panel panel-default">
        <div class="panel-heading">试题列表</div>
        <div class="panel-body">
            <table class="table">
                <tr>
                    <th>序号</th>
                    <th>分数</th>
                    <th>题目</th>
                    <th>答案</th>
                    <th>操作</th>
                </tr>
                @foreach( $questions as $question)
                    <tr>
                        <td>{{ $question->id }}</td>
                        <td>{{ $question->score }}分</td>
                        <td>{{ $question->title }}</td>
                        <td>
                            <ul class="answer-ul">
                            @foreach( $question->answer as $answer )
                                @if($answer->yn)
                                    <li class="font-red">
                                @else
                                    <li>
                                @endif
                                    {{ $answer->title }}
                                    </li>
                            @endforeach
                            </ul>
                        </td>
                        <td><div class="btn btn-sm btn-primary btn-danger question-del" for1="{{$question->id}}" for2="{{ $question->eid }}">删除题目</div></td>
                @endforeach
                    </tr>
            </table>
        </div>
    </div>
    <div id="dialog-confirm" title="删除题目?" class="dialog">
        <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>此题目以及此题目的所有答案将被删除,确定删除?</p>
    </div>
@endsection