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
                                                <li role="presentation"><a href="#photos" aria-controls="photos" role="tab" data-toggle="tab">Photos</a></li>
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
                                                                                <input type="text" id="keyword" class="form-controll" name="keywords" placeholder="Keywords" value="">
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
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label>Heading</label>
                                                                                <input type="text" class="form-controll" placeholder="Heading" name="heading"
                                                                                 value="{{ ($article!=null)?$article->heading : ''}}">
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
    <script>
      // This example adds a search box to a map, using the Google Place Autocomplete
      // feature. People can enter geographical searches. The search box will return a
      // pick list containing a mix of places and predicted search terms.

      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

      
        $(document).ready(function(){
       var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 7.8688, lng: 151.2195},
          zoom: 13,
          mapTypeId: 'roadmap'
        });

        // Create the search box and link it to the UI element.
        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function() {
          searchBox.setBounds(map.getBounds());
        });

        var markers = [];
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function() {
          var places = searchBox.getPlaces();

          if (places.length == 0) {
            return;
          }

          // Clear out the old markers.
          markers.forEach(function(marker) {
            marker.setMap(null);
          });
          markers = [];

          // For each place, get the icon, name and location.
          var bounds = new google.maps.LatLngBounds();
          places.forEach(function(place) {
            if (!place.geometry) {
              console.log("Returned place contains no geometry");
              return;
            }
            var icon = {
              url: place.icon,
              size: new google.maps.Size(71, 71),
              origin: new google.maps.Point(0, 0),
              anchor: new google.maps.Point(17, 34),
              scaledSize: new google.maps.Size(25, 25)
            };

            // Create a marker for each place.
            markers.push(new google.maps.Marker({
              map: map,
              icon: icon,
              title: place.name,
              position: place.geometry.location
            }));

            if (place.geometry.viewport) {
              // Only geocodes have viewport.
              bounds.union(place.geometry.viewport);
            } else {
              bounds.extend(place.geometry.location);
            }
          });
          map.fitBounds(bounds);
        });           
    }); 

    </script>
 <script type='text/javascript'>

        $(document).ready(function(){
                var up_url= "{{route('upload_article_pic')}}";

            $('#upload').click(function(){
                console.log($('#pic')[0].files.length);
            });
            $("#delete_pic").click(function() {
                var action = $(this).val() == "people" ? "user" : "content";
                $("#del-user-id").attr("value", action);
            });
        });
        </script>
@endsection