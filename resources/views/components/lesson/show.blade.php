@extends('template.main2')

@section('content')
    <div class="container">
        <div class="card card-custom rdp_statistic_mg">
            <div class="card-header">
                <h3 class="card-title">
                    {{$lesson->title}}
                </h3>
                <div class="card-toolbar">
                    <div class="example-tools justify-content-center">
                        <span class="example-toggle" data-toggle="tooltip" title="View code"></span>
                        <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <h2>{{$lesson->description}}</h2>
                {!! $lesson->text !!}
            </div>

            <div class="card-footer">
                <a href="{{route('lessons.index')}}" class="btn btn-bg-primary">Назад</a>
            </div>
        </div>
    </div>
@endsection
