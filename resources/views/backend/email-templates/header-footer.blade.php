@extends('backend.layouts.app')
@if(@$data->id)
    @section('title',__('Global Message Header/Footer Template') . ' :: ' . app_name())
@else
    @section('title',__('Global Message Header/Footer Template') . ' :: ' . app_name())
@endif
@section('content')
    {{ html()->form(('POST') )->id('form_email_template_submit')->class('form-horizontal')->open() }}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                          @if(@$data->id)
                            Global Message Header/Footer Template
                          @else
                            Create Global Message Header/Footer Template
                          @endif
                            <small class="text-muted"></small>
                        </h4>
                    </div><!--col-->
                </div><!--row-->
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <h4>Message Header</h4>
                    </div>
                    <div class="col-md-4">
                        {{ html()->label('Title EN')->class('form-control-label')->for('title_en') }}
                        {{ html()->textarea('header_en')
                            ->class('form-control')
                            ->placeholder(__('labels.backend.templates.header_title_en'))
                            ->value(old('title', @$data->header_en))
                            ->attribute('maxlength', 191)}}
                        <div class="invalid-feedback"></div>
                    </div><!--col-->
                    <div class="col-md-4">
                        {{ html()->label('Title DE')->class('form-control-label')->for('title_de') }}
                        {{ html()->textarea('header_de')
                            ->class('form-control')
                            ->placeholder(__('labels.backend.templates.header_title_de'))
                            ->value(old('title', @$data->header_de))
                            ->attribute('maxlength', 191)}}
                        <div class="invalid-feedback"></div>
                    </div><!--col-->
                    <div class="col-md-4">
                        {{ html()->label('Title PL')->class('form-control-label')->for('title_pl') }}
                        {{ html()->textarea('header_pl')
                            ->class('form-control')
                            ->placeholder(__('labels.backend.templates.header_title_pl'))
                            ->value(old('title', @$data->header_pl))
                            ->attribute('maxlength', 191)}}
                        <div class="invalid-feedback"></div>
                    </div><!--col-->
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <h4>Message Footer</h4>
                    </div>
                    <div class="col-md-4">
                        {{ html()->label('Footer EN')->class('form-control-label')->for('footer_en') }}
                        {{ html()->textarea('footer_en')
                            ->class('form-control')
                            ->placeholder(__('labels.backend.templates.footer_title_en'))
                            ->value(old('title', @$data->footer_en))
                            ->attribute('maxlength', 191)}}
                        <div class="invalid-feedback"></div>
                    </div><!--col-->
                    <div class="col-md-4">
                        {{ html()->label('Footer DE')->class('form-control-label')->for('footer_de') }}
                        {{ html()->textarea('footer_de')
                            ->class('form-control')
                            ->placeholder(__('labels.backend.templates.footer_title_de'))
                            ->value(old('title', @$data->footer_de))
                            ->attribute('maxlength', 191)}}
                        <div class="invalid-feedback"></div>
                    </div><!--col-->
                    <div class="col-md-4">
                        {{ html()->label('Footer PL')->class('form-control-label')->for('footer_pl') }}
                        {{ html()->textarea('footer_pl')
                            ->class('form-control')
                            ->placeholder(__('labels.backend.templates.footer_title_pl'))
                            ->value(old('title', @$data->footer_pl))
                            ->attribute('maxlength', 191)}}
                        <div class="invalid-feedback"></div>
                    </div><!--col-->
                </div>
                <div class="form-group">
                    <div class="col-md-2">
                        {{ html()->label('Status')->class('form-control-label') }}
                    </div>
                    <div class="col-md-10">
                        <div class="checkbox d-flex align-items-center">
                            {{ html()->label(
                                html()->checkbox('status',  @$data->status ?? 1, '1')
                                ->class('switch-input pref_check')
                                ->id('status')
                                . '<span class="switch-slider" data-checked="On" data-unchecked="Off"></span>')
                                ->class('switch switch-label switch-pill switch-success mr-2')
                                ->for('status') 
                            }}
                        </div>
                    </div>
                </div>
            </div><!--card-body-->

            <div class="card-footer clearfix">
                <div class="row">
                    <div class="col">
                        {{ form_cancel(route('admin.email-templates.index'), __('buttons.general.cancel')) }}
                    </div><!--col-->

                    <div class="col text-right">
                        <input type="hidden" name="id" value="{{@$data->id}}">
                        @if(@$data->id)
                            {{ form_submit(__('buttons.general.crud.update')) }}
                        @else
                            {{ form_submit(__('buttons.general.crud.create')) }}
                        @endif
                    </div><!--col-->
                </div><!--row-->
            </div><!--card-footer-->
        </div><!--card-->
    {{ html()->form()->close() }}
@endsection

@push('after-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.0.9/tinymce.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.0.9/jquery.tinymce.min.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).on('click', '.userrole', function() {
            if($(this).is(':checked')){
                var id = $(this).attr('role-id');
                $(this).prev().val(id);
            }else{
                $(this).prev().val(0);
            }
        });

        $('body').on('click', '.pref_check', function(){
            if(this.checked){
                $(this).val(1);
                $(this).attr('checked','checked');
            }else{
                $(this).val(0);
                $(this).removeAttr('checked');
            }
        })
    
        $('#form_email_template_submit').on('submit', function(event) {
            event.preventDefault();
            var formData = new FormData($(this)[0]);
            $.ajax({
                url: "{{ route('admin.email-templates.header-update') }}",
                method: 'POST',
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                beforeSend: function(){
                    $('.loading').removeClass('loading_hide');
                },
                success: function(data)
                {
                    $('.loading').addClass('loading_hide');
                    if(data.status == 'success'){
                        $('.loading').addClass('loading_hide');
                        Swal.fire('Sent!', data.message, 'success');
                        setTimeout(function(){
                        
                        }, 2000);
                    }
                    if(data.status == 'error'){
                        $('.loading').addClass('loading_hide');
                        Swal.fire('Error!', data.message, 'error');
                        $('.btn-success').removeAttr('disabled');
                    }
                },
                error :function( data ) {
                    $('.loading').addClass('loading_hide');
                    if( data.status === 422 ) {
                        $('.loading').addClass('loading_hide');
                        Swal.fire('Error!', data.responseJSON.message, 'error');
                        $('.btn-success').removeAttr('disabled');
                        var errors = [];
                        errors = data.responseJSON.errors
                        $.each(errors, function (key, value) {
                        $('#'+key).parent().addClass('has-danger');
                        $('#'+key).addClass('is-invalid');
                        $('#'+key).parent('.has-danger').find('.invalid-feedback').html(value);
                        $('#'+key).next().children().children().css({"border": "1px solid #f86c6b"});
                        })
                    }
                }
            });
        });
    </script>
@endpush