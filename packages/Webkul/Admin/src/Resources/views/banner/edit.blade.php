@extends('admin::layouts.content')

@section('page_title')
    Marka Düzenle
@stop

@section('content')
    <div class="content">
        <form method="POST" action="{{ route('admin.banner.update', $banner->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="control-group">
                <label for="title">Banner ady</label>
                <input type="text" class="control" id="title" name="title" value="{{ old('title', $banner->title) }}"
                    required>
            </div>
            <div class="control-group">
                <label for="image">Surat</label>
                <input type="file" class="control-file" id="image" name="image" />
                @if ($banner->image)
                    <img src="{{ \Illuminate\Support\Facades\Storage::url($banner->image) }}" width="100px" height="100px">
                @endif
            </div>

            <div class="control-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" cols="30" rows="10">{{ old('description', $banner->description) }}</textarea>
            </div>

            <div class="control-group">
                <label for="url">Url salgysy</label>
                <input type="text" class="control" id="url" name="url" value="{{ old('url', $banner->url) }}">
            </div>


            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@stop
