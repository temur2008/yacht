@extends('admin.index')

@section("styles")
    <style>


    </style>
@endsection
{{
    $id = (is_null($model) ? 0 : $model->Id)

}}



@section('content')


    <div class="row bg-light">
        <div class="col-6">
            <h2>@lang('admin.member_view_product</h2>

            <form action="{{ route('admin.product.save', ['id'=>$id]) }}" method="post" >
                {{csrf_field()}}
                <input type="hidden" value="{{ is_null($model) ? '0' : $model->Id }}" name="Id" />

                <input type="hidden" value="{{old('Division', $model->Division)}}" name="div" />
                <div class="p-2 bg-white">
                    <div class="form-group">
                        <label class="form-control-plaintext"><span class="text-danger">*</span>@lang('admin.member_view_division')</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="Division" id="division.tour" {{old('Division', $model->Division)==\App\Common\Enums\YachtDivision::tour ? "checked":""}} value="{{\App\Common\Enums\YachtDivision::tour}}">
                            <label class="form-check-label" for="division.tour">@lang('admin.member_view_tour')</label>

                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="Division" id="division.lodgement" {{old('Division', $model->Division)==\App\Common\Enums\YachtDivision::lodgement ? "checked":""}} value="{{\App\Common\Enums\YachtDivision::lodgement}}">
                            <label class="form-check-label" for="division.lodgement">@lang('admin.member_view_lodgement')</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="Division" id="division.theme" {{old('Division', $model->Division)==\App\Common\Enums\YachtDivision::theme ? "checked":""}} value="{{\App\Common\Enums\YachtDivision::theme}}"/>
                            <label class="form-check-label" for="division.theme">@lang('admin.member_view_theme')</label>
                        </div>

                    </div>
                    <div class="form-group">

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="IsDisplayed" id="IsDisplayed" {{old('IsDisplayed', $model->IsDisplayed)==true ? "checked":""}} value="{{old('IsDisplayed', $model->IsDisplayed)==true?1:0}}">
                            <label class="form-check-label" for="IsDisplayed"><span class="text-danger">*</span>@lang('admin.member_view_displayed')</label>
                        </div>

                    </div>
                    <div class="form-group">
                        <select name="YachtId" id="yachts" class="form-control"></select>
                    </div>

                    <div class="form-group">
                        <label class="form-control-plaintext"><span class="text-danger">*</span>@lang('admin.member_view_product_name')</label>
                        <input type="text" class="form-control" name="Name" value="{{old('Name', $model->Name)}}" />
                    </div>
                    <div class="form-group row">
                        <div class="col-6">
                            <label class="form-control-plaintext"><span class="text-danger">*</span>@lang('admin.member_view_adults')</label>
                            <input type="text" class="form-control" name="CapacityAdult"  value="{{old('CapacityAdult', $model->CapacityAdult)}}"/>
                        </div>
                        <div class="col-6">
                            <label class="form-control-plaintext"><span class="text-danger">*</span>@lang('admin.member_view_childs')</label>
                            <input type="text" class="form-control" name="CapacityChild" value="{{old('CapacityChild', $model->CapacityChild)}}"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-6">
                            <label class="form-control-plaintext"><span class="text-danger">*</span> @lang('admin.member_view_adults_price')</label>
                            <input type="text" class="form-control" name="PriceAdult" value="{{old('PriceAdult', $model->PriceAdult)}}" />
                        </div>
                        <div class="col-6">
                            <label class="form-control-plaintext"><span class="text-danger">*</span> @lang('admin.member_view_childs_price')</label>
                            <input type="text" class="form-control" name="PriceChild" value="{{old('PriceChild', $model->PriceChild)}}"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-control-plaintext"><span class="text-danger">*</span>@lang('admin.member_view_brief')</label>
                        <textarea class="form-control" name="Introduction">{{old('Introduction', $model->Introduction)}}</textarea>
                    </div>


                    <div class="form-group">
                        <label class="form-control-plaintext" ><span class="text-danger">*</span>@lang('admin.member_view_location')</label>

                        <div class="input-group mb-3">
                            <input class="form-control" name="Location" id="Area" value="{{old('Location', $model->Location)}}">
                            <div class="input-group-append">
                                <a href="javascript:void(0)" class="btn btn-primary" id="SearchAddress" ><i class="fa fa-search"></i> </a>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="form-group">
                    <div class="blockTitle">
                        <label  class="form-control-plaintext ">@lang('admin.member_view_reservation')</label>
                    </div>
                </div>
                <div class="p-2 bg-white">

                    <div class="form-group row">

                        <div class="col-7">

                            <input type="text" class="form-control" name="Reservation[Time]" id="reservationTime" value=""/>
                        </div>
                        <div class="col-2">
                            <a href="javascript:void(0)" class="btn btn-primary" id="addtime">@lang('admin.member_view_add')</a>
                        </div>
                        <div class="col-2">

                            <a href="javascript:void(0)" class="btn btn-dark" id="removetime">@lang('admin.member_view_remove')</a>
                        </div>

                    </div>

                    <div class="form-group">
                        <ul class="list-group" id="timeList">
                            @if( null !== old('ReservationTime') )
                                @foreach(old('ReservationTime') as $key => $value)
                                    <li class="list-group-item" onclick="TimeSelection(this)" >{{ $value  }}</li>
                                    <input type="hidden" value="{{$value}}" name="ReservationTime[]" />
                                @endforeach
                            @endif


                        </ul>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>


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
    <script>

        var $addtime = $('#reservationTime').timepicker({
            format: 'HH:MM',
            mode: '24hr',
            value: $('#reservationTime').val() == ''? '09:00': $('#reservationTime').val()

        });



    </script>
    <script>

        var selectedTime = null;
        function TimeSelection(element){
            selectedTime= $(element).text();
            $(element).addClass('list-group-item bg-warning');

            $('#timeList li').each(function(index, element){
                if($(element).text() != selectedTime)
                {
                    $(element).removeClass('bg-warning');
                }
            });

        }


        $(document).ready(function(){

            $('#addtime').click(function(){
                var time = $('#reservationTime').val();
                var item = '<li class="list-group-item" onclick="TimeSelection(this)" value="'+time+'">'+time+'</li>' +
                    '<input type="hidden" value="'+time+'" name="ReservationTime[]" />';

                var itemExist = false;

                $('#timeList li').each(function(index, element){
                    if($(element).text() == time)
                    {
                        itemExist = true;
                    }
                });

                if(!itemExist) {
                    $('#timeList').append(item);

                }
            });

            $('#removetime').click(function(){
                if(selectedTime!=null)
                {
                    $('#timeList li').each(function(index, element){
                        if($(element).text() == selectedTime)
                        {
                            $(element).remove();
                            selectedTime = null;

                        }
                    });

                }
            });
            $('#IsDisplayed').click(function(){
                if($(this).prop( "checked" ) == true)
                {
                    $(this).val(1);
                }else{
                    $(this).val(0);
                }
            });

            $.ajax({
                method:'get',
                url: "{{route('admin.product.get_yachts')}}",
                success:function(data){
                    JSON.parse(data).forEach(function(element){
                        $('#yachts').append('<option value="'+element.Id+'">'+element.Name+'</option>');
                    });
                },
                error:function(xhr){
                    console.log(xhr.responseText);
                }
            });



        });
    </script>

    <script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
    <script>
        // Search for an address
        // var element_wrap = document.getElementById('wrap');
        //
        // function foldDaumPostcode() {
        //     //Make the element containing the iframe invisible.
        //     element_wrap.style.display = 'none';
        // }
        $(document).ready(function(){
            $('#SearchAddress').click(function(){
                // 현재 scroll 위치를 저장해놓는다.
                var currentScroll = Math.max(document.body.scrollTop, document.documentElement.scrollTop);
                var addWindow = new daum.Postcode({

                    oncomplete: function(data) {
                        // 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

                        // 각 주소의 노출 규칙에 따라 주소를 조합한다.
                        // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                        var addr = ''; // 주소 변수
                        var extraAddr = ''; // 참고항목 변수

                        //사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
                        if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                            addr = data.roadAddress;
                        } else { // 사용자가 지번 주소를 선택했을 경우(J)
                            addr = data.jibunAddress;
                        }

                        // 사용자가 선택한 주소가 도로명 타입일때 참고항목을 조합한다.
                        if(data.userSelectedType === 'R'){
                            // 법정동명이 있을 경우 추가한다. (법정리는 제외)
                            // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
                            if(data.bname !== '' && /[동|로|가]$/g.test(data.bname)){
                                extraAddr += data.bname;
                            }
                            // 건물명이 있고, 공동주택일 경우 추가한다.
                            if(data.buildingName !== '' && data.apartment === 'Y'){
                                extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                            }
                            // 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
                            if(extraAddr !== ''){
                                extraAddr = ' (' + extraAddr + ')';
                            }
                            // 조합된 참고항목을 해당 필드에 넣는다.
                            $('#Area').val(extraAddr);
                            //document.getElementById("addr1").value = extraAddr;
                            //document.getElementById("addr2").value = '';

                        } else {
                            $('#Area').val('');
                            //document.getElementById("addr1").value = '';
                            //document.getElementById("addr2").value = '';
                        }

                        // 우편번호와 주소 정보를 해당 필드에 넣는다.
                        //document.getElementById('sample3_postcode').value = data.zonecode;
                        $('#Area').val(addr);
                        $('#Address').focus();

                        //document.getElementById("addr1").value = addr;
                        // 커서를 상세주소 필드로 이동한다.

                        //document.getElementById("addr2").focus();

                        // iframe을 넣은 element를 안보이게 한다.
                        // (autoClose:false 기능을 이용한다면, 아래 코드를 제거해야 화면에서 사라지지 않는다.)


                        // 우편번호 찾기 화면이 보이기 이전으로 scroll 위치를 되돌린다.



                    },
                    // 우편번호 찾기 화면 크기가 조정되었을때 실행할 코드를 작성하는 부분. iframe을 넣은 element의 높이값을 조정한다.
                    // onresize : function(size) {
                    //     element_wrap.style.height = size.height+'px';
                    // },
                    // width : '100%',
                    // height : '100%'
                }).open({
                    autoClose:true

                });


                // iframe을 넣은 element를 보이게 한다.
                //element_wrap.style.display = 'block';
            });
        });




    </script>
@endsection
