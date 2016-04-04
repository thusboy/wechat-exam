@extends('admin.admin')

@section('content-main')
    <div class="panel panel-default">
        <div class="panel-heading">系统概况</div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-2">
                    参与总人数:{{$overview["people"]}}
                </div>
                <div class="col-md-2">
                    总参与次数:{{$overview["join"]}}
                </div>
                <div class="col-md-2">
                    参与男性:{{$overview["male"]}}
                </div>
                <div class="col-md-2">
                    参与女性:{{$overview["female"]}}
                </div>
                <div class="col-md-2">
                    考试总数:{{$overview["exam"]}}
                </div>
                <div class="col-md-2">
                    试题总数:{{$overview["question"]}}
                </div>

            </div>
        </div>
    </div>
@endsection