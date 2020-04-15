@section('previewTemplate')
<div class="dz-preview dz-file-preview">
	<div class="dz-image">
		<img data-dz-thumbnail />
	</div>
	<div class="dz-details">
		<div class="dz-size">
			<span data-dz-size></span>
		</div>
		<div class="dz-filename">
			<span data-dz-name></span>
		</div>
	</div>
	<div class="dz-progress">
		<span class="dz-upload" data-dz-uploadprogress></span>
	</div>
	<div class="dz-error-message">
		<span data-dz-errormessage></span>
	</div>
	<div class="dz-success-mark">
		<svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
			<title>Check</title>
			<defs></defs>
			<g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
				<path d="M23.5,31.8431458 L17.5852419,25.9283877 C16.0248253,24.3679711 13.4910294,24.366835 11.9289322,25.9289322 C10.3700136,27.4878508 10.3665912,30.0234455 11.9283877,31.5852419 L20.4147581,40.0716123 C20.5133999,40.1702541 20.6159315,40.2626649 20.7218615,40.3488435 C22.2835669,41.8725651 24.794234,41.8626202 26.3461564,40.3106978 L43.3106978,23.3461564 C44.8771021,21.7797521 44.8758057,19.2483887 43.3137085,17.6862915 C41.7547899,16.1273729 39.2176035,16.1255422 37.6538436,17.6893022 L23.5,31.8431458 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z" id="Oval-2" stroke-opacity="0.198794158" stroke="#747474" fill-opacity="0.816519475" fill="#FFFFFF" sketch:type="MSShapeGroup"></path>
			</g>
		</svg>
	</div>
	<div class="dz-error-mark">
		<svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
			<title>Error</title>
			<defs></defs>
			<g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
				<g id="Check-+-Oval-2" sketch:type="MSLayerGroup" stroke="#747474" stroke-opacity="0.198794158" fill="#FFFFFF" fill-opacity="0.816519475">
					<path d="M32.6568542,29 L38.3106978,23.3461564 C39.8771021,21.7797521 39.8758057,19.2483887 38.3137085,17.6862915 C36.7547899,16.1273729 34.2176035,16.1255422 32.6538436,17.6893022 L27,23.3431458 L21.3461564,17.6893022 C19.7823965,16.1255422 17.2452101,16.1273729 15.6862915,17.6862915 C14.1241943,19.2483887 14.1228979,21.7797521 15.6893022,23.3461564 L21.3431458,29 L15.6893022,34.6538436 C14.1228979,36.2202479 14.1241943,38.7516113 15.6862915,40.3137085 C17.2452101,41.8726271 19.7823965,41.8744578 21.3461564,40.3106978 L27,34.6568542 L32.6538436,40.3106978 C34.2176035,41.8744578 36.7547899,41.8726271 38.3137085,40.3137085 C39.8758057,38.7516113 39.8771021,36.2202479 38.3106978,34.6538436 L32.6568542,29 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z" id="Oval-2" sketch:type="MSShapeGroup"></path>
				</g>
			</g>
		</svg>
	</div>
</div>
@endsection

<div class="form-group col-md-12">
	<strong>{{ $field['label'] }}</strong> <br>
	<div id="dropzone_{{ $field['name'] }}" class="dropzone dz-clickable sortable">
	    <div class="dz-message">
	    	Drop files here or click to upload.
	    </div>
	</div>
</div>

{{-- ########################################## --}}
{{-- Extra CSS and JS for this particular field --}}
{{-- If a field type is shown multiple times on a form, the CSS and JS will only be loaded once --}}
@if ($crud->checkIfFieldIsFirstOfItsType($field, $fields))
    {{-- FIELD CSS - will be loaded in the after_styles section --}}
    @push('crud_fields_styles')
        <!-- include dropzone css-->
        <link rel="stylesheet" href="{{ asset('vendor/gaspertrix/laravel-backpack-dropzone-field/dropzone/dropzone.min.css') }}" />
    @endpush

    {{-- FIELD JS - will be loaded in the after_scripts section --}}
    @push('crud_fields_scripts')
        <!-- include dropzone js-->
        <script src="{{ asset('vendor/gaspertrix/laravel-backpack-dropzone-field/dropzone/dropzone.min.js') }}"></script>
        <script src="{{ asset('vendor/gaspertrix/laravel-backpack-dropzone-field/sortable/Sortable.min.js') }}"></script>
    @endpush

@endif

@push('crud_fields_scripts')
	<script type="text/javascript">
		Dropzone.autoDiscover = false;
		jQuery(document).ready(function() {
			var dOptions = {
				url: "{{ url($crud->route . '/' . $entry->id . '/media') }}",
				previewTemplate: '{!! str_replace(array("\r\n", "\r", "\n"), "", addslashes(View::getSection("previewTemplate"))); !!}',
				init: function() {
					var files = [];

					@foreach ($entry->getMedia($field['collection']) as $media)
					files.push({id: {{ $media->id }}, order_column: {{ $media->order_column }}, size: "{{ $media->size }}", name: "{{ $media->file_name }}", full_url: "{{ $media->getUrl() }}", thumb_url: "{{ $media->getUrl($field['thumb_collection'] ?? '') }}"});
					@endforeach

					for (var i = 0; i < files.length; i++) {
						var file = files[i];

						this.emit('addedfile', file);

						if (typeof file.full_url != 'undefined') {
							this.emit('thumbnail', file, file.full_url);
						}

						this.emit('success', file, {success:true, media: file});
						this.emit('complete', file);
					}

					if (this.options.maxFiles !== null) {
						this.options.maxFiles = this.options.maxFiles - files.length;
					}
				},
				sending: function(file, xhr, formData) {
			        formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

			        @if (isset($field['collection']) AND !empty($field['collection']))
			        formData.append('collection', "{{ $field['collection'] }}");
			        @endif
			    },
			    success: function(file, response) {
			    	if (typeof response != 'undefined' && response.success == true) {
						file.media = response.media;
						file.previewElement.setAttribute('data-id', response.media.id);
						file.previewElement.setAttribute('data-position', response.media.order_column);
					}

					if (file.previewElement) {
						return file.previewElement.classList.add("dz-success");
					}
		        },
		        removedfile: function(file) {
		        	if (typeof file.media != 'undefined') {
		        		$.ajax({
							url: "{{ url($crud->route . '/' . $entry->id . '/media') }}" + '/' + file.media.id,
							type: 'DELETE'
						})
						.done(function(response) {
							var notification_type;

							if (response.success == true) {
								notification_type = 'success';

								if (file.previewElement != null && file.previewElement.parentNode != null) {
						        	file.previewElement.parentNode.removeChild(file.previewElement);
						        }
							}
							else {
								notification_type = 'error';
							}

							new Noty({
								text: response.message,
								type: notification_type,
								icon: false
							});
						})
						.fail(function (xhr) {
							var message = 'Deletion failed';

							if (xhr.responseJSON != 'undefined' && xhr.responseJSON.message != 'undefined') {
								message = xhr.responseJSON.message;
							}

							new Noty({
								text: message,
								type: 'error',
								icon: false
							});
						});

						return this._updateMaxFilesReachedClass();
		        	}

		        	if (file.previewElement != null && file.previewElement.parentNode != null) {
			        	file.previewElement.parentNode.removeChild(file.previewElement);
			        }

		        	return this._updateMaxFilesReachedClass();
		        },
			};

			var cOptions = @json($field['options']);

			var dropzone_{{ $field['name'] }} = new Dropzone("#dropzone_{{ $field['name'] }}", jQuery.extend(dOptions, cOptions));

			var dropzone_{{ $field['name'] }}_sortable = new Sortable(document.getElementById("dropzone_{{ $field['name'] }}"), {
	            handle: ".dz-preview",
	            draggable: ".dz-preview",
	            onEnd: function(evt) {
	            	var ids = this.toArray();

	            	if (ids.length > 0) {
	            		$.ajax({
							url: "{{ url($crud->route . '/' . $entry->id . '/media/reorder') }}",
							type: 'POST',
							data: {
								ids: ids
							}
						})
						.done(function(response) {
							var notification_type;

							if (response.success != true) {
								var message = 'Order failed';

								if (response.message != 'undefined') {
									message = response.message;
								}

								new Noty({
									text: message,
									type: 'error',
									icon: false
								});
							}

				
						})
						.fail(function (xhr) {
							var message = 'Order failed';

							if (xhr.responseJSON != 'undefined' && xhr.responseJSON.message != 'undefined') {
								message = xhr.responseJSON.message;
							}

							new Noty({
								text: message,
								type: 'error',
								icon: false
							});
						});
	            	}
	            }
	        });
		});
	</script>
@endpush
