@extends('backend.layouts.app')
@section('title', __('Message Templates'). ' :: ' . app_name())
@section('content')
@if(!empty($msg))
    <div class="card-body alert-danger">
        <div class="row">
            <div class="col-sm-12">
                <div>{{ $msg }}</div>
            </div>
        </div>
    </div>
@endif
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('Message Templates') }} <small class="text-muted"></small>
                </h4>
            </div><!--col-->

            <div class="col-sm-2">
                <p style="color:red"><span id="counting">0</span> changes to be save</p>
            </div><!--col-->

            <div class="col-sm-5">
                <div class="btn-toolbar float-right" role="toolbar" aria-label="@lang('labels.general.toolbar_btn_groups')">
                    <a href="{{ route('admin.email-templates.create') }}" class="btn btn-success ml-1" data-toggle="tooltip" title="@lang('labels.general.create_new')"><i class="fas fa-plus-circle"></i></a>
                    <a href="{{ url('admin/email-templates/header') }}/1" class="btn btn-success ml-1" data-toggle="tooltip" title="@lang('labels.general.create_new')"><i class="fas fa-plus-circle"></i> Header Footer</a>
                </div><!--btn-toolbar-->
            </div><!--col-->
        </div><!--row-->
        {{ html()->form('POST',route('admin.email-templates.update_push'))->id('#formsubmit')->class('form-horizontal')->open() }}
        Push notification Sound
        <?php 
        foreach($push_sounds as $r)
        {
          $push_id=$r->id;
        }
        ?>
              <select name="push_notification">
                  <option value="1" <?php if ($push_id == 1 ) echo 'selected' ; ?>>Sound-1</option>
                  <option value="2" <?php if ($push_id == 2 ) echo 'selected' ; ?>>Sound-2</option>
              </select>
            <button type="submit" class="btn-sucess">Update</button>
        {{ html()->form()->close() }}
        <div class="row mt-2">
            
            <div class="col">
                <div class="table-offers">
                 
                        <table class="table table-bordered data-table">
                            <thead>
                                <tr>
                                    <th>@lang('labels.backend.templates.id')</th>
                                    <th>@lang('labels.backend.templates.title')</th>
                                    <th>@lang('labels.backend.templates.subject')</th>
                                    <th>Recipients</th>
                                    <th>@lang('labels.backend.templates.sent')</th>
                                    <th>@lang('labels.backend.templates.status')</th>
                                    <th>Header/Footer</th>
                                    <th>@lang('labels.general.actions')</th>
                                </tr>
                            </thead>
                        </table>
                
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection

