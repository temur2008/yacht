@extends('admin.index')

@section('header_styles')
    <link rel="stylesheet" href="{{asset('libs/summernote/summernote.min.css')}}">
@endsection

@section('content')

    <div class="row bg-white">
        <div class="col-6">
            <h2>@lang('admin.event_edit')</h2>

            <form action="{{ route('admin.event.update', $event->Id) }}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <input type="hidden" name="Id" value="{{$event->Id}}"/>
                <div class="form-group">
                    <label class="form-control-plaintext"><span class="text-danger">*</span>@lang('admin.event_edit_title')</label>
                    <input type="text" class="form-control" name="Title" value="{{$event->Title}}">
                </div>
                <div class="form-group">
                    <label class="form-control-plaintext"><span class="text-danger">*</span>@lang('admin.event_edit_load')</label>
                    <div class="input-images">
                        <input type="file" name="image[]" multiple class="custom-file-input" id="customFile" accept="image/jpeg, image/png, image/jpg">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-control-plaintext"><span class="text-danger">*</span>@lang('admin.event_edit_short')</label>
                    <textarea class="form-control" rows="4" id="ShortDescription" name="ShortDescription" maxlength="255">{{$event->ShortDescription}}</textarea>
                </div>
                <div class="form-group">
                    <label class="form-control-plaintext"><span class="text-danger">*</span>@lang('admin.event_edit_description')</label>
                    <textarea class="form-control summernote" rows="6" id="Description" name="Description" maxlength="700">{{$event->Description}}</textarea>
                </div>
                <div class="form-group col-sm-7">
                    <label class="form-control-plaintext">@lang('admin.event_edit_date')</label>
                    <input type="text" class="form-control" name="EventDate" id="EventDate" value="{{$event->EventDate}}">
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
    <script src="{{asset('libs/summernote/summernote.min.js')}}"></script>
    <script>
        let preloaded = [
                @php
                        @endphp
                @foreach($event->images as $image)

            {id:{{$image->Id}}, src: '{{asset('/storage/events/'.$image->Name)}}'},

            @endforeach



        ];
        $('.input-images').imageUploader({
            preloaded:preloaded,

            //imagesInputName:"image[]"
        });

        $('#EventDate').datepicker({ format: 'yyyy-mm-dd' });

        $('.summernote').summernote({
            airMode: false
        });
    </script>
@endsection
