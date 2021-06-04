@extends('admin.index')

@section('content')


    <div class="row">

        <div class="col">


            <h2>@lang('admin.member_index_list')</h2>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>@lang('admin.member_index_user')</th>
                        <th>@lang('admin.member_index_ship')</th>
                        <th>@lang('admin.member_index_current')</th>
                        <th>@lang('admin.member_index_accumulated')</th>
                        <th>@lang('admin.member_index_reser')</th>
                        <th>@lang('admin.member_index_visit')</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($model as $item)
                        <tr>
                            <td>{{$item->Id}}</td>
                            <td>{{$item->user->name}}</td>

                            <td>{{$item->MembershipStatus == true ? 'active':'withdrawal' }}</td>
                            <td>{{$item->CurrentPoint}}</td>
                            <td>{{$item->AccumulatedPoint}}</td>
                            <td>{{$item->ReservationCount}}</td>
                            <td>{{$item->LastVisited}}</td>
                            <td><a href="{{route('admin.member.view',['Id'=>$item->Id])}}" class="btn btn-info"><span class="fa fa-eye"></span> </a> </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/sweetalert.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            window.activateConfirm = function(itemId)
            {
                Swal.fire({
                    icon: 'warning',
                    text: 'Do you want activate?',
                    showCancelButton: true,
                    confirmButtonText: 'Activate',
                    confirmButtonColor: '#e3342f',
                }).then((result) => {
                    $.ajax({
                        url:'{{url('/admin/vendor/activate')}}/'+itemId,
                        method:'GET'

                    })
                    .done(function(data){
                        if(data.status == {{\App\Common\Enums\ResultStatus::Success}})
                        {
                            window.location.reload();
                        }
                    });
                });
            }
        });

    </script>

@endsection