@push('after-scripts')
<script type="text/javascript">
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#formsubmit').on('submit', function(event) {
            alert("hi");
        event.preventDefault();

        $('.has-danger').next().children().children().css({
            "border": ""
        });
        $('.is-invalid').removeClass("is-invalid");
        $('.invalid-feedback').html("");
        $('.has-danger').removeClass("has-danger");

        var formData = new FormData($(this)[0]);

        $( ".pref_check" ).each(function( key, value ) {
            if(value.value == 0){
                formData.append(value.name, value.value);
            }
        });

        $.ajax({
            url: "{{ route('admin.email-templates.update_push') }}",
            method: 'POST',
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
             $('.loading').removeClass('loading_hide');
            },
            success: function(data) {
                $('.loading').addClass('loading_hide');
                if (data.status == 'success') {
                    Swal.fire('Sent!', data.message, 'success');
                    setTimeout(function() {
                        window.location.href = "{{ route('admin.email-templates.index') }}";
                    }, 500);
                }
                if (data.status == 'error') {
                    Swal.fire('Error!', data.message, 'error');
                }
            },
            error: function(data) {
                $('.loading').addClass('loading_hide');
                if (data.status === 422) {
                    Swal.fire('Error!', data.responseJSON.message, 'error');
                    $('.btn-success').removeAttr('disabled');
                    var errors = [];
                    errors = data.responseJSON.errors
                    $.each(errors, function(key, value) {
                        $('#' + key).parent().addClass('has-danger');
                        $('#' + key).addClass('is-invalid');
                        $('#' + key).parent('.has-danger').find('.invalid-feedback').html(value);
                        $('#' + key).next().children().children().css({
                            "border": "1px solid #f86c6b"
                        });
                    })
                }
            }
        });
    });
        setTimeout(function() {
            $(".alert-danger").hide();
        }, 3000);
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: false,
            responsive: true,
            ajax: "{{ route('admin.email-templates.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'title', name: 'title'},
                {data: 'subject', name: 'subject'},
                {data: 'recipients', name: 'recipients'},
                {data: 'sent', name: 'sent'},
                {data: 'status', name: 'status'},
                {data: 'global_header', name: 'global_header'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

        $('body').on('click', '.editItem', function () {
            var item_url = $(this).data("url");
            window.location.href = item_url;
        });

        $('body').on('click', '.viewItem', function () {
            var item_url = $(this).data("url");
            window.location.href = item_url;
        });

        $('body').on('click', '.deleteItem', function () {
            var product_id = $(this).data("id");
            Swal.fire({
                title: 'Are You sure want to delete?',
                text: 'You will not be able to recover this template!',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, keep it'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "DELETE",
                        url: "{{ url('admin/email-templates') }}"+'/'+product_id,
                        success: function (data) {
                            Swal.fire('Deleted!', 'Template has been deleted.', 'success');
                            table.draw();
                        },
                        error: function (data) {
                        Swal.fire('Error!', 'template not deleted', 'error');
                        }
                    });
                }
            });
        });

        $('body').on('click', '.global-header', function(){
            var id = $(this).attr('template');
            if(this.checked){
                $(this).val(1);
                $(this).attr('checked','checked');
            }else{
                $(this).val(0);
                $(this).removeAttr('checked');
            }
            var status = $(this).val();
            $.ajax({
                url: "{{route('admin.email-templates.headerFooter')}}",
                method: 'POST',
                data: {id:id, status:status},
                dataType: "json",
                beforeSend: function() {
                    $('.loading').removeClass('loading_hide');
                },
                success: function(data) {
                    if (data.status == 'success') {
                        $('.loading').addClass('loading_hide');
                        Swal.fire('Sent!', data.message, 'success');
                    }
                    if (data.status == 'error') {
                        $('.loading').addClass('loading_hide');
                        Swal.fire('Error!', data.message, 'error');
                    }
                },
                error: function(data) {
                    if (data.status === 422) {
                        $('.loading').addClass('loading_hide');
                        Swal.fire('Error!', data.responseJSON.message, 'error');
                    }
                }
            });
        })

        $(document).on('click', '.userrole', function() {
            if($(this).is(':checked')){
                var count = $('#counting').text();
                $('#counting').html(Number(count)+Number(1));
                var id = $(this).attr('role-id');
                $(this).prev().val(id);
            }else{
                $(this).prev().val(0);
                var count = $('#counting').text();
                $('#counting').html(Number(count)+Number(1));
            }
        });

        $('#recipients-update').on('submit', function(event) {
            event.preventDefault();
            var formData = new FormData($(this)[0]);

            $.ajax({
                url: "{{ route('admin.email-templates.recipients') }}",
                method: 'POST',
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                beforeSend: function() {
                    $('.loading').removeClass('loading_hide');
                },
                success: function(data) {
                    $('#recipients-update').find('button').removeAttr('disabled');
                    $('.loading').addClass('loading_hide');
                    if (data.status == 'success') {
                        Swal.fire('Congrats!', data.message, 'success');
                    }
                    if (data.status == 'error') {
                        Swal.fire('Error!', data.message, 'error');
                    }
                },
            });
        });

    });
  </script>
  @endpush
