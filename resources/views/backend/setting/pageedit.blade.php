@extends('backend.layouts.app')

@section('title', 'Edit Pages :: '.app_name())

@section('content')
{{ html()->form('PUT')->id('form_page_edit_submit')->class('form-horizontal')->attribute('enctype', 'multipart/form-data')->open() }}
<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="col-sm-5">
        <h4 class="card-title mb-0">
          Edit Page
          <small class="text-muted"></small>
        </h4>
      </div><!--col-->
    </div><!--row-->
    <hr>
    <div class="row mt-4 mb-4">
      <div class="col">
        <div class="form-group row">
          {{ html()->label('Page Name')->class('col-md-2 form-control-label')->for('pa_name') }}
          <div class="col-md-10">
		    <input type="text" class="form-control" name="pa_name" id="pa_name" placeholder="Page Name" value="{{ @$page['pa_name'] != "" ? $page['pa_name'] : old('pa_name') }}">
        <div class="invalid-feedback"></div>
          </div><!--col-->
        </div><!--form-group-->

        <div class="form-group row">
          {{ html()->label(__('Slug'))->class('col-md-2 form-control-label')->for('slug') }}
          <div class="col-md-10">
             <input type="text" class="form-control" name="slug" id="slug" placeholder="Slug" value="{{ @$page['slug'] != "" ? $page['slug'] : old('slug') }}">
             <div class="invalid-feedback"></div>
          </div><!--col-->
       </div><!--form-group-->

      <div class="form-group row">
        {{ html()->label(__('Description'))->class('col-md-2 form-control-label')->for('desc') }}
        <div class="col-md-10">
        <textarea class="form-control textarea desc" name="desc" id="desc" rows="3">{{ @$page['desc'] != "" ? $page['desc'] : old('desc') }}</textarea>
        </div><!--col-->
      </div><!--form-group-->
      <div class="form-group row">
      {{ html()->label('Seo Tag Title')->class('col-md-2 form-control-label')->for('seo_tag_title') }}
      <div class="col-md-10">
	     <input type="text" class="form-control" name="seo_tag_title" value="{{ @$page['seo_tag_title'] != "" ? $page['seo_tag_title'] : old('seo_tag_title') }}" id="seo_tag_title" placeholder="Seo Tag Title">
        <div class="invalid-feedback"></div>
      </div>
     </div>
	<div class="form-group row">
      {{ html()->label('Seo Tag Description')->class('col-md-2 form-control-label')->for('seo_tag_description') }}
      <div class="col-md-10">
	   <textarea class="textarea seo_tag_description form-control" id="seo_tag_description" name="seo_tag_description" placeholder="Meta Tag Description">{{ @$page['seo_tag_description'] != "" ? $page['seo_tag_description'] : old('seo_tag_description') }}</textarea>

      </div>
    </div>
	<div class="form-group row">
      {{ html()->label('Seo Tag Keywords')->class('col-md-2 form-control-label')->for('seo_tag_keywords') }}
      <div class="col-md-10">
	   <textarea class="textarea seo_tag_keywords form-control" id="seo_tag_keywords" name="seo_tag_keywords" placeholder="Meta Tag Keywords">{{ @$page['seo_tag_keywords'] != "" ? $page['seo_tag_keywords'] : old('seo_tag_keywords') }}</textarea>
      </div>
    </div>

	<div class="form-group row">
	<label class="col-md-2" for=""></label>
	<div class="col-md-10">
	<img id="blah" alt="{{ @$page['featured_image'] }}" src="@if(!empty($page['featured_image'])) {{ url('/images/pages')}}/{{ @$page['featured_image'] }} @else https://via.placeholder.com/500.png @endif" class="img-responsive mt-2 img-thumbnail" width="128" height="128">
	</div>
	</div>
    <div class="form-group row">
    <label class="col-md-2" for="featured_image">Featured Image</label>
	   <div class="col-md-10">
        <div class="form-group">
        <div class="input-group input-file" id="featured_image" name="featured_image">
          <span class="input-group-prepend">
            <button class="btn btn-info btn-choose" type="button">Choose</button>
          </span>
          <input type="text" class="form-control" placeholder='Choose a file...' />
          <span class="input-group-append">
            <button class="btn btn-danger btn-reset" type="button">Reset</button>
          </span>
        </div>
        </div>
    </div>
	</div><!--col-->
</div><!--row-->
</div><!--card-body-->

<div class="card-footer clearfix">
  <div class="row">
    <div class="col text-right">
      {{ form_submit(__('buttons.general.crud.update')) }}
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
    var editor_config = {
          path_absolute : "",
          selector: ".desc",
          /* plugins:['advlist lists autolink link table wordcount searchreplace imagetools',
         'template paste textcolor colorpicker textpattern media','code','image imagetools'], */
    		 plugins: ['advlist autolink lists link image charmap print preview hr anchor pagebreak',
    		'searchreplace wordcount visualblocks visualchars code fullscreen',
    		'insertdatetime media nonbreaking save table contextmenu directionality',
    		'emoticons template paste textcolor colorpicker textpattern imagetools'
    		],
    	   toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
    	   toolbar2: 'print preview media | forecolor backcolor emoticons',
    	   image_advtab: true,


          relative_urls: false,
          height:300,
          file_browser_callback : function(field_name, url, type, win) {
            var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
            var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

            var cmsURL = editor_config.path_absolute + route_prefix + '?field_name=' + field_name;
            if (type == 'image') {
              cmsURL = cmsURL + "&type=Images";
            } else {
              cmsURL = cmsURL + "&type=Files";
            }

            tinyMCE.activeEditor.windowManager.open({
              file : cmsURL,
              title : 'Filemanager',
              width : x * 0.8,
              height : y * 0.8,
              resizable : "yes",
              close_previous : "no"
            });
          }
        };

        tinymce.init(editor_config);

    </script>
     <script type="text/javascript">
    $(document).ready(function() {
    $('#form_page_edit_submit').on('submit', function(event) {
      event.preventDefault();
      var formData = new FormData($(this)[0]);
      $.ajax({
        url: "{{ route('admin.pages.update',$page['id']) }}",
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
          if(data.status == 'success'){
            $('.loading').addClass('loading_hide');
            Swal.fire('Sent!', data.message, 'success');
            setTimeout(function(){
              window.location.href = "{{ route('admin.pages.index') }}";
            }, 2000);
          }
          if(data.status == 'error'){
            $('.loading').addClass('loading_hide');
            Swal.fire('Error!', data.message, 'error');
            $('.btn-success').removeAttr('disabled');
          }
        },
        error :function( data ) {
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
  });
    </script>
@endpush
