@extends('backend.layout.index')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Details Article
            <a href="{{route('adminarticles.index')}}" class="btn btn-success"><span class="glyphicon glyphicon-menu-hamburger"></span> List Articles</a>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <!-- FORM -->
            <form role="form" method="post" enctype="multipart/form-data">
                @csrf
                <div class="col-md-9 col-lg-9">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Details Articles</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <div class="box-body">

                            <div class="form-group">
                                <label for="title">Title of Article: </label>
                                <input type="text" class="form-control" id="title" name="title" value="{{$article->title}}" disabled>
                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <img src="{{asset($article->image)}}" alt="" style="margin-top: 15px; max-width: 200px;">
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Type: </label>
                                        <select class="form-control w-50" disabled name="type">
                                            <option value="1" {{$article->type==1?'selected':''}}>Tin tức</option>
                                            <option value="2" {{$article->type==2?'selected':''}}>Tin khuyến mại</option>
                                            <option value="3" {{$article->type==3?'selected':''}}>Tin nổi bật</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Position: </label>
                                        <input type="number" class="form-control w-50" id="position" name="position" value="{{$article->position}}" disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">URL: </label>
                                <input type="text" class="form-control" id="url" name="url" value="{{$article->url}}" disabled>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">User add: </label>
                                @foreach($user as $items)
                                    @if($items->id == $article->user_id)
                                        <input type="text" class="form-control" disabled value="{{$items->name}}">
                                    @endif
                                @endforeach
                            </div>

                            <div class="form-group">
                                <div class="checkbox">
                                    @if($article->is_active==1)
                                         <b>Status: Display</b>
                                        @else
                                            <b>Status: No Display</b>
                                        @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Summary: </label>
                                <textarea id="editor2" name="summary" class="form-control" rows="10" disabled>{{$article->summary}}</textarea>
                            </div>

                            <div class="form-group">
                                <label>Description: </label>
                                <textarea id="editor1" name="description" class="form-control" rows="10" disabled>{{$article->description}}</textarea>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <a href="{{route('adminarticles.edit',$article->id)}}"  class="btn btn-primary">Update this Article</a>
                            <a href="javascript:history.go(-1)" class="btn btn-default pull-right">Back</a>
                        </div>
                    </div>
                    <!-- /.box -->
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Meta Title:</label>
                        <textarea name="meta_title" class="form-control" rows="3" disabled>{{$article->meta_title}}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Meta Description:</label>
                        <textarea name="meta_description" class="form-control" rows="5" disabled>{{$article->meta_description}}</textarea>
                    </div>
                </div>
            </form>
            <!--END FORM -->
        </div>
        <!-- /.row -->
    </section>
@endsection

@section('my_js')
    <script type="text/javascript">
        // hcdung
        $(document).ready(function() {
            // setup textarea sử dụng plugin CKeditor
            var _ckeditor1 = CKEDITOR.replace('summary');
            _ckeditor1.config.height = 200; // thiết lập chiều cao
            var _ckeditor2 = CKEDITOR.replace('description');
            _ckeditor2.config.height = 650; // thiết lập chiều cao
        });
    </script>
@endsection
