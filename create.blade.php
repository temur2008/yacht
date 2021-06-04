@extends('admin.index')


@section('header_styles')
    <link rel="stylesheet" href="{{asset('libs/summernote/summernote-bs4.min.css')}}">
@endsection

@section('content')

    <div class="row bg-white">
        <div class="col-6">
            <h2>@lang('admin.event_create_add')</h2>

            <form action="{{ route('admin.event.store') }}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="form-group">
                    <label class="form-control-plaintext"><span class="text-danger">*</span>@lang('admin.event_create_title')</label>
                    <input type="text" class="form-control" name="Title" value="{{old('Title')}}">
                </div>
                <div class="form-group">
                    <label class="form-control-plaintext"><span class="text-danger">*</span>@lang('admin.event_create_load')</label>
                    <div class="input-images">
                        <input type="file" name="image[]" multiple class="custom-file-input" id="customFile" accept="image/jpeg, image/png, image/jpg">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-control-plaintext"><span class="text-danger">*</span>@lang('admin.event_create_short')</label>
                    <textarea class="form-control" rows="4" id="ShortDescription" name="ShortDescription" maxlength="255">{{old('ShortDescription')}}</textarea>
                </div>
                <div class="form-group">
                    <label class="form-control-plaintext"><span class="text-danger">*</span>@lang('admin.event_create_description')</label>
                    <textarea class="form-control summernote" rows="6" id="Description" name="Description" maxlength="700">{{old('Description')}}</textarea>
                </div>
                <div class="form-group col-sm-7">
                    <label class="form-control-plaintext">@lang('admin.event_create_date')</label>
                    <input type="text" class="form-control" name="EventDate" id="EventDate">
                </div>
                <div class="form-group mt-4">
                    <input type="submit" class="btn btn-primary" value="Save"/>
                </div>
            </form>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>

@endsection

@section('scripts')

    <script src="{{asset('libs/summernote/summernote-bs4.min.js')}}"></script>
    <script>
        $('.input-images').imageUploader();

        $('#EventDate').datepicker({ format: 'yyyy-mm-dd' });

        $('.summernote').summernote({
            airMode: false
        });
    </script>
@endsection
