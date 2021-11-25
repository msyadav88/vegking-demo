@extends('backend.layouts.app')

@section('title', 'Country Regions :: '.app_name())

@section('content')
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-md-6">
					<h4 class="card-title mb-0">
						Transport Country Regions
					</h4>
				</div><!--col-->
				<div class="col-md-6">
					<button type="button" id="createBtn" class="pull-right btn btn-success" data-url=""><i class="fas fa-plus"></i> Add New </button>
				</div>
			</div><!--row-->
			<hr />
			<div class="row mt-2">
				<div class="col">
					<div class="table-offers">
						<table id="country_regions" class="table table-bordered data-table">
							<thead>
								<tr>
									<th>ID</th>
									<th>Country</th>
									<th>Regions</th>
									<th>Date Added</th>
									<th>@lang('labels.general.actions')</th>
								</tr>
							</thead>
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
					<h4 style="text-align: center; width: 100%;"><span class="glyphicon glyphicon-lock" id="countryRegion"></span> </h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body" style="padding:15px 50px;">
					<form role="form" id="create_countryRegion_form">
						<input type="hidden" name="rec_id" id="rec_id" value="0">
						<div class="form-group">
							<label for="country"><span class="glyphicon glyphicon-user"></span> Country </label>
							<input type="text" class="form-control" name="country" id="country" placeholder="Enter Country">
							<div class="invalid-feedback"></div>
						</div>
						<div class="form-group">
							<label for="key"><span class="glyphicon glyphicon-eye-open"></span> Region</label>
							<input type="text" class="form-control" id="region" name="region" placeholder="Enter Region" required="required">
							<div class="invalid-feedback"></div>
						</div>
						<button id="create_countryRegion" type="submit" class="btn btn-success btn-block">Create</button>
					</form>
				</div>
			</div>
		</div>
  	</div>
@endsection
@push('after-scripts')
	<script type="text/javascript">
		$(document).ready(function(){
			$("#createBtn").click(function(){
				$('#country').val("");
				$("#region").val("");
				$("#rec_id").val("");

				$('input').val("");
				$("#create_countryRegion").html("Create");
				$("#countryRegion").html("Create Country Region");	
				$("#createModal").modal();
			});
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
		
			var table = $('.data-table').DataTable({
				processing: true,
				serverSide: true,
				autoWidth: false,
				responsive: true,
				scrollX: true,
				orderCellsTop: true,
				fixedHeader: true,
				ajax: "{{ route('admin.transport.index') }}",
				columns: [
					{data: 'id', name: 'id'},
					{data: 'country', name: 'country'},
					{data: 'region', name: 'region'},
					{data: 'created_at', name: 'created_at'},
					{data: 'action', name: 'action', orderable: false, searchable: false},
				]
			});

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
							url: "{{ route('admin.transport.delete') }}",
							method: 'POST',
							data: {id:del_id},
							dataType: "json",
							beforeSend: function(){
							},
							success: function(data)
							{
								if(data.status == 'success'){
									Swal.fire('Success', data.message, 'success');
									table.draw();
								}else{
									Swal.fire('Error', data.message, 'error');	
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

			$('body').on('click','.editItem',function () {
				$('.invalid-feedback').empty();
				$('input').removeClass('is-invalid');
				edit_id = $(this).data('url')
				$.ajax({
					url: "{{ route('admin.transport.getData') }}",
					method: 'POST',
					data: {id:edit_id},
					dataType: "json",
					beforeSend: function(){
					},
					success: function(data)
					{
						$('#create_countryRegion').removeAttr("disabled");
						$('#create_countryRegion_form').trigger("reset");
						if(data.status == 'error'){
							Swal.fire('Error', data.message, 'error');
						}else{
							$("#country").val(data.country);
							$("#region").val(data.region);
							$("#rec_id").val(data.id);

							$("#countryRegion").html("Edit Country Region");
							$("#create_countryRegion").html("Update");
							$("#createModal").modal('toggle');
						}
					},
					error :function( data ) {
						$('#create_countryRegion').removeAttr("disabled");
						$('#create_countryRegion_form').trigger("reset");
						if( data.status === 422 ) {
							Swal.fire('Error!', data.responseJSON.message, 'error');
							var errors = [];
							errors = data.responseJSON.errors;
						}
					}
				});
			});

			$('#create_countryRegion_form').on('submit', function(event) {
				event.preventDefault();
				var eidtData = $('#rec_id').val();
				if(eidtData)
				{
					var url = "{{ route('admin.transport.updateData') }}";
				}
				else
				{
					var url = "{{ route('admin.transport.store') }}";
				}
				var formData = new FormData(this);
				$.ajax( {
					url: url,
					method: 'POST',
					data: formData,
					contentType: false,							
					cache: false,
					processData: false,
					dataType: "json",
					beforeSend: function(){
						$('.loading').removeClass('loading_hide');
					},
					success: function(json_data) {
						$('#create_countryRegion').removeAttr("disabled");
						$('#create_countryRegion_form').trigger("reset");
						if( json_data.status ==  'error'){
							$('.loading').addClass('loading_hide');
							Swal.fire("Error!", json_data.message, 'error');
						}else{
							$('.loading').addClass('loading_hide');
							Swal.fire('Success' , json_data.message, 'success');
							$("#create_countryRegion").html("Create");
							$('#createModal').modal('toggle');
							table.draw();
						}
					},
					error: function(data) {
						$('#create_countryRegion').removeAttr("disabled");
						$('#create_countryRegion_form').trigger("reset");
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