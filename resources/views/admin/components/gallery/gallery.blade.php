<div class="text-left">
    <div style="display: none">
        <input type="file" name="pictureGallery" class="custom-file-input" id="uploadPhotoGallery">
    </div>
    <a class="btn btn-info btn-sm" href="javascript:void(0)" onclick="$('#uploadPhotoGallery').click();"
        style="color: white">Adaugă Imagine <i class="icon-image"></i></a>
</div>
<div class="baguetteBoxThree" id="gallery">
    @include("admin.components.gallery.images", ["images" => $parent->images])
</div>

<script src="{{ asset("/admin_assets/gallery/baguetteBox.js") }}" async></script>
<script src="{{ asset("/admin_assets/gallery/plugins.js") }}" async></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    /**
     * Initiate Ajax request when add image
     */
    $(document).ready(function() {

        $('#uploadPhotoGallery').change(function() {
            store_image()
        })
    });
    /**
     * Store image to gallery and update gallery content
     */
    function store_image() {
        console.log("{{ $type }}");
        var fileInput = document.getElementById('uploadPhotoGallery');
        var dataForm = new FormData();
        var file = fileInput.files[0];
        dataForm.append('picture', file);
        dataForm.append('imageable_type', '{{ $type }}');

        $.ajax({
            url: "{{ route("images.store_image", $parent->id) }}",
            type: "POST",
            headers: {
                'X-CSRF-Token': "{{ csrf_token() }}"
            },
            data: dataForm,
            success: function(response) {

                $('#gallery').html(response);
            },
            error: function(response) {
                console.log('error');
                console.log(response);
                $('#gallery').html(response);

            },
            processData: false,
            contentType: false,
        });
    }

    function delete_image(id) {
        $.ajax({
            url: "{{ route("images.destroy_image", [$parent->id]) }}",
            type: "POST",
            headers: {
                'X-CSRF-Token': "{{ csrf_token() }}"
            },
            data: {
                'id': id
            },
            success: function(response) {
                $('#gallery').html(response);
            },
        });
    }
</script>
