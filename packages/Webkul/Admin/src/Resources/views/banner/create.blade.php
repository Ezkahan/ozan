@extends('admin::layouts.content')

@section('page_title')
    Brend Döret
@stop

@section('content')
    <div class="content">
        <form method="POST" action="{{ route('admin.banner.store') }}" @submit.prevent="onSubmit"
            enctype="multipart/form-data">
            @csrf

            <div class="control-group">
                <label for="image" class="required">Surat</label>
                <input type="file" class="control" id="image" name="image" v-validate="'required'"
                    value="{{ old('image') }}">
                <span class="control-error" v-if="errors.has('image')">@{{ errors.first('image') }}</span>
            </div>

            <div class="control-group">
                <label for="title" class="required">Ady</label>
                <input type="text" class="control" id="title" name="title" required>
            </div>

            <div class="control-group">
                <label for="description">Description</label>
                <textarea name="description" class="control" id="" cols="30" rows="10"></textarea>
            </div>

            <div class="control-group">
                <label for="url">Url salgysy</label>
                <input type="text" class="control" id="url" name="url">
            </div>
            {{-- <div class="control-group">
                <label for="translations[tm]">Turkmen</label>
                <input type="text" class="control" id="translations[tm]" name="translations[tm]" required>
            </div>

            <div class="control-group">
                <label for="translations[en]">English</label>
                <input type="text" class="control" id="translations[en]" name="translations[en]" required>
            </div>

            <div class="control-group">
                <label for="translations[ru]">Russian</label>
                <input type="text" class="control" id="translations[ru]" name="translations[ru]" required>
            </div>

            <div class="control-group">
                <label for="position" class="required">Position</label>
                <input type="number" class="control" id="position" name="position" v-validate="'required'"
                    value="{{ old('position') }}">
                <span class="control-error" v-if="errors.has('position')">@{{ errors.first('position') }}</span>
            </div> --}}

            <div class="control-group">
                <button type="submit" class="btn btn-primary">Döret</button>
            </div>
        </form>
    </div>
@stop
