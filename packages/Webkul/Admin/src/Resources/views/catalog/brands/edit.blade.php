@extends('admin::layouts.content')

@section('page_title')
    Marka Düzenle
@stop

@section('content')
    <div class="content">
        <form method="POST" action="{{ route('admin.catalog.brands.update', $brand->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="control-group">
                <label for="admin_name">Admin Name</label>
                <input type="text" class="control" id="admin_name" name="admin_name"
                    value="{{ old('admin_name', $brand->admin_name) }}" required>
            </div>
            <div class="control-group">
                <label for="swatch">swatch</label>
                <input type="file" class="control-file" id="swatch" name="swatch">
                @if ($brand->swatch_value)
                    <img src="{{ Storage::url($brand->swatch_value) }}" width="100px" height="100px">
                @endif
            </div>

            @foreach ($translations as $locale => $label)
                <div class="control-group">
                    <label for="translations[{{ $locale }}]">Terjime ({{ $locale }})</label>
                    <input type="text" class="control" id="translations[{{ $locale }}]"
                        name="translations[{{ $locale }}]" value="{{ $label }}" required>
                </div>
            @endforeach
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@stop
