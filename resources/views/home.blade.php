
@extends('layouts.mobile')

@section('content')
    {!! Form::open(array('url' => 'home/finnish')) !!}
    @foreach($questions as $question)
    <div data-role="page" id="page{{ $question->id }}">
        <div data-role="header">
            <h1>略阳县团委普法考试系统</h1>
        </div>
        <div data-role="content">
            <fieldset data-role="controlgroup">
                <legend>{{ $question->title }}</legend>
                @foreach($question->answers as $answer)
                    <label for={{$answer->id}}>{{ $answer->title }}</label>
                    <input type="checkbox" name={{$answer->id}} id={{$answer->id}} value={{$answer->id}}>
                @endforeach
            </fieldset>
            <section>
                <a href="#page{{$question->id-1}}" class="weui_btn weui_btn_primary">下一题</a>
            </section>
        </div>
    </div>
    @endforeach
    {!! Form::close() !!}
@endsection