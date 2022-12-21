@extends('template.main2')

@section('content')
    <div class="container">
        <div class="card card-custom rdp_statistic_mg">
            <div class="card-header">
                <h3 class="card-title">
                    Список сервисов
                </h3>
                <div class="card-toolbar">
                    <div class="example-tools justify-content-center">
                        <span class="example-toggle" data-toggle="tooltip" title="View code"></span>
                        <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
                    </div>
                </div>
            </div>

            <form action="{{route('lessons.update', $lesson->id)}}" method="post" class="article-context">
                @csrf
                @method('put')
                <div class="card-body">
                    <div class="form-group">
                        <label>Title<span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control" value="{{ $lesson->title }}" placeholder="Enter email"/>
                        <span class="form-text text-muted">We'll never share your email with anyone else.</span>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">Description<span class="text-danger">*</span></label>
                        <input type="text" name="description" class="form-control" value="{{ $lesson->description }}" id="exampleInputPassword1" placeholder="Password"/>
                    </div>

                    <div class="form-group">
                        <textarea name="text" class="editor">{!! $lesson->text !!}</textarea>
                    </div>

                </div>
                <div class="card-footer">
                    <button type="submit" name="send" class="send-form btn btn-bg-success">Сохранить</button>
                    <a href="{{route('lessons.index')}}" class="btn btn-bg-primary">Назад</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            tinymce.init({
                selector: '.editor',
                plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
                relative_urls: false,
                document_base_url : '{{config('url')}}/',
                file_picker_callback : elFinderBrowser,
            })

            function elFinderBrowser (callback, value, meta) {
                tinymce.activeEditor.windowManager.openUrl({
                    title: 'File Manager',
                    url: '/elfinder/tinymce5',
                    /**
                     * On message will be triggered by the child window
                     *
                     * @param dialogApi
                     * @param details
                     * @see https://www.tiny.cloud/docs/ui-components/urldialog/#configurationoptions
                     */
                    onMessage: function (dialogApi, details) {
                        if (details.mceAction === 'fileSelected') {
                            const file = details.data.file;

                            // Make file info
                            const info = file.name;

                            // Provide file and text for the link dialog
                            if (meta.filetype === 'file') {
                                callback(file.url, {text: info, title: info});
                            }

                            // Provide image and alt text for the image dialog
                            if (meta.filetype === 'image') {
                                callback(file.url, {alt: info});
                            }

                            // Provide alternative source and posted for the media dialog
                            if (meta.filetype === 'media') {
                                callback(file.url);
                            }

                            dialogApi.close();
                        }
                    }
                });
            }
        })
    </script>
@endsection
