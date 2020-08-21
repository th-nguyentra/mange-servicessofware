@extends('layout.master')
@section('content')


    <!-- Main content -->
    <section class="content ">
        <div class="">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h1 class="titleheader">Đăng ký dịch vụ SSL</h1>
                            <form action="{{route('admin.register_services.post')}}" method="post">
                                <p class="help-block text-danger"></p>
                                @if($errors->has('id_domain'))
                                    <p class="help-block text-danger">
                                        {{ $errors->first('id_domain') }}
                                    </p>
                                @endif
                                <input type="hidden" name="id"
                                       value="{{isset($register_service->id) ? $register_service->id: ''}}">
                                @csrf
                                <div class="row">
                                    @if(session('success'))
                                        <div class="alert alert-success">
                                            {{session('success')}}
                                        </div>
                                    @endif
                                    @if(session('fail'))
                                        <div class="alert alert-danger">
                                            {{session('fail')}}
                                        </div>
                                    @endif
                                </div>

                                <div class="panel panel-default">
                                    <div class="panel-body">

                                        {{-- ví dụ nha--}}
                                        <div class="form-row">
                                            <div class="form-group col-md-12">


                                                <!--Top Table UI-->
                                                <div class="table-ui p-2 mb-3 mx-3 mb-4" >
                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <div class="col-xs-12 form-group">
                                                                <label style="margin-top: 20px;" class="registerservice1">Khách hàng <span class="aster">*</span></label>
                                                                <select class="js-example-basic-single form-control" name="id_customer">
                                                                    @foreach($customer as $cus)
                                                                        <option value="{{$cus->id}}"> {{$cus->name}}-{{$cus->email}}</option>
                                                                    @endforeach
                                                                </select>
                                                                <p class="help-block text-danger"></p>
                                                                @if($errors->has('name'))
                                                                    <p class="help-block text-danger">
                                                                        {{ $errors->first('name') }}
                                                                    </p>
                                                                @endif
                                                            </div>
                                                        </div>


                                                    </div>
                                                    <!--Grid row-->
                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <div class="col-xs-12 form-group">
                                                                <label>Tên <span class="aster">*</span></label>
                                                                <select onchange="selectSSL(this)" type="text" class="form-control"
                                                                        name="id_ssl"
                                                                        value="">
                                                                    <option value="">Choose SSL</option>
                                                                    @foreach($ssl as $s)
                                                                        <option value="{{$s->id}}"
                                                                                @if(isset($register_service->id) && $register_service->id_ssl== $s->id)
                                                                                selected
                                                                                @endif
                                                                                data-price="{{$s->price}}"
                                                                                data-insurance-policy="{{$s->insurance_policy}}"
                                                                                data-domain-number="{{$s->domain_number}}"
                                                                                data-reliability="{{$s->reliability}}"
                                                                                data-green-bar="{{$s->green_bar}}"
                                                                                data-sans="{{$s->sans}}"
                                                                                data-notes="{{$s->notes}}"
                                                                        >{{$s->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                                <p class="help-block text-danger"></p>
                                                                @if($errors->has('name'))
                                                                    <p class="help-block text-danger">
                                                                        {{ $errors->first('name') }}
                                                                    </p>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <div class="col-xs-12 form-group">
                                                                <label>Giá <span class="aster">*</span></label>
                                                                <input id="price_ssl" type="number" class="form-control" name="price" readonly
                                                                       value="">
                                                                <p class="help-block text-danger"></p>
                                                                @if($errors->has('price'))
                                                                    <p class="help-block text-danger">
                                                                        {{ $errors->first('price') }}
                                                                    </p>
                                                                @endif
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <div class="col-xs-12 form-group">
                                                                <label>Insurance Policy <span class="aster">*</span></label>
                                                                <input id="insurance_policy" type="text" class="form-control"
                                                                       name="insurance_policy" readonly
                                                                       value="">
                                                                <p class="help-block text-danger"></p>
                                                                @if($errors->has('insurance_policy'))
                                                                    <p class="help-block text-danger">
                                                                        {{ $errors->first('insurance_policy') }}
                                                                    </p>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <div class="col-xs-12 form-group">
                                                                <label>Domain Number <span class="aster">*</span></label>
                                                                <input id="domain_number" type="text" class="form-control " name="domain_number"
                                                                       readonly
                                                                       value="">
                                                                {{--                            old nếu tồn tại dữ liệu cũ thì show ra , còn không thì để rỗng--}}
                                                                <p class="help-block text-danger"></p>
                                                                @if($errors->has('domain_number'))
                                                                    <p class="help-block text-danger">
                                                                        {{ $errors->first('domain_number') }}
                                                                    </p>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <div class="col-xs-12 form-group">
                                                                <label>Reliability <span class="aster">*</span></label>
                                                                <input id="reliability" type="text" class="form-control " name="reliability"
                                                                       readonly
                                                                       value="">
                                                                {{--                            old nếu tồn tại dữ liệu cũ thì show ra , còn không thì để rỗng--}}
                                                                <p class="help-block text-danger"></p>
                                                                @if($errors->has('reliability'))
                                                                    <p class="help-block text-danger">
                                                                        {{ $errors->first('reliability') }}
                                                                    </p>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <div class="col-xs-12 form-group">
                                                                <label>Green Bar <span class="aster">*</span></label>
                                                                <input id="green_bar" type="text" class="form-control " name="green_bar" readonly
                                                                       value="">
                                                                <p class="help-block text-danger"></p>
                                                                @if($errors->has('green_bar'))
                                                                    <p class="help-block text-danger">
                                                                        {{ $errors->first('green_bar') }}
                                                                    </p>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <div class="col-xs-12 form-group">
                                                                <label>Sans <span class="aster">*</span></label>
                                                                <input id="sans" type="text" class="form-control " name="sans" readonly
                                                                       value="">
                                                                <p class="help-block text-danger"></p>
                                                                @if($errors->has('sans'))
                                                                    <p class="help-block text-danger">
                                                                        {{ $errors->first('sans') }}
                                                                    </p>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-6">

                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-group col-md-12">
                                                            <label>Địa chỉ domain <span class="aster">*</span></label>
                                                            <input id="address_domain5" type="text"
                                                                   class="form-control "
                                                                   name="address_domain5"
                                                                   value="">
                                                            <p class="help-block text-danger"></p>
                                                            @if($errors->has('address_domain5'))
                                                                <p class="help-block text-danger">
                                                                    {{ $errors->first('address_domain5') }}
                                                                </p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <div class="col-xs-12 form-group ">
                                                                <label class="registerservice1">Ngày bắt đầu <span class="aster">*</span></label>
                                                                <div class="input-group">
                                                                    <input class="form-control" id="start_date5" name="start_date5" type="text"/>
                                                                    <div class="input-group-addon">
                                                                    </div>
                                                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                                                </div>
                                                                <p class="help-block text-danger"></p>
                                                                @if($errors->has('start_date5'))
                                                                    <p class="help-block text-danger">
                                                                        {{ $errors->first('start_date5') }}
                                                                    </p>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <div class="col-xs-12 form-group">
                                                                <label class="registerservice1">Ngày kết thúc <span class="aster">*</span></label>
                                                                <div class="input-group">
                                                                    <input class="form-control" id="end_date5" name="end_date5" type="text"/>
                                                                    <div class="input-group-addon">
                                                                    </div>
                                                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                                                </div>
                                                                <p class="help-block text-danger"></p>
                                                                @if($errors->has('end_date5'))
                                                                    <p class="help-block text-danger">
                                                                        {{ $errors->first('end_date5') }}
                                                                    </p>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                        <!--/.Accordion wrapper-->

                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <div class="col-xs-12 form-group">
                                                    <label class="registerservice1">Ghi Chú </label>
                                                    <textarea rows="5" type="text" class="form-control"
                                                              name="notes">{{isset($register_service->notes) ? old('notes', $register_service->notes) : old('notes')}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <button class="btn btn-info">{{ __('general.save') }}</button>
                                        <a href="{{ route('admin.register_services.index') }}"
                                           class="btn btn-default">{{ __('general.back') }}</a>
                                    </div>
                                </div>


                            </form>
                        </div>
                        <!-- /.card -->
                    </div>

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <script>
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            $("#start_date5").datepicker({
                format: 'dd-mm-yyyy ',
                autoclose: true,
            }).on('changeDate', function (selected) {
                var minDate = new Date(selected.date.valueOf());
                $('#end_date5').datepicker('setStartDate', minDate);
            });

            $("#end_date5").datepicker({
                format: 'dd-mm-yyyy',
                autoclose: true,
            }).on('changeDate', function (selected) {
                var minDate = new Date(selected.date.valueOf());
                $('#start_date5').datepicker('setEndDate', minDate);
            });

            $('.js-example-basic-single').select2();
            $('.abcdef').each(function () {
                $(this).on('click', function () {
                    var backColor = $(this).css('background-color');
                    if (backColor === 'rgb(233, 236, 239)') {
                        $(this).css('background-color', 'LightGray');
                    }
                    else {
                        $('.abcdef').css('background-color', 'LightGray');
                        $(this).css('background-color', '#e9ecef');
                    }
                })
            });


        });

    </script>

@stop

