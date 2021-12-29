@extends('layouts.layout')

@section('content')
<div>
    <div class="content-header">
        <div class="container-fluid">
            <h1>Buat Post Baru</h1>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <div class="">
                    <form method="post" action="{{route('post.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="judul" class="form-label">Judul</label>
                            <input type="text" class="form-control" id="judul" name="judul" placeholder="Judul" required value="{{old('judul')}}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="cover" class="form-label">Photo Cover</label>
                            <input type="file" class="form-control" id="cover" name="cover" placeholder="Cover" accept=".png,.jpg,.jpeg">
                        </div>
                        <div class="form-group mb-3">
                            <label for="kategori" class="form-label">Kategori</label>
                            <select class="form-select" aria-label="Default select example" name="kategori" required>
                                @foreach($categories as $category)
                                <option value="{{$category->id}}" >{{$category->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="ringkasan" class="form-label">Ringkasan</label>
                            <textarea class="form-control" name="ringkasan" id="ringkasan" maxlength="255">{{old('ringkasan')}}</textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label for="isi" class="form-label">Isi</label>
                            <textarea class="ckeditor form-control" name="isi" id="isi">{{old('isi')}}</textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label for="keywords" class="form-label">Keywords</label>
                            <input type="text" class="form-control" id="keywords" name="keywords" placeholder="Keywords" value="{{old('keywords')}}">
                        </div>
                        <button class="btn btn-lg btn-primary mb-3" type="submit">Publish</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('styles')
<style>
    figure.image {
        display: inline-block;
        border: 1px solid gray;
        margin: 0 2px 0 1px;
        background: #f5f2f0;
    }

    figure.align-left {
        float: left;
    }

    figure.align-right {
        float: right;
    }

    figure.image img {
        margin: 8px 8px 0 8px;
    }

    figure.image figcaption {
        margin: 6px 8px 6px 8px;
        text-align: center;
    }


    /*
 Alignment using classes rather than inline styles
 check out the "formats" option
*/

    img.align-left {
        float: left;
    }

    img.align-right {
        float: right;
    }

    /* Basic styles for Table of Contents plugin (toc) */
    .mce-toc {
        border: 1px solid gray;
    }

    .mce-toc h2 {
        margin: 4px;
    }

    .mce-toc li {
        list-style-type: none;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.tiny.cloud/1/3kx36d9a3hmtdr93d9m74ya16mu1jhwzqjlj4fdd72se0qgv/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script type="text/javascript">
    var editor_config = {
        selector: '#isi',
        path_absolute: "/",
        imagetools_cors_hosts: ['picsum.photos'],
        importcss_append: true,
        toolbar_mode: 'sliding',
        contextmenu: 'link image imagetools table',
        skin: 'oxide',
        content_css: 'default',
        relative_urls: false,
        plugins: [
            "advlist toc importcss autolink lists link image imagetools charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table directionality",
            "emoticons template paste textpattern codesample quickbars"
        ],
        quickbars_insert_toolbar: 'quicktable | hr pagebreak',
        object_resizing: true,
        image_title: true,
        height: 500,
        codesample_global_prismjs: true,
        // skin_url:"{{asset('assets')}}",
        resize: true,
        toolbar_mode: 'floating',
        tinycomments_mode: 'embedded',
        image_advtab: true,
        image_caption: true,
        tinycomments_author: 'Author name',
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media codesample fullscreen toc",
        file_picker_callback: function(callback, value, meta) {
            var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
            var y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;

            var cmsURL = editor_config.path_absolute + 'laravel-filemanager?editor=' + meta.fieldname;
            if (meta.filetype == 'image') {
                cmsURL = cmsURL + "&type=Images";
            } else {
                cmsURL = cmsURL + "&type=Files";
            }

            tinyMCE.activeEditor.windowManager.openUrl({
                url: cmsURL,
                title: 'Filemanager',
                width: x * 0.8,
                height: y * 0.8,
                resizable: "yes",
                close_previous: "no",
                onMessage: (api, message) => {
                    callback(message.content);
                }
            });
        }
    };

    tinymce.init(editor_config);
</script>

@endpush
