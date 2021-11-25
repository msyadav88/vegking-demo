@extends('backend.layouts.app')

@section('title', __('Language Content').' :: '.app_name())

@section('content')
{{ html()->form('PUT')->id('form_role_submit3')->class('form-horizontal')->attribute('enctype', 'multipart/form-data')->open() }}
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Language Content
                    <small class="text-muted"></small>
                </h4>
            </div>
            <!--col-->
        </div>
        <!--row-->
        <hr>
        <div class="row mt-4 mb-4">
            <div class="col">
                <input type="hidden" class="form-control" name="id" id="id" placeholder="id" value="{{ @$LanguageContent->id }}">
                <div class="row">
                    <div class="col-md-12">
                        <div id="tabs">
                            <ul class="nav nav-tabs ui-sortable">
                                <li class="nav-item "><a class="nav-link active" href="#vk1" data-toggle="tab" data-container="body" data-placement="top" data-content="The given data was invalid.">ABOUT US</a></li>
                                <li class="nav-item "><a class="nav-link" href="#vk2" data-toggle="tab" data-container="body" data-placement="top" data-content="The given data was invalid.">IMPORT</a></li>
                                <li class="nav-item "><a class="nav-link" href="#vk3" data-toggle="tab" data-container="body" data-placement="top" data-content="The given data was invalid.">EXPORT</a></li>
                                <li class="nav-item "><a class="nav-link" href="#vk4" data-toggle="tab" data-container="body" data-placement="top" data-content="The given data was invalid.">NEWLETTER</a></li>
                                <li class="nav-item "><a class="nav-link" href="#vk5" data-toggle="tab" data-container="body" data-placement="top" data-content="The given data was invalid.">SALES DEPARTMENT</a></li>
                                <li class="nav-item "><a class="nav-link" href="#vk6" data-toggle="tab" data-container="body" data-placement="top" data-content="The given data was invalid.">CONTACT</a></li>
                                <li class="nav-item "><a class="nav-link" href="#vk7" data-toggle="tab" data-container="body" data-placement="top" data-content="The given data was invalid.">FOOTER</a></li>
                                <li class="nav-item "><a class="nav-link" href="#vk8" data-toggle="tab" data-container="body" data-placement="top" data-content="The given data was invalid.">EXTRA</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="vk1" class="tab-pane active">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ html()->label('AboutUs en')->class('form-control-label')->for('about_us_en') }}
                                                {{ html()->text('about_us_en')
                                                    ->class('form-control')
                                                    ->placeholder('about_us_en')
                                                    ->value(@$LanguageContent->about_us_en)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ html()->label('AboutUs pl')->class('form-control-label')->for('about_us_pl') }}
                                                {{ html()->text('about_us_pl')
                                                    ->class('form-control')
                                                    ->placeholder('about_us_pl')
                                                    ->value(@$LanguageContent->about_us_pl)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ html()->label('AboutUs de')->class('form-control-label')->for('about_us_de') }}
                                                {{ html()->text('about_us_de')
                                                    ->class('form-control ')
                                                    ->placeholder('about_us_de')
                                                    ->value(@$LanguageContent->about_us_de)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{ html()->label('Section Content en')->class('form-control-label')->for('section_1_en') }}
                                                {{ html()->textarea('section_1_en')
                                                    ->class('form-control')
                                                    ->placeholder('section_1_en')
                                                    ->value(@$LanguageContent->section_1_en)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <!--col-->
                                        </div>
                                        <!--form-group-->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{ html()->label('Section Content pl')->class('form-control-label')->for('section_1_pl') }}
                                                {{ html()->textarea('section_1_pl')
                                                    ->class('form-control')
                                                    ->placeholder('section_1_pl')
                                                    ->value(@$LanguageContent->section_1_pl)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <!--col-->
                                        </div>
                                        <!--form-group-->

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{ html()->label('Section Content de')->class('form-control-label')->for('section_1_de') }}
                                                {{ html()->textarea('section_1_de')
                                                    ->class('form-control')
                                                    ->placeholder('section_1_de')
                                                    ->value(@$LanguageContent->section_1_de)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <!--col-->
                                        </div>
                                        <!--form-group-->

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ html()->label('Read More Button en')->class('form-control-label')->for('read_more_en') }}
                                                {{ html()->text('read_more_en')
                                                    ->class('form-control')
                                                    ->placeholder('read_more_en')
                                                    ->value(@$LanguageContent->read_more_en)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ html()->label('Read More Button pl')->class('form-control-label')->for('read_more_pl') }}
                                                {{ html()->text('read_more_pl')
                                                    ->class('form-control')
                                                    ->placeholder('read_more_pl')
                                                    ->value(@$LanguageContent->read_more_pl)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ html()->label('Read More Button de')->class('form-control-label')->for('read_more_de') }}
                                                {{ html()->text('read_more_de')
                                                    ->class('form-control')
                                                    ->placeholder('read_more_de')
                                                    ->value(@$LanguageContent->read_more_de)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->

                                        <!--form-group-->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{ html()->label('Read More Content en')->class('form-control-label')->for('read_more_content_en') }}
                                                {{ html()->textarea('read_more_content_en')
                                                    ->class('form-control')
                                                    ->placeholder('read_more_content_en')
                                                    ->value(@$LanguageContent->read_more_content_en)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <!--col-->
                                        </div>
                                        <!--form-group-->

                                        <!--form-group-->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{ html()->label('Read More Content pl')->class('form-control-label')->for('read_more_content_pl') }}
                                                {{ html()->textarea('read_more_content_pl')
                                                    ->class('form-control')
                                                    ->placeholder('read_more_content_pl')
                                                    ->value(@$LanguageContent->read_more_content_pl)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <!--col-->
                                        </div>
                                        <!--form-group-->

                                        <!--form-group-->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{ html()->label('Read More Content de')->class('form-control-label')->for('read_more_content_de') }}
                                                {{ html()->textarea('read_more_content_de')
                                                    ->class('form-control')
                                                    ->placeholder('read_more_content_de')
                                                    ->value(@$LanguageContent->read_more_content_de)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <!--col-->
                                        </div>
                                        <!--form-group-->
                                    </div>
                                </div>
                                <div id="vk2" class="tab-pane product-group">
                                    <div class="row">
                                        <!-- start import -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ html()->label('Import Tittle en')->class('form-control-label')->for('import_en') }}
                                                {{ html()->text('import_en')
                                                    ->class('form-control')
                                                    ->placeholder('import_en')
                                                    ->value(@$LanguageContent->import_en)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ html()->label('Import Tittle pl')->class('form-control-label')->for('import_pl') }}
                                                {{ html()->text('import_pl')
                                                    ->class('form-control')
                                                    ->placeholder('import_pl')
                                                    ->value(@$LanguageContent->import_pl)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ html()->label('Import Tittle de')->class('form-control-label')->for('import_de') }}
                                                {{ html()->text('import_de')
                                                    ->class('form-control')
                                                    ->placeholder('import_de')
                                                    ->value(@$LanguageContent->import_de)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->

                                        <!--col-->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{ html()->label('Import Column 1 Heading en')->class('form-control-label')->for('heading_col_1_en') }}
                                                {{ html()->textarea('heading_col_1_en')
                                                    ->class('form-control')
                                                    ->placeholder('heading_col_1_en')
                                                    ->value(@$LanguageContent->heading_col_1_en)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            
                                        </div>
                                        <!--col-->

                                        <!--col-->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{ html()->label('Import Column 1 Heading pl')->class('form-control-label')->for('heading_col_1_pl') }}
                                                {{ html()->textarea('heading_col_1_pl')
                                                    ->class('form-control')
                                                    ->placeholder('heading_col_1_pl')
                                                    ->value(@$LanguageContent->heading_col_1_pl)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->

                                        <!--col-->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{ html()->label('Import Column 1 Heading de')->class('form-control-label')->for('heading_col_1_de') }}
                                                {{ html()->textarea('heading_col_1_de')
                                                    ->class('form-control')
                                                    ->placeholder('heading_col_1_de')
                                                    ->value(@$LanguageContent->heading_col_1_de)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->

                                        <!--col-->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{ html()->label('Import Column 2 Heading en')->class('form-control-label')->for('heading_col_2_en') }}
                                                {{ html()->textarea('heading_col_2_en')
                                                    ->class('form-control')
                                                    ->placeholder('heading_col_2_en')
                                                    ->value(@$LanguageContent->heading_col_2_en)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->

                                        <!--col-->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{ html()->label('Import Column 2 Heading pl')->class('form-control-label')->for('heading_col_2_pl') }}
                                                {{ html()->textarea('heading_col_2_pl')
                                                    ->class('form-control')
                                                    ->placeholder('heading_col_2_pl')
                                                    ->value(@$LanguageContent->heading_col_2_pl)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->

                                        <!--col-->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{ html()->label('Import Column 2 Heading de')->class('form-control-label')->for('heading_col_2_de') }}
                                                {{ html()->textarea('heading_col_2_de')
                                                    ->class('form-control')
                                                    ->placeholder('heading_col_2_de')
                                                    ->value(@$LanguageContent->heading_col_2_de)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->

                                        <!--col-->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{ html()->label('Import Column 3 Heading en')->class('form-control-label')->for('heading_col_3_en') }}
                                                {{ html()->textarea('heading_col_3_en')
                                                        ->class('form-control')
                                                        ->placeholder('heading_col_3_en')
                                                        ->value(@$LanguageContent->heading_col_3_en)
                                                        }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->

                                        <!--col-->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{ html()->label('Import Column 3 Heading pl')->class('form-control-label')->for('heading_col_3_pl') }}
                                                {{ html()->textarea('heading_col_3_pl')
                                                    ->class('form-control')
                                                    ->placeholder('heading_col_3_pl')
                                                    ->value(@$LanguageContent->heading_col_3_pl)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->

                                        <!--col-->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{ html()->label('Import Column 3 Heading de')->class('form-control-label')->for('heading_col_3_de') }}
                                                {{ html()->textarea('heading_col_3_de')
                                                    ->class('form-control')
                                                    ->placeholder('heading_col_3_de')
                                                    ->value(@$LanguageContent->heading_col_3_de)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->

                                        <!--col-->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{ html()->label('Import Column 1 Content en')->class('form-control-label')->for('import_col_1_en') }}
                                                {{ html()->textarea('import_col_1_en')
                                                    ->class('form-control')
                                                    ->placeholder('import_col_1_en')
                                                    ->value(@$LanguageContent->import_col_1_en)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->

                                        <!--col-->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{ html()->label('Import Column 1 Content pl')->class('form-control-label')->for('import_col_1_pl') }}
                                            
                                                {{ html()->textarea('import_col_1_pl')
                                                    ->class('form-control')
                                                    ->placeholder('import_col_1_pl')
                                                    ->value(@$LanguageContent->import_col_1_pl)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->

                                        <!--col-->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{ html()->label('Import Column 1 Content de')->class('form-control-label')->for('import_col_1_de') }}
                                                {{ html()->textarea('import_col_1_de')
                                                    ->class('form-control')
                                                    ->placeholder('import_col_1_de')
                                                    ->value(@$LanguageContent->import_col_1_de)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->

                                        <!--col-->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{ html()->label('Import Column 2 Content en')->class('form-control-label')->for('import_col_2_en') }}
                                                {{ html()->textarea('import_col_2_en')
                                                    ->class('form-control')
                                                    ->placeholder('import_col_2_en')
                                                    ->value(@$LanguageContent->import_col_2_en)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->
                                        
                                        <!--col-->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{ html()->label('Import Column 2 Content pl')->class('form-control-label')->for('import_col_2_pl') }}
                                                {{ html()->textarea('import_col_2_pl')
                                                    ->class('form-control')
                                                    ->placeholder('import_col_2_pl')
                                                    ->value(@$LanguageContent->import_col_2_pl)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->

                                        <!--col-->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{ html()->label('Import Column 2 Content de')->class('form-control-label')->for('import_col_2_de') }}
                                                {{ html()->textarea('import_col_2_de')
                                                    ->class('form-control')
                                                    ->placeholder('import_col_2_de')
                                                    ->value(@$LanguageContent->import_col_2_de)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->

                                        <!--col-->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{ html()->label('Import Column 3 Content en')->class('form-control-label')->for('import_col_3_en') }}
                                                {{ html()->textarea('import_col_3_en')
                                                    ->class('form-control')
                                                    ->placeholder('import_col_3_en')
                                                    ->value(@$LanguageContent->import_col_3_en)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->

                                        <!--col-->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{ html()->label('Import Column 3 Content pl')->class('form-control-label')->for('import_col_3_pl') }}
                                                {{ html()->textarea('import_col_3_pl')
                                                    ->class('form-control')
                                                    ->placeholder('import_col_3_pl')
                                                    ->value(@$LanguageContent->import_col_3_pl)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->

                                        <!--col-->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{ html()->label('Import Column 3 Content de')->class('form-control-label')->for('import_col_3_de') }}
                                                {{ html()->textarea('import_col_3_de')
                                                    ->class('form-control')
                                                    ->placeholder('import_col_3_de')
                                                    ->value(@$LanguageContent->import_col_3_de)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->
                                    </div>
                                </div>
                                <div id="vk3" class="tab-pane product-group">
                                    <div class="row">
                                        <!-- start export -->
                                        <!--col-->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ html()->label('Export Tittle en')->class('form-control-label')->for('export_en') }}
                                                {{ html()->text('export_en')
                                                    ->class('form-control')
                                                    ->placeholder('export_en')
                                                    ->value(@$LanguageContent->export_en)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ html()->label('Export Tittle pl')->class('form-control-label')->for('export_pl') }}
                                                {{ html()->text('export_pl')
                                                    ->class('form-control')
                                                    ->placeholder('export_pl')
                                                    ->value(@$LanguageContent->export_pl)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ html()->label('Export Tittle de')->class('form-control-label')->for('export_de') }}
                                                {{ html()->text('export_de')
                                                    ->class('form-control')
                                                    ->placeholder('export_de')
                                                    ->value(@$LanguageContent->export_de)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->

                                        <!--col-->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{ html()->label('Export Row 1 Heading en')->class('form-control-label')->for('heading_row_1_en') }}
                                                {{ html()->textarea('heading_row_1_en')
                                                    ->class('form-control')
                                                    ->placeholder('heading_row_1_en')
                                                    ->value(@$LanguageContent->heading_row_1_en)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->

                                        <!--col-->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{ html()->label('Export Row 1 Heading pl')->class('form-control-label')->for('heading_row_1_pl') }}
                                                {{ html()->textarea('heading_row_1_pl')
                                                        ->class('form-control')
                                                        ->placeholder('heading_row_1_pl')
                                                        ->value(@$LanguageContent->heading_row_1_pl)
                                                        }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->

                                        <!--col-->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{ html()->label('Export Row 1 Heading de')->class('form-control-label')->for('heading_row_1_de') }}
                                                {{ html()->textarea('heading_row_1_de')
                                                    ->class('form-control')
                                                    ->placeholder('heading_row_1_de')
                                                    ->value(@$LanguageContent->heading_row_1_de)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->

                                        <!--col-->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{ html()->label('Export Row 2 Heading en')->class('form-control-label')->for('heading_row_2_en') }}
                                                {{ html()->textarea('heading_row_2_en')
                                                    ->class('form-control')
                                                    ->placeholder('heading_row_2_en')
                                                    ->value(@$LanguageContent->heading_row_2_en)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->

                                        <!--col-->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{ html()->label('Export Row 2 Heading pl')->class('form-control-label')->for('heading_row_2_pl') }}
                                                {{ html()->textarea('heading_row_2_pl')
                                                    ->class('form-control')
                                                    ->placeholder('heading_row_2_pl')
                                                    ->value(@$LanguageContent->heading_row_2_pl)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->

                                        <!--col-->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{ html()->label('Export Row 2 Heading de')->class('form-control-label')->for('heading_row_2_de') }}
                                                {{ html()->textarea('heading_row_2_de')
                                                        ->class('form-control')
                                                        ->placeholder('heading_row_2_de')
                                                        ->value(@$LanguageContent->heading_row_2_de)
                                                        }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->

                                        <!--col-->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{ html()->label('Export Row 3 Heading en')->class('form-control-label')->for('heading_row_3_en') }}
                                                {{ html()->textarea('heading_row_3_en')
                                                    ->class('form-control')
                                                    ->placeholder('heading_row_3_en')
                                                    ->value(@$LanguageContent->heading_row_3_en)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->

                                        <!--col-->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{ html()->label('Export Row 3 Heading pl')->class('form-control-label')->for('heading_row_3_pl') }}
                                                {{ html()->textarea('heading_row_3_pl')
                                                    ->class('form-control')
                                                    ->placeholder('heading_row_3_pl')
                                                    ->value(@$LanguageContent->heading_row_3_pl)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->

                                        <!--col-->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{ html()->label('Export Row 3 Heading de')->class('form-control-label')->for('heading_row_3_de') }}
                                                    {{ html()->textarea('heading_row_3_de')
                                                        ->class('form-control')
                                                        ->placeholder('heading_row_3_de')
                                                        ->value(@$LanguageContent->heading_row_3_de)
                                                    }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->

                                        <!--col-->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{ html()->label('Export Row 1 Content en')->class('form-control-label')->for('Export_row_1_en') }}
                                                {{ html()->textarea('Export_row_1_en')
                                                    ->class('form-control')
                                                    ->placeholder('Export_row_1_en')
                                                    ->value(@$LanguageContent->Export_row_1_en)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->

                                        <!--col-->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{ html()->label('Export Row 1 Content pl')->class('form-control-label')->for('Export_row_1_pl') }}
                                                {{ html()->textarea('Export_row_1_pl')
                                                    ->class('form-control')
                                                    ->placeholder('Export_row_1_pl')
                                                    ->value(@$LanguageContent->Export_row_1_pl)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->

                                        <!--col-->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{ html()->label('Export Row 1 Content de')->class('form-control-label')->for('Export_row_1_de') }}
                                                {{ html()->textarea('Export_row_1_de')
                                                    ->class('form-control')
                                                    ->placeholder('Export_row_1_de')
                                                    ->value(@$LanguageContent->Export_row_1_de)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->

                                        <!--col-->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{ html()->label('Export Row 2 Content en')->class('form-control-label')->for('Export_row_2_en') }}
                                                {{ html()->textarea('Export_row_2_en')
                                                    ->class('form-control')
                                                    ->placeholder('Export_row_2_en')
                                                    ->value(@$LanguageContent->Export_row_2_en)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->

                                        <!--col-->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{ html()->label('Export Row 2 Content pl')->class('form-control-label')->for('Export_row_2_pl') }}
                                                {{ html()->textarea('Export_row_2_pl')
                                                    ->class('form-control')
                                                    ->placeholder('Export_row_2_pl')
                                                    ->value(@$LanguageContent->Export_row_2_pl)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->

                                        <!--col-->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{ html()->label('Export Row 2 Content de')->class('form-control-label')->for('Export_row_2_de') }}
                                                {{ html()->textarea('Export_row_2_de')
                                                    ->class('form-control')
                                                    ->placeholder('Export_row_2_de')
                                                    ->value(@$LanguageContent->Export_row_2_de)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->

                                        <!--col-->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{ html()->label('Export Row 3 Content en')->class('-control-label')->for('Export_row_3_en') }}
                                                {{ html()->textarea('Export_row_3_en')
                                                    ->class('form-control')
                                                    ->placeholder('Export_row_3_en')
                                                    ->value(@$LanguageContent->Export_row_3_en)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->

                                        <!--col-->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{ html()->label('Export Row 3 Content pl')->class('form-control-label')->for('Export_row_3_pl') }}
                                                {{ html()->textarea('Export_row_3_pl')
                                                    ->class('form-control')
                                                    ->placeholder('Export_row_3_pl')
                                                    ->value(@$LanguageContent->Export_row_3_pl)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->

                                        <!--col-->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{ html()->label('Export Row 3 Content de')->class('form-control-label')->for('Export_row_3_de') }}
                                                {{ html()->textarea('Export_row_3_de')
                                                    ->class('form-control')
                                                    ->placeholder('Export_row_3_de')
                                                    ->value(@$LanguageContent->Export_row_3_de)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->
                                        <!-- end export -->
                                    </div>
                                </div>
                                <div id="vk4" class="tab-pane product-group">
                                    <div class="row">
                                        <!-- newletter start -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ html()->label('NewSletter en')->class('form-control-label')->for('newsletter_en') }}
                                                {{ html()->text('newsletter_en')
                                                    ->class('form-control')
                                                    ->placeholder('newsletter_en')
                                                    ->value(@$LanguageContent->newsletter_en)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ html()->label('NewSletter pl')->class('form-control-label')->for('newsletter_pl') }}
                                                {{ html()->text('newsletter_pl')
                                                    ->class('form-control')
                                                    ->placeholder('newsletter_pl')
                                                    ->value(@$LanguageContent->newsletter_pl)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ html()->label('NewSletter de')->class('form-control-label')->for('newsletter_de') }}
                                                {{ html()->text('newsletter_de')
                                                ->class('form-control')
                                                ->placeholder('newsletter_de')
                                                ->value(@$LanguageContent->newsletter_de)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->
                                        
                                        <!--col-->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{ html()->label('NewSletter Content en')->class('form-control-label')->for('newsletter_content_en') }}
                                                {{ html()->textarea('newsletter_content_en')
                                                    ->class('form-control')
                                                    ->placeholder('newsletter_content_en')
                                                    ->value(@$LanguageContent->newsletter_content_en)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->

                                        <!--col-->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{ html()->label('NewSletter Content pl')->class('form-control-label')->for('newsletter_content_pl') }}
                                                {{ html()->textarea('newsletter_content_pl')
                                                    ->class('form-control')
                                                    ->placeholder('newsletter_content_pl')
                                                    ->value(@$LanguageContent->newsletter_content_pl)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->

                                        <!--col-->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{ html()->label('NewSletter Content de')->class('form-control-label')->for('newsletter_content_de') }}
                                                {{ html()->textarea('newsletter_content_de')
                                                    ->class('form-control')
                                                    ->placeholder('newsletter_content_de')
                                                    ->value(@$LanguageContent->newsletter_content_de)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->

                                        <!--col-->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ html()->label('NewSletter Email en')->class('form-control-label')->for('newsletter_email_en') }}
                                                {{ html()->text('newsletter_email_en')
                                                    ->class('form-control')
                                                    ->placeholder('newsletter_email_en')
                                                    ->value(@$LanguageContent->newsletter_email_en)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ html()->label('NewSletter Email pl')->class('form-control-label')->for('newsletter_email_pl') }}
                                                {{ html()->text('newsletter_email_pl')
                                                    ->class('form-control')
                                                    ->placeholder('newsletter_email_pl')
                                                    ->value(@$LanguageContent->newsletter_email_pl)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ html()->label('NewSletter Email de')->class('form-control-label')->for('newsletter_email_de') }}
                                                {{ html()->text('newsletter_email_de')
                                                    ->class('form-control')
                                                    ->placeholder('newsletter_email_de')
                                                    ->value(@$LanguageContent->newsletter_email_de)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->

                                        <!--col-->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{ html()->label('Poffers en')->class('form-control-label')->for('poffers_en') }}
                                                {{ html()->textarea('poffers_en')
                                                    ->class('form-control')
                                                    ->placeholder('poffers_en')
                                                    ->value(@$LanguageContent->poffers_en)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->

                                        <!--col-->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{ html()->label('Poffers pl')->class('form-control-label')->for('poffers_pl') }}
                                                {{ html()->textarea('poffers_pl')
                                                    ->class('form-control')
                                                    ->placeholder('poffers_pl')
                                                    ->value(@$LanguageContent->poffers_pl)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->

                                        <!--col-->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{ html()->label('Poffers de')->class('form-control-label')->for('poffers_de') }}
                                                {{ html()->textarea('poffers_de')
                                                    ->class('form-control')
                                                    ->placeholder('poffers_de')
                                                    ->value(@$LanguageContent->poffers_de)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->

                                        <!--col-->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{ html()->label('Beets en')->class('form-control-label')->for('beets_en') }}
                                                {{ html()->textarea('beets_en')
                                                    ->class('form-control')
                                                    ->placeholder('beets_en')
                                                    ->value(@$LanguageContent->beets_en)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->

                                        <!--col-->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{ html()->label('Beets pl')->class('form-control-label')->for('beets_pl') }}
                                                {{ html()->textarea('beets_pl')
                                                    ->class('form-control')
                                                    ->placeholder('beets_pl')
                                                    ->value(@$LanguageContent->beets_pl)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->

                                        <!--col-->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{ html()->label('Beets de')->class('form-control-label')->for('beets_de') }}
                                                {{ html()->textarea('beets_de')
                                                    ->class('form-control')
                                                    ->placeholder('beets_de')
                                                    ->value(@$LanguageContent->beets_de)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->

                                        <!--col-->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{ html()->label('Beets Content en')->class('form-control-label')->for('beets_content_en') }}
                                                {{ html()->textarea('beets_content_en')
                                                    ->class('form-control')
                                                    ->placeholder('beets_content_en')
                                                    ->value(@$LanguageContent->beets_content_en)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->
                                        
                                        <!--col-->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{ html()->label('Beets Content pl')->class('form-control-label')->for('beets_content_pl') }}
                                                {{ html()->textarea('beets_content_pl')
                                                    ->class('form-control')
                                                    ->placeholder('beets_content_pl')
                                                    ->value(@$LanguageContent->beets_content_pl)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->

                                        <!--col-->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{ html()->label('Beets Content de')->class('form-control-label')->for('beets_content_de') }}
                                                {{ html()->textarea('beets_content_de')
                                                    ->class('form-control')
                                                    ->placeholder('beets_content_de')
                                                    ->value(@$LanguageContent->beets_content_de)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->

                                        <!--col-->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ html()->label('See Offer en')->class('form-control-label')->for('see_offer_en') }}
                                                {{ html()->text('see_offer_en')
                                                    ->class('form-control')
                                                    ->placeholder('see_offer_en')
                                                    ->value(@$LanguageContent->see_offer_en)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ html()->label('See Offer pl')->class('form-control-label')->for('see_offer_pl') }}
                                                {{ html()->text('see_offer_pl')
                                                    ->class('form-control')
                                                    ->placeholder('see_offer_pl')
                                                    ->value(@$LanguageContent->see_offer_pl)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ html()->label('See Offer de')->class('form-control-label')->for('see_offer_de') }}
                                                {{ html()->text('see_offer_de')
                                                    ->class('form-control')
                                                    ->placeholder('see_offer_de')
                                                    ->value(@$LanguageContent->see_offer_de)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->
                                    </div>
                                </div>
                                <div id="vk5" class="tab-pane product-group">
                                    <!-- sales department start -->
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ html()->label('Sales Tittle en')->class('form-control-label')->for('sale_tittle_en') }}
                                                {{ html()->text('sale_tittle_en')
                                                    ->class('form-control')
                                                    ->placeholder('sale_tittle_en')
                                                    ->value(@$LanguageContent->sale_tittle_en)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ html()->label('Sales Tittle pl')->class('form-control-label')->for('sale_tittle_pl') }}
                                                {{ html()->text('sale_tittle_pl')
                                                    ->class('form-control')
                                                    ->placeholder('sale_tittle_pl')
                                                    ->value(@$LanguageContent->sale_tittle_pl)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ html()->label('Sales Tittle de')->class('form-control-label')->for('sale_tittle_de') }}
                                                {{ html()->text('sale_tittle_de')
                                                    ->class('form-control')
                                                    ->placeholder('sale_tittle_de')
                                                    ->value(@$LanguageContent->sale_tittle_de)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ html()->label('Sale Email en')->class('form-control-label')->for('sale_email_en') }}
                                                {{ html()->text('sale_email_en')
                                                    ->class('form-control')
                                                    ->placeholder('sale_email_en')
                                                    ->value(@$LanguageContent->sale_email_en)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ html()->label('Sale Email pl')->class('form-control-label')->for('sale_email_pl') }}
                                                {{ html()->text('sale_email_pl')
                                                    ->class('form-control')
                                                    ->placeholder('sale_email_pl')
                                                    ->value(@$LanguageContent->sale_email_pl)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ html()->label('Sales Email de')->class('form-control-label')->for('sale_email_de') }}
                                                {{ html()->text('sale_email_de')
                                                    ->class('form-control')
                                                    ->placeholder('sale_email_de')
                                                    ->value(@$LanguageContent->sale_email_de)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->
                                    </div>
                                    <!-- sales department end -->
                                </div>
                                <div id="vk6" class="tab-pane product-group">
                                    <div class="row">
                                        <!-- contact us start -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ html()->label('Contact en')->class('form-control-label')->for('contact_en') }}
                                                {{ html()->text('contact_en')
                                                    ->class('form-control')
                                                    ->placeholder('contact_en')
                                                    ->value(@$LanguageContent->contact_en)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ html()->label('Contact pl')->class('form-control-label')->for('contact_pl') }}
                                                {{ html()->text('contact_pl')
                                                    ->class('form-control')
                                                    ->placeholder('contact_pl')
                                                    ->value(@$LanguageContent->contact_pl)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ html()->label('contact de')->class('form-control-label')->for('contact_de') }}
                                                {{ html()->text('contact_de')
                                                    ->class('form-control')
                                                    ->placeholder('contact_de')
                                                    ->value(@$LanguageContent->contact_de)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ html()->label('Contact Heading en')->class('form-control-label')->for('contact_heading_en') }}
                                                {{ html()->text('contact_heading_en')
                                                    ->class('form-control')
                                                    ->placeholder('contact_heading_en')
                                                    ->value(@$LanguageContent->contact_heading_en)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ html()->label('Contact Heading pl')->class('form-control-label')->for('contact_heading_pl') }}
                                                {{ html()->text('contact_heading_pl')
                                                    ->class('form-control')
                                                    ->placeholder('contact_heading_pl')
                                                    ->value(@$LanguageContent->contact_heading_pl)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ html()->label('Contact Heading de')->class('form-control-label')->for('contact_heading_de') }}
                                                {{ html()->text('contact_heading_de')
                                                    ->class('form-control')
                                                    ->placeholder('contact_heading_de')
                                                    ->value(@$LanguageContent->contact_heading_de)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->

                                        <!--col-->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{ html()->label('Contact Content en')->class('form-control-label')->for('contact_content_en') }}
                                                {{ html()->textarea('contact_content_en')
                                                    ->class('form-control')
                                                    ->placeholder('contact_content_en')
                                                    ->value(@$LanguageContent->contact_content_en)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->

                                        <!--col-->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{ html()->label('Contact Content pl')->class('form-control-label')->for('contact_content_pl') }}
                                                {{ html()->textarea('contact_content_pl')
                                                    ->class('form-control')
                                                    ->placeholder('contact_content_pl')
                                                    ->value(@$LanguageContent->contact_content_pl)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->

                                        <!--col-->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{ html()->label('Contact Content de')->class('form-control-label')->for('contact_content_de') }}
                                                {{ html()->textarea('contact_content_de')
                                                    ->class('form-control')
                                                    ->placeholder('contact_content_de')
                                                    ->value(@$LanguageContent->contact_content_de)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->
                                        <!-- contact us end -->
                                    </div>
                                </div>
                                <div id="vk7" class="tab-pane product-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ html()->label('About Property en')->class('form-control-label')->for('about_property_en') }}
                                                {{ html()->text('about_property_en')
                                                    ->class('form-control')
                                                    ->placeholder('about_property_en')
                                                    ->value(@$LanguageContent->about_property_en)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ html()->label('About Property pl')->class('form-control-label')->for('about_property_pl') }}
                                                {{ html()->text('about_property_pl')
                                                    ->class('form-control')
                                                    ->placeholder('about_property_pl')
                                                    ->value(@$LanguageContent->about_property_pl)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ html()->label('About Property de')->class('form-control-label')->for('about_property_de') }}
                                                {{ html()->text('about_property_de')
                                                    ->class('form-control')
                                                    ->placeholder('about_property_de')
                                                    ->value(@$LanguageContent->about_property_de)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ html()->label('AboutUs Footer en')->class('form-control-label')->for('about_us_footer_en') }}
                                                {{ html()->text('about_us_footer_en')
                                                    ->class('form-control')
                                                    ->placeholder('about_us_footer_en')
                                                    ->value(@$LanguageContent->about_us_footer_en)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ html()->label('AboutUs Footer pl')->class('form-control-label')->for('about_us_footer_pl') }}
                                                {{ html()->text('about_us_footer_pl')
                                                    ->class('form-control')
                                                    ->placeholder('about_us_footer_pl')
                                                    ->value(@$LanguageContent->about_us_footer_pl)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ html()->label('AboutUs Footer de')->class('form-control-label')->for('about_us_footer_de') }}
                                                {{ html()->text('about_us_footer_de')
                                                    ->class('form-control')
                                                    ->placeholder('about_us_footer_de')
                                                    ->value(@$LanguageContent->about_us_footer_de)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ html()->label('Privacy Policy en')->class('form-control-label')->for('privacy_policy_en') }}
                                                {{ html()->text('privacy_policy_en')
                                                    ->class('form-control')
                                                    ->placeholder('privacy_policy_en')
                                                    ->value(@$LanguageContent->privacy_policy_en)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ html()->label('Privacy Policy pl')->class('form-control-label')->for('privacy_policy_pl') }}
                                                {{ html()->text('privacy_policy_pl')
                                                    ->class('form-control')
                                                    ->placeholder('privacy_policy_pl')
                                                    ->value(@$LanguageContent->privacy_policy_pl)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ html()->label('Privacy Policy de')->class('form-control-label')->for('privacy_policy_de') }}
                                                {{ html()->text('privacy_policy_de')
                                                    ->class('form-control')
                                                    ->placeholder('privacy_policy_de')
                                                    ->value(@$LanguageContent->privacy_policy_de)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ html()->label('Contact Info en')->class('form-control-label')->for('contact_info_en') }}
                                                {{ html()->text('contact_info_en')
                                                    ->class('form-control')
                                                    ->placeholder('contact_info_en')
                                                    ->value(@$LanguageContent->contact_info_en)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ html()->label('Contact Info pl')->class('form-control-label')->for('contact_info_pl') }}
                                                {{ html()->text('contact_info_pl')
                                                    ->class('form-control')
                                                    ->placeholder('contact_info_pl')
                                                    ->value(@$LanguageContent->contact_info_pl)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ html()->label('Contact Info de')->class('form-control-label')->for('contact_info_de') }}
                                                {{ html()->text('contact_info_de')
                                                    ->class('form-control')
                                                    ->placeholder('contact_info_de')
                                                    ->value(@$LanguageContent->contact_info_de)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ html()->label('Terms en')->class('form-control-label')->for('terms_en') }}
                                                {{ html()->text('terms_en')
                                                    ->class('form-control')
                                                    ->placeholder('terms_en')
                                                    ->value(@$LanguageContent->terms_en)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ html()->label('Terms pl')->class('form-control-label')->for('terms_pl') }}
                                                {{ html()->text('terms_pl')
                                                    ->class('form-control')
                                                    ->placeholder('terms_pl')
                                                    ->value(@$LanguageContent->terms_pl)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ html()->label('Terms de')->class('form-control-label')->for('terms_de') }}
                                                {{ html()->text('terms_de')
                                                    ->class('form-control')
                                                    ->placeholder('terms_de')
                                                    ->value(@$LanguageContent->terms_de)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ html()->label('Contact Footer en')->class('form-control-label')->for('contact_footer_en') }}
                                                {{ html()->text('contact_footer_en')
                                                    ->class('form-control')
                                                    ->placeholder('contact_footer_en')
                                                    ->value(@$LanguageContent->contact_footer_en)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ html()->label('Contact Footer pl')->class('form-control-label')->for('contact_footer_pl') }}
                                                {{ html()->text('contact_footer_pl')
                                                    ->class('form-control')
                                                    ->placeholder('contact_footer_pl')
                                                    ->value(@$LanguageContent->contact_footer_pl)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ html()->label('Contact Footer de')->class('form-control-label')->for('contact_footer_de') }}
                                                {{ html()->text('contact_footer_de')
                                                    ->class('form-control')
                                                    ->placeholder('contact_footer_de')
                                                    ->value(@$LanguageContent->contact_footer_de)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->
                                    </div>
                                                
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ html()->label('Copyright en')->class('form-control-label')->for('copyright_en') }}
                                                {{ html()->text('copyright_en')
                                                    ->class('form-control')
                                                    ->placeholder('copyright_en')
                                                    ->value(@$LanguageContent->copyright_en)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ html()->label('Copyright pl')->class('form-control-label')->for('copyright_pl') }}
                                                {{ html()->text('copyright_pl')
                                                    ->class('form-control')
                                                    ->placeholder('copyright_pl')
                                                    ->value(@$LanguageContent->copyright_pl)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ html()->label('Copyright de')->class('form-control-label')->for('copyright_de') }}
                                                {{ html()->text('copyright_de')
                                                    ->class('form-control')
                                                    ->placeholder('copyright_de')
                                                    ->value(@$LanguageContent->copyright_de)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->
                                    </div>
                                        
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ html()->label('Copyright Content en')->class('form-control-label')->for('copyright_content_en') }}
                                                {{ html()->text('copyright_content_en')
                                                ->class('form-control')
                                                ->placeholder('copyright_content_en')
                                                ->value(@$LanguageContent->copyright_content_en)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ html()->label('Copyright Content pl')->class('form-control-label')->for('copyright_content_pl') }}
                                                {{ html()->text('copyright_content_pl')
                                                ->class('form-control')
                                                ->placeholder('copyright_content_pl')
                                                ->value(@$LanguageContent->copyright_content_pl)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ html()->label('Copyright Content de')->class('form-control-label')->for('copyright_content_de') }}
                                                {{ html()->text('copyright_content_de')
                                                ->class('form-control')
                                                ->placeholder('copyright_content_de')
                                                ->value(@$LanguageContent->copyright_content_de)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->
                                    </div>
                                    
                                    <div class="row">
                                        <!--col-->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{ html()->label('Full Address en')->class('form-control-label')->for('fulladdress_en') }}
                                                {{ html()->textarea('fulladdress_en')
                                                    ->class('form-control')
                                                    ->placeholder('fulladdress_en')
                                                    ->value(@$LanguageContent->fulladdress_en)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>

                                        <!--col-->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{ html()->label('Full Address pl')->class('form-control-label')->for('fulladdress_pl') }}
                                                {{ html()->textarea('fulladdress_pl')
                                                    ->class('form-control')
                                                    ->placeholder('fulladdress_pl')
                                                    ->value(@$LanguageContent->fulladdress_pl)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>

                                        <!--col-->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{ html()->label('Full Address de')->class('form-control-label')->for('fulladdress_de') }}
                                                {{ html()->textarea('fulladdress_de')
                                                    ->class('form-control')
                                                    ->placeholder('fulladdress_de')
                                                    ->value(@$LanguageContent->fulladdress_de)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        
                                        <!--col-->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{ html()->label('Footer About en')->class('form-control-label')->for('footer_about_en') }}
                                                {{ html()->textarea('footer_about_en')
                                                    ->class('form-control')
                                                    ->placeholder('footer_about_en')
                                                    ->value(@$LanguageContent->footer_about_en)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>

                                        <!--col-->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{ html()->label('Footer About pl')->class('form-control-label')->for('footer_about_pl') }}
                                                {{ html()->textarea('footer_about_pl')
                                                    ->class('form-control')
                                                    ->placeholder('footer_about_pl')
                                                    ->value(@$LanguageContent->footer_about_pl)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>

                                        <!--col-->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{ html()->label('Footer About de')->class('form-control-label')->for('footer_about_de') }}
                                                {{ html()->textarea('footer_about_de')
                                                    ->class('form-control')
                                                    ->placeholder('footer_about_de')
                                                    ->value(@$LanguageContent->footer_about_de)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="vk8" class="tab-pane product-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ html()->label('Site Name en')->class('form-control-label')->for('site_name_en') }}
                                                {{ html()->text('site_name_en')
                                                    ->class('form-control')
                                                    ->placeholder('site_name_en')
                                                    ->value(@$LanguageContent->site_name_en)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ html()->label('Site Name pl')->class('form-control-label')->for('site_name_pl') }}
                                                {{ html()->text('site_name_pl')
                                                    ->class('form-control')
                                                    ->placeholder('site_name_pl')
                                                    ->value(@$LanguageContent->site_name_pl)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ html()->label('Site Name de')->class('form-control-label')->for('site_name_de') }}
                                                {{ html()->text('site_name_de')
                                                    ->class('form-control')
                                                    ->placeholder('site_name_de')
                                                    ->value(@$LanguageContent->site_name_de)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->
                                    </div>
                                    <div class="row">
                                        <!--form-group-->
                                        <div class="col-md-4">
                                            <div class="form-group ">
                                                {{ html()->label('Offer en')->class('form-control-label')->for('offer_en') }}
                                                {{ html()->text('offer_en')
                                                    ->class('form-control')
                                                    ->placeholder('offer_en')
                                                    ->value(@$LanguageContent->offer_en)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <!--col-->
                                        </div>
                                        <!--form-group-->

                                        <!--form-group-->
                                        <div class="col-md-4">
                                            <div class="form-group ">
                                                {{ html()->label('Offer pl')->class('form-control-label')->for('offer_pl') }}
                                                {{ html()->text('offer_pl')
                                                    ->class('form-control')
                                                    ->placeholder('offer_pl')
                                                    ->value(@$LanguageContent->offer_pl)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <!--col-->
                                        </div>
                                        <!--form-group-->

                                        <!--form-group-->
                                        <div class="col-md-4">
                                            <div class="form-group ">
                                                {{ html()->label('Offer de')->class('form-control-label')->for('offer_de') }}
                                                {{ html()->text('offer_de')
                                                    ->class('form-control')
                                                    ->placeholder('offer_de')
                                                    ->value(@$LanguageContent->offer_de)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <!--col-->
                                        </div>
                                        <!--form-group-->
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ html()->label('AgreeButton en')->class('form-control-label')->for('agreebutton_en') }}
                                                {{ html()->text('agreebutton_en')
                                            ->class('form-control')
                                            ->placeholder('agreebutton_en')
                                            ->value(@$LanguageContent->agreebutton_en)
                                            }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ html()->label('AgreeButton pl')->class('form-control-label')->for('agreebutton_pl') }}
                                                {{ html()->text('agreebutton_pl')
                                                    ->class('form-control')
                                                    ->placeholder('agreebutton_pl')
                                                    ->value(@$LanguageContent->agreebutton_pl)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ html()->label('AgreeButton de')->class('form-control-label')->for('agreebutton_de') }}
                                                {{ html()->text('agreebutton_de')
                                                    ->class('form-control')
                                                    ->placeholder('agreebutton_de')
                                                    ->value(@$LanguageContent->agreebutton_de)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <!--col-->
                                    </div>
                                    <!--form-group-->

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{ html()->label('Heading en')->class('form-control-label')->for('heading_en') }}
                                                {{ html()->textarea('heading_en')
                                                    ->class('form-control')
                                                    ->placeholder('heading_en')
                                                    ->value(@$LanguageContent->heading_en)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <!--col-->
                                        </div>
                                        <!--form-group-->

                                        <!--form-group-->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{ html()->label('Heading pl')->class('form-control-label')->for('heading_pl') }}
                                                {{ html()->textarea('heading_pl')
                                                    ->class('form-control')
                                                    ->placeholder('heading_pl')
                                                    ->value(@$LanguageContent->heading_pl)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <!--col-->
                                        </div>
                                        <!--form-group-->

                                        <!--form-group-->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{ html()->label('Heading de')->class('form-control-label')->for('heading_de') }}
                                                {{ html()->textarea('heading_de')
                                                    ->class('form-control')
                                                    ->placeholder('heading_de')
                                                    ->value(@$LanguageContent->heading_de)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <!--col-->
                                        </div>
                                        <!--form-group-->

                                        <!--form-group-->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{ html()->label('Content en')->class('form-control-label')->for('content_en') }}
                                                {{ html()->textarea('content_en')
                                                    ->class('form-control')
                                                    ->placeholder('content_en')
                                                    ->value(@$LanguageContent->content_en)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <!--col-->
                                        </div>
                                        <!--form-group-->

                                        <!--form-group-->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{ html()->label('Content pl')->class('form-control-label')->for('content_pl') }}
                                                {{ html()->textarea('content_pl')
                                                    ->class('form-control')
                                                    ->placeholder('content_pl')
                                                    ->value(@$LanguageContent->content_pl)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <!--col-->
                                        </div>
                                        <!--form-group-->

                                        <!--form-group-->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{ html()->label('Content de')->class('form-control-label')->for('content_de') }}
                                                {{ html()->textarea('content_de')
                                                    ->class('form-control')
                                                    ->placeholder('content_de')
                                                    ->value(@$LanguageContent->content_de)
                                                }}
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <!--col-->
                                        </div>
                                        <!--form-group-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>         
            </div>
        </div>
    </div>
    <!--col-->
    <!--card-body-->
    <div class="card-footer clearfix">
        <div class="row">
            <div class="col text-right">
                {{ form_submit(__('buttons.general.crud.update')) }}
            </div>
            <!--col-->
        </div>
        <!--row-->
    </div>
    <!--card-footer-->
</div>
<!--card-->

{{ html()->form()->close() }}
@endsection

@push('after-scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#form_role_submit3').on('submit', function(event) {
            event.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: "{{ route('admin.languagecontent.update', 1) }}",
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
                    if (data.status == 'success') {
                        $('.loading').addClass('loading_hide');
                        Swal.fire('Sent!', data.message, 'success');
                        setTimeout(function() {
                            window.location.href = "{{ route('admin.languagecontent.index') }}";
                        }, 2000);
                    }
                    if (data.status == 'error') {
                        $('.loading').addClass('loading_hide');
                        Swal.fire('Error!', data.message, 'error');
                        $('.btn-success').removeAttr('disabled');
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
    });
</script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.0.9/tinymce.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.0.9/jquery.tinymce.min.js"></script>
<script>
    var editor_config = {
        path_absolute: "",
        selector: "#section_1_en,#section_1_pl,#section_1_de,#import_col_1_en,#import_col_1_pl,#import_col_1_de,#import_col_2_en,#import_col_2_pl,#import_col_2_de,#import_col_3_en,#import_col_3_pl,#import_col_3_de,#Export_row_1_en,#Export_row_1_pl,#Export_row_1_de,#Export_row_2_en,#Export_row_2_pl,#Export_row_2_de,#Export_row_3_en,#Export_row_3_pl,#Export_row_3_de,#heading_en,#heading_pl,#heading_de,#content_en,#content_pl,#content_de,#read_more_content_en,#read_more_content_pl,#read_more_content_de,#heading_col_1_en,#heading_col_1_pl,#heading_col_1_de,#heading_col_2_en,#heading_col_2_pl,#heading_col_2_de,#heading_col_3_en,#heading_col_3_pl,#heading_col_3_de,#heading_row_1_en,#heading_row_1_pl,#heading_row_1_de,#heading_row_2_en,#heading_row_2_pl,#heading_row_2_de,#heading_row_3_en,#heading_row_3_pl,#heading_row_3_de,#newsletter_content_en,#beets_en,#beets_content_en,#newsletter_content_pl,#poffers_en,#poffers_pl,#beets_pl,#beets_content_pl,#newsletter_content_de,#poffers_de,#beets_de,#beets_content_de,#contact_content_en,#contact_content_pl,#contact_content_de,#fulladdress_en,#fulladdress_pl,#fulladdress_de,#footer_about_en,#footer_about_pl,#footer_about_de",
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
        height: 400,
        file_browser_callback: function(field_name, url, type, win) {
            var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
            var y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;

            var cmsURL = editor_config.path_absolute + route_prefix + '?field_name=' + field_name;
            if (type == 'image') {
                cmsURL = cmsURL + "&type=Images";
            } else {
                cmsURL = cmsURL + "&type=Files";
            }

            tinyMCE.activeEditor.windowManager.open({
                file: cmsURL,
                title: 'Filemanager',
                width: x * 0.8,
                height: y * 0.8,
                resizable: "yes",
                close_previous: "no"
            });
        }
    };

    tinymce.init(editor_config);
</script>

@endpush