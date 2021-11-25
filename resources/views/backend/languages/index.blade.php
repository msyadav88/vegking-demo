@extends('backend.layouts.app')

@section('title', __('strings.backend.translations.title'). ' :: '.app_name())

@section('content')

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('strings.backend.translations.title') }} 
                    <button type="button" id="createBtn" class="btn btn-primary" data-url=""> Add New <i class="fas fa-add"></i></button>
                </h4>
            </div><!--col-->
        </div><!--row-->
        <hr />

        <div class="row mt-2">
            <div class="col">
                <div class="table-offers">
                      <table id="buyer_table" class="table table-bordered data-table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Group</th>
                            <th>Key</th>
                            @foreach( $locale['languages'] as $lang_key => $lang_code )
                            <th>@lang('menus.language-picker.langs.'.$lang_key)</th>
                            @endforeach
                            <th>@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <!--tfoot>
                            <tr id="filter">
                                <th data-title="ID"><input type="text" placeholder="Search ID" /></th>
                                <th data-title="Language Label"><input type="text" placeholder="Search Language Label" /></th>
	                            @foreach( $locale['languages'] as $lang_key => $lang_code )
	                            <th data-title="@lang('menus.language-picker.langs.'.$lang_key)">
	                            	<input type="text" placeholder="Search @lang('menus.language-picker.langs.'.$lang_key)" />
	                            </th>
	                            @endforeach
                                <th data-title="action"><input type="text" placeholder="Search action" /></th>
                            </tr>
                        </tfoot-->    
                    </table>
                </div>
            </div><!--col-->
        </div><!--row-->
        
    </div><!--card-body-->
</div><!--card-->

<!-- Modal -->
  <div class="modal fade" id="createModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">

        <div class="modal-header" style="padding:15px 50px;">
          <h4 style="text-align: center; width: 100%;"><span class="glyphicon glyphicon-lock" id="trans_title"></span> </h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
        </div>

        <div class="modal-body" style="padding:15px 50px;">
          <form role="form" id="create_translation_form">
          	<input type="hidden" name="rec_id" id="rec_id" value="0">
            <div class="form-group">
              <label for="group"><span class="glyphicon glyphicon-user"></span> Group </label>
              <input type="text" class="form-control" name="group" id="group" placeholder="Enter Group">
			  <div class="invalid-feedback"></div>
			</div>

            <div class="form-group">
              <label for="key"><span class="glyphicon glyphicon-eye-open"></span> Key</label>
              <input type="text" class="form-control" id="key" name="key" placeholder="Enter Key" required="required">
			  <div class="invalid-feedback"></div>
		    </div>

            	@foreach( $locale['languages'] as $lang_key => $lang_code )
            	<div class="form-group">
                	<label for="{{$lang_key}}">
                		<span class="glyphicon glyphicon-eye-open"></span> @lang('menus.language-picker.langs.'.$lang_key)
                	</label>
                	<input type="text" class="form-control" 
                	id="{{$lang_key}}" 
                	name="{{$lang_key}}" 
                	placeholder="Enter @lang('menus.language-picker.langs.'.$lang_key)" required="required"> 
					<div class="invalid-feedback"></div>
            </div>
                @endforeach

              <a href="javascript:void(0);" id="create_translation" class="btn btn-success btn-block">Create</a>

          </form>
        </div>
        
      </div>
      
    </div>
  </div> 
</div>
 
@endsection
@push('after-scripts')
<script type="text/javascript">
	$(document).ready(function(){
		  $("#createBtn").click(function(){
			$('#group').val("");
			$("#key").val("");
			$("#rec_id").val("");
			// for( lang_key in langData.text ){
			// 	$("#"+lang_key).val("");
			// }	
			$('input').val("");
		  $("#trans_title").html("Create Translations");	
		    $("#createModal").modal();
		  });
	    $.ajaxSetup({
	      headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	      }
	    });
    $('#buyer_table #filter th').each( function () {
        var title = $(this).attr('data-title');
            $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        autoWidth: false,
        responsive: true,
        scrollX: true,
        ajax: "{{ route('admin.languages.loadLanguageFile') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'group', name: 'group'},
            {data: 'key', name: 'key'},
			@foreach( $locale['languages'] as $lang_key => $lang_code )
            {data: 'text.{{$lang_key}}', name: '@lang("menus.language-picker.langs.".$lang_key)'},
            @endforeach
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        initComplete: function( settings, json ) {
		 resetDatatable();
	  	}
    });

	function  resetDatatable() {
		
		$('body').on('click','.deleteItem',function () {
		del_id = $(this).data('id')
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
						url: "{{ route('admin.languages.deleteLanguageLine') }}",
						method: 'DELETE',
						data: {del_id:del_id},
						dataType: "json",
						beforeSend: function(){
						},
						success: function(data)
						{
							if(data.status == 'success'){
								Swal.fire(data.message, data.message, 'success');
								table.ajax.reload( resetDatatable, false );
							}else{
								Swal.fire(data.message, data.message, 'error');	
							}
						},
						error :function( data ) {
							if( data.status === 422 ) {
								Swal.fire('Error!', data.responseJSON.message, 'error');
								var errors = [];
								errors = data.responseJSON.errors;
							}
						}

		    	})
            }
            });
		    });

			$('#buyer_table').on('click','.editItem',function () {
			
				$('.invalid-feedback').empty();
				$('input').removeClass('is-invalid');
				edit_id = $(this).data('id')
				$.ajax({
						url: "{{ route('admin.languages.getLanguageLine') }}",
						method: 'get',
						data: {edit_id:edit_id},
						dataType: "json",
						beforeSend: function(){
						},
						success: function(data)
						{
							if(data.status == 'success'){
								langData = data.langData;
								$("#group").val(langData.group);
								$("#key").val(langData.key);
								$("#rec_id").val(langData.id);
								for( lang_key in langData.text ){
									$("#"+lang_key).val( langData.text[lang_key] );
								}	
								$("#trans_title").html("Edit Translations");
								$("#create_translation").html("Update");
								$("#createModal").modal('toggle');
									
								table.ajax.reload(resetDatatable, false);
							}else{
								Swal.fire(data.message, data.message, 'error');	
							}
						},
						error :function( data ) {
							if( data.status === 422 ) {
								Swal.fire('Error!', data.responseJSON.message, 'error');
								var errors = [];
								errors = data.responseJSON.errors;
								console.log(errors);
							}
						}
				});
			});
		}

		$("#create_translation").click(function() {
			form_values = $("#create_translation_form").serialize();
			$.ajax( {
				url: "{{ route('admin.languages.saveLanguageTrans') }}",
				method: 'POST',
				data: form_values,
				beforeSend: function(){
				$('.loading').removeClass('loading_hide');
				},
				success: function(json_data) {
					if( json_data.error == 1 ){
						$('.loading').addClass('loading_hide');
						Swal.fire("Error!", json_data.message, 'error');
					}else{
						$('.loading').addClass('loading_hide');
						Swal.fire(json_data.message , json_data.message, 'success');
						$("#create_translation").html("Create");
						$('#createModal').modal('toggle');
						table.ajax.reload(resetDatatable, false);
						document.getElementById("create_translation_form").reset();
					}
				},
				error: function(data) {
					
                if (data.status === 422) {
					$('.loading').addClass('loading_hide');
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
	}); // document.ready

</script>

<style>
	label {
		margin-bottom: 2px;
	}
	.form-group {
		margin-bottom: 5px;
	}
</style>


@endpush