@extends('layouts.app')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header ">
                        <h4 class="card-title">Create</h4>
                        <p class="card-category"></p>
                    </div>
                    <div class="card-body">
                        <form action="{{route('collectionItem.store')}}" method="POST">
                        @csrf
                        @method('POST')
                        <input name="collection_id" type="hidden" value="{{$collection_id}}">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" name="title" id="title" class="form-control" placeholder="title" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="description" rows="4" cols="80" id="description" class="form-control" placeholder="description..." value=""></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Release</label>
                                        <input type="text" name="release" id="release" class="form-control" placeholder="release" value="{{date('Y-m-d')}}">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-info btn-fill pull-right">Save</button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $('#description').summernote();
    });
</script>
@endsection
