<ul class="list divider-full-bleed" id="files_container">
    @include('admin.components.files.files', ['files' => $parent->files])
</ul>
<input type="file" name="file" id="file" class="file" style="display: none">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>

    /**
     * Initiate Ajax request when add image
     */
    $('#file').change(function(){
        console.log('sdfsd');

        store_file()
    })

    /**
     * Store image to gallery and update gallery content
     */
    function store_file(){
        var fileInput = document.getElementById('file');
        var dataForm = new FormData();
        var file = fileInput.files[0];
        dataForm.append('file', file);
        dataForm.append('fileable_type', '{{$type}}');
        dataForm.append('name', $('#file_name').val());
        dataForm.append('category', $('#file_category').val());

        $.ajax({
            url: "{{route('files.store_file', $parent->id)}}",
            type:"POST",
            headers: {
                'X-CSRF-Token': "{{ csrf_token() }}"
            },
            data: dataForm,
            success:function(response){
                $('#files_container').html(response);
            },
            processData: false,
            contentType: false,
        });
    }

    function delete_file(id){
        $.ajax({
            url: "{{route('files.destroy_file', [$parent->id])}}",
            type:"POST",
            headers: {
                'X-CSRF-Token': "{{ csrf_token() }}"
            },
            data: {'id': id},
            success:function(response) {
                $('#files_container').html(response);
                $('#deleteModal').modal('hide');
            },
        });
    }

</script>
