@extends('layouts.master')
@section('styles')
<link href="{{ mix('/css/app.css') }}" rel="stylesheet">
@endsection
@section('content') 
            <div class="main-contant">
               
                <div class="section">
                    <div class="container">
                        <div class="row">
                            <div >
                                <div class="tour-detail-section">
                                    <!-- TOUR TEXT DETAIL HOLDER -->
                                    <div class="text">
                                        <!-- Tab Wrap Start -->
                                        <div class="tours-tabs">
                                            <!-- Nav tabs -->
                                            <ul class="nav nav-tabs theme-tab th-bg" role="tablist">
                                                <li role="presentation" class="active"><a href="#detail" aria-controls="detail" role="tab" data-toggle="tab">Detail</a></li>
                                                @if(!is_null($article))
                                                <li role="presentation"><a href="#photos" aria-controls="photos" role="tab" data-toggle="tab">Photos</a></li>
                                                <div id="deleteAsset" type="article" asset_id="{{$article->id}}">
                                                    <li role="presentation"><a aria-controls="photos" role="tab" @click="prepareToDelete()" data-toggle="tab">Delete</a></li>
                                                    @include('traveller._delete_confirm');
                                                </div>
                                                @endif
                                            </ul>
                                            <!-- Tab panes -->
                                            <div class="tab-content">
                                                <div role="tabpanel" class="tab-pane active" id="detail">
                                                    <div class="theme-tab-content">
                                                        <div class="map"></div>
                                                        <h4 class="section-title font-26">Tour Details </h4>
                                                        <p id="idshow"></p>
                                                        <!-- List Row Start -->
                                                        <div class="form-group">
                                                            <div class="content">
                                                                <form action="{{ ($article==null)? route('store-article') : route('update-article',$article->id) }}" 
                                                                method="post">
                                                                    {{ csrf_field() }}
                                                                    <div class="trip-edit-form">
                                                                    <div class="row">
                                                                        <div class="col-md-5">
                                                                            <div class="form-group">
                                                                                <label>Category</label>
                                                                                <select class="form-controll" id="sel1" name="category_id" >
                                                                                    @foreach($categories as $category)
                                                                                    <option value="{{$category->id}}"
                                                                                            @if ($article!=null && $category->id ==$article->category_id)
                                                                                                selected="selected"
                                                                                            @endif
                                                                                        >{{$category->name}}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-5">
                                                                            <div class="form-group">
                                                                                <label>Language</label>
                                                                                <select class="form-controll" id="lan" name="language">   
                                                                                    <option>eng</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-5">
                                                                            <div class="form-group">
                                                                                <label>Keywords:</label>
                                                                                <input type="text" id="tokenfield" class="form-controll" name="keywords" placeholder="Keywords" value="{{($article!=null)?old('keywords',$article->keywords) :old('keywords')}}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-5">
                                                                            <div class="form-group">
                                                                                <label>Comment Enable</label>
                                                                                <select class="form-controll" id="cmnt" name="is_comment_enabled">   
                                                                                    <option value="1">Yes</option>
                                                                                    <option value="0">No</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>               
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label>Heading</label>
                                                                                <input type="text" class="form-controll" placeholder="Heading" name="heading"
                                                                                 value="{{ ($article!=null)?$article->heading : ''}}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label>Publish</label>
                                                                                <select class="form-controll" id="cmnt" name="is_published">   
                                                                                    <option value="1"
                                                                                        @if($article==null || $article->is_published==1)
                                                                                        selected="selected"
                                                                                        @endif 
                                                                                    >Publish</option>
                                                                                    <option value="0"
                                                                                        @if($article!=null && $article->is_published==0)
                                                                                        selected="selected"
                                                                                        @endif 
                                                                                    >Un Publish</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>    
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <h1><label>Content</label></h1>
                                                                                <textarea rows="100" id="article-ckeditor" class="form-control" placeholder="Here can be your description" name="content">
                                                                                    {!! ($article!=null)?$article->content : '' !!}
                                                                                    
                                                                                </textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <button type="submit" class="btn btn-info btn-fill pull-right">
                                                                    @if($article==null)
                                                                    Create
                                                                    @else
                                                                    Update
                                                                    @endif
                                                                    </button>
                                                                    <div class="clearfix"></div>
                                                                </form>
                                                            </div>
                                                        </div>

                                                </div>
                                            </div>
                                            @if($article!=null)
                                            <div role="tabpanel" class="tab-pane" id="photos">
                                                <div class="theme-tab-content">
                                                        @include('traveller._article_images', ['article' => $article, 'edit' => true])

                                                </div>
                                            </div>
                                            @endif
                                            </div>
                                        </div>
                                        <!-- Tab Wrap End -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- / Container -->
                </div><!-- /Blog Grid Section -->
          </div>
        </div>
            </div><!-- /Main Contant End -->


@endsection
@section('scripts')
<script src="{{ mix('js/user_profile.js') }}" type="application/javascript"></script>

        <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script>
         CKEDITOR.replace( 'article-ckeditor');
//         CKEDITOR.replace( 'article-ckeditor'); ,{
//                 toolbar: [
//     { name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source', '-', 'Save', 'NewPage', 'Preview', 'Print', '-', 'Templates' ] },
//     { name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
//     { name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ], items: [ 'Find', 'Replace', '-', 'SelectAll', '-', 'Scayt' ] },
//     { name: 'forms', items: [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField' ] },
//     '/',
//     { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
//     { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language' ] },
//     { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
//     { name: 'insert', items: [ 'Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe' ] },
//     '/',
//     { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
//     { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
//     { name: 'tools', items: [ 'Maximize', 'ShowBlocks' ] },
//     { name: 'others', items: [ '-' ] },
//     { name: 'about', items: [ 'About' ] }
// ]
//         });
        </script>
@endsection