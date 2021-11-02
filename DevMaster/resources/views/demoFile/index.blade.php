

{{--@foreach($products as $items)--}}
{{--    <h5>{{$items->id}}</h5>--}}
{{--    <h5>{{$items->name}}</h5>--}}
{{--    <h5>{{$items->soluong}}</h5>--}}

{{--@endforeach--}}

{{--@foreach($test as $items)--}}
{{--    <h5>{{$items->id}}</h5>--}}
{{--    <h5>{{$items->name}}</h5>--}}
{{--    <h5>{{$items->soluong}}</h5>--}}

{{--@endforeach--}}
@extends('backend.layout.index')
@section('content')
    <section class="content">
        <!-- Button trigger modal -->
        @if(count($products)>0)
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
            Launch demo modal
        </button>
        @endif
        <!-- Modal -->
        <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                            <div class="box-body table-responsive no-padding">
                                <table class="table table-hover">
                                    <tr>
                                        <th>ID</th>
                                        <th>Tên</th>
                                        <th>số lượng</th>
                                        <th>Action</th>
                                    </tr>
                                    @foreach($products as $items)
                                            <tr>

                                                <td>{{$items->id}}</td>
                                                <td>{{$items->name}}</td>
                                                <td>{{$items->soluong}}</td>

                                                <td>
                                                    <a href=""  class="btn btn-warning">Chi tiết</a>
                                                    <a class="btn btn-primary" href="">Sửa</a>
                                                </td>
                                            </tr>
                                    @endforeach

                                </table>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
