@extends('admin.admin')

@section('content-main')
   <div class="panel panel-default exam-update-panel">
      <div class="panel-heading">添加考试</div>
      <div class="panel-body">
         {!! Form::open(array('url' => 'admin/store')) !!}
         <div class="row">
            <div class="col-md-5">
               <div class="form-group">
                  {!! Form::label('title', '考试名称') !!}
                  {!! Form::text('title','',array('class' => 'form-control')) !!}
               </div>
            </div>
            <div class="col-md-6">
               <div class="form-group">
                  {!! Form::label('expired', '有效时间') !!}
                  <div class="input-daterange input-group" id="datepicker">
                     {!! Form::text('start','',array('class' => 'input-sm form-control','name'=>'start')) !!}
                     <span class="input-group-addon">至</span>
                     {!! Form::text('end','',array('class' => 'input-sm form-control','name'=>'end')) !!}
                  </div>
                  {!! Form::hidden('eid','',array('name'=>'eid')) !!}
                  {!! Form::hidden('type','exam',array('name'=>'type')) !!}
               </div>
            </div>
            <div class="col-md-1">
               <div class="form-group">
                  {!! Form::submit('提交',array("class" => "btn btn-primary btn-sm btn-inline")) !!}
               </div>
            </div>
         </div>
   </div>
      {!! Form::close() !!}
</div>
   <div class="panel panel-default">
      <div class="panel-heading">考试列表</div>
         <div class="panel-body">
            <table class="table">
               <tr>
                  <th>标题</th>
                  <th>开始时间</th>
                  <th>结束时间</th>
                  <th>题目数量</th>
                  <th>操作</th>
               </tr>
               @foreach( $exams as $exam)
               <tr>
                  <td id="title{{ $exam->id }}">{{ $exam->title }}</td>
                  <td id="start{{ $exam->id }}">{{ date("Y-m-d",strtotime($exam->start)) }}</td>
                  <td id="end{{ $exam->id }}">{{  date("Y-m-d",strtotime($exam->end)) }}</td>
                  <td></td>
                  <td>
                     <div class="btn-group">
                        <div type="button" class="btn btn-default dropdown-toggle btn-sm btn-danger" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           操作 <span class="caret"></span>
                        </div>
                        <ul class="dropdown-menu" for="{{ $exam->id }}">
                           <li><a href="#" class="exam-update">编辑考试</a></li>
                           <li role="separator" class="divider"></li>
                           <li><a href="{{action("AdminController@question",array("eid"=>$exam->id))}}">管理试题</a></li>
                           <li role="separator" class="divider"></li>
                           <li><a href="#" class="exam-del">删除考试</a></li>
                        </ul>
                     </div>
                  </td>
               @endforeach
               </tr>
            </table>
         </div>
   </div>
   <div id="dialog-confirm" title="删除考试?" class="dialog">
      <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>此考试以及此考试关联的所有试题和其它数据将被删除,确定删除?</p>
   </div>
@endsection