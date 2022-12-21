@extends('template.main2')

@section('content')
    <div class="container">
        <div class="card card-custom rdp_statistic_mg">
            <div class="card-header">
                <h3 class="card-title">
                    Список уроков
                </h3>
                <div class="card-toolbar">
                    <div class="example-tools justify-content-center">
                        <span class="example-toggle" data-toggle="tooltip" title="View code"></span>
                        <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <table class="table table-sm">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Nick</td>
                        <td>Stone</td>
                        <td>
                            <span class="label label-inline label-light-primary font-weight-bold">
                                Pending
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Ana</td>
                        <td>Jacobs</td>
                        <td>
                            <span class="label label-inline label-light-success font-weight-bold">
                                Approved
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>Larry</td>
                        <td>Pettis</td>
                        <td>
                            <span class="label label-inline label-light-danger font-weight-bold">
                                New
                            </span>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            @foreach($lessons as $lesson)
                <a href="{{route('lessons.show', $lesson->id)}}">{{$lesson->title}}</a>
                <a href="{{route('lessons.edit', $lesson->id)}}">Редактировать</a>
            @endforeach

        </div>
    </div>
@endsection

