
@extends('layouts.mobile')

@section('content')
    <article class="weui_article">
    {!! Form::open(array('url' => 'home/finished','data-ajax'=>"false")) !!}
    @foreach($exam->questions as $key => $question)
    <div data-role="page" id="page{{ $key+1 }}">
        <div data-role="content">
            <div class="center clock"><i class="weui_icon_waiting_circle"></i><span class="time-counter">0</span>秒</div>
            <div class="center exam-info">第{{ $key+1 }}题/共{{ $exam->number_q }}题 | 此题{{ $question->score }}分/共{{ $exam->number_s }}分</div>
            <fieldset data-role="controlgroup">
                <legend><span class="question-type">[@if($question->choice)多选题@else单选题@endif]</span> {{ $question->title }}?</legend>
                @foreach($question->answers as $answer)
                    <label for={{$answer->id}}>{{ $answer->title }}</label>
                    <input type="checkbox" name=answers[{{$question->id}}][{{$answer->id}}] id={{$answer->id}} value="1">
                @endforeach
            </fieldset>
            <section>
                @if(($key+1) === $exam->number_q)
                    {!! Form::submit('完成考试',array("class" => "weui_btn weui_btn_primary","id"=>"exam_finished")) !!}
                @else
                    <div><p><a href="#page{{$key+2}}" class="weui_btn weui_btn_primary">下一题</a></p></div>
                @endif
            </section>
        </div>
    </div>
    @endforeach
    {!! Form::hidden('eid',$exam->id,array('name'=>'eid')) !!}
    {!! Form::hidden('second','',array('name'=>'second')) !!}
    {!! Form::close() !!}
    </article>
@endsection