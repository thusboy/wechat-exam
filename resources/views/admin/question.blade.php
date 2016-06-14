@extends('admin.admin')

@section('content-main')
    @foreach ($errors->all() as $error)
        <p class="error-message bg-danger">{{ $error }}</p>
    @endforeach
    <div class="panel panel-default">
        <div class="panel-heading">添加试题</div>
            <div class="panel-body">
        <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist" id="question-tab"">
                    <li role="presentation" class="active"><a href="#cquestion" aria-controls="cquestion" role="tab" data-toggle="tab">选择题</a></li>
                    <li role="presentation"><a href="#bquestion" aria-controls="bquestion" role="tab" data-toggle="tab">判断题</a></li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="cquestion">
                        {!! Form::open(array('url' => 'admin/store-question')) !!}
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        {!! Form::label('title', '试题') !!}
                                        {!! Form::text('title','',array('class' => 'form-control')) !!}
                                        {!! Form::hidden('eid',$questions->eid,array('eid'=>'eid')) !!}
                                    </div>
                                </div>
                                <div class="col-md-4">
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
                    </div>
                    <div role="tabpanel" class="tab-pane" id="bquestion">
                        {!! Form::open(array('url' => 'admin/store-question')) !!}
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        {!! Form::label('title', '试题') !!}
                                        {!! Form::text('title','',array('class' => 'form-control')) !!}
                                        {!! Form::hidden('eid',$questions->eid,array('eid'=>'eid')) !!}
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        {!! Form::label('score', '试题分数') !!}
                                        {!! Form::text('score',1,array('class' => 'form-control')) !!}
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        {!! Form::label('boolen', '答案') !!}
                                        <div>
                                            {!! Form::radio('boolen',"1",true) !!} <span> 对 </span>
                                            {!! Form::radio('boolen',"0",true) !!} <span> 错 </span>
                                            {!! Form::hidden('ifbq',1) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {!! Form::submit('提交',array("class" => "btn btn-primary btn-sm btn-inline")) !!}
                                    </div>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    <div class="panel panel-default">
        <div class="panel-heading">试题列表</div>
        <div class="panel-body">
            <table class="table">
                <tr>
                    <th>序号</th>
                    <th>题型</th>
                    <th>分数</th>
                    <th>题目</th>
                    <th>答案</th>
                    <th>操作</th>
                </tr>
                @foreach( $questions as $key => $question)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td></td>
                        <td>{{ $question->score }}分</td>
                        <td>{{ $question->title }}</td>
                        <td>

                            @if($question->choice == 2)
                                <ul>
                                @if($question->answer[0]->yn)
                                    <li class="font-red">对</li>
                                @else
                                    <li>错</li>
                                @endif
                                </ul>
                            @else
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
                            @endif

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