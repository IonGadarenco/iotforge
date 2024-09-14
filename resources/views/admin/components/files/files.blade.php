<div class="block block-rounded ">

    <div class="block-header block-header-default border border-info mb-3">
        <div class="form-group">
            <input type="text" class="form-control" id="file_name" name="file_name" placeholder="Nume fisier">
        </div>
        <div class="block-options">
            <button type="button" class="btn btn-sm btn-primary" onclick="$('#file').click()">
                Adaugă fișier
            </button>
        </div>
    </div>

    <div class="block-content border border-info pt-0">
        <h3 class="block-title text-center"><u>Fișiere</u></h3>

        <table class="table table-vcenter">
            <thead>
                <tr>
                    <th class="pt-0">Name</th>
                    <th class="text-center pt-0" style="width: 100px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($files as $file)
                    <tr>
                        <td class="fw-semibold fs-sm">
                            <a href="{{ asset("storage/" . $file->file) }}" target="_blank">{{ $file->name }}</a>
                        </td>
                        <td class="text-center">
                            <div class="btn-group">

                                <a type="button" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled"
                                    href="javascript:void(0)" onclick="myFunction({{ $file->id }})">
                                    <i class="fa fa-copy" id="myTooltip{{ $file->id }}" style="color: green"></i>
                                </a>
                                <input type="text" id="myInput{{ $file->id }}"
                                    value="{{ asset("storage/" . $file->file) }}"
                                    style="position: absolute; left: -9999px;">
                                <a type="button" href="javascript:void(0);"
                                    onclick="edit_file_name({{ $file["id"] }})"
                                    class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled" data-bs-toggle="tooltip"
                                    title="" data-bs-original-title="Edit Client">
                                    <i class="fa fa-fw fa-pencil-alt"></i>
                                </a>

                                <a type="button" href="javascript:void(0)"
                                    onclick="DeleteConfirmAJAX('delete_file({{ $file->id }})')"
                                    class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled" data-bs-toggle="tooltip"
                                    title="" data-bs-original-title="Remove Client">
                                    <i class="fa fa-fw fa-times"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <script>
                        function edit_file_name(id) {
                            $('#editFileModal' + id).modal('show');
                        }
                    </script>
                    <script>
                        function myFunction(id) {
                            /* Obține câmpul de text */
                            var copyText = document.getElementById("myInput" + id);

                            /* Selectează câmpul de text */
                            copyText.select();
                            copyText.setSelectionRange(0, 99999); /* Pentru dispozitive mobile */

                            /* Copiază textul din câmpul de text */
                            document.execCommand("copy");

                            /* Afișează un mesaj de confirmare */
                            var tooltip = document.getElementById("myTooltip" + id);
                            tooltip.innerHTML = "Copiat!";
                        }
                    </script>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@foreach ($files as $file)
    <div class="modal fade" id="editFileModal{{ $file["id"] }}" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel" style="padding-right: 17px;" aria-modal="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addNewPartnerLabel">Editare Fisier</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="row gutters" method="post" enctype="multipart/form-data"
                        action="{{ route("files.updateFile", $file["id"]) }}">
                        @csrf
                        @method("PUT")
                        <div class="col-12">
                            <div class="form-group">
                                <label for="name_new">Nume:</label>
                                <input type="text" class="form-control" name="name" value="{{ $file["name"] }}">
                            </div>
                        </div>
                        <div class="col-md-12 text-center">
                            <div class="modal-footer">
                                <div class="left-side">
                                    <button type="button" class="btn btn-link danger btn-block"
                                        data-dismiss="modal">Renunță</button>
                                </div>
                                <div class="right-side">
                                    <button type="submit" class="btn btn-link success">Salvează</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endforeach
