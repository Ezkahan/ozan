@extends('admin::layouts.content')

@section('page_title')
    Brend Döret
@stop

@section('content')
    <div class="content">
        <form method="POST" action="{{ route('admin.catalog.brands.store') }}" @submit.prevent="onSubmit"
            enctype="multipart/form-data">
            @csrf

            <div class="control-group">
                <label for="swatch" class="required">Surat</label>
                <input type="file" class="control" id="swatch" name="swatch" v-validate="'required'"
                    value="{{ old('swatch') }}">
                <span class="control-error" v-if="errors.has('swatch')">@{{ errors.first('swatch') }}</span>
            </div>

            <div class="control-group">
                <label for="admin_name" class="required">Admin Name</label>
                <input type="text" class="control" id="admin_name" name="admin_name" v-validate="'required'"
                    value="{{ old('admin_name') }}">
                <span class="control-error" v-if="errors.has('admin_name')">@{{ errors.first('admin_name') }}</span>
            </div>

            <div class="control-group">
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
            </div>

            <div class="control-group">
                <button type="submit" class="btn btn-primary">Döret</button>
            </div>
        </form>
    </div>
@stop
