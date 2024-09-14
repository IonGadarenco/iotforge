<div class="row gutters mt-3">
    @foreach ($images as $image)
        <div class="col-md-4 position-relative">
            <a href="{{ asset("storage/" . $image->picture) }}" class="effects" data-lightbox="product-gallery">
                <img class="img-fluid" src="{{ asset("storage/" . $image->picture_small) }}"
                    alt="{{ $image->imageable->name }}" />
            </a>
            <div class="icon delete_image" onclick="delete_image({{ $image->id }})">
                <i class="fa fa-trash text-warning"></i>
            </div>
            <a href="{{ asset("storage/" . $image->picture) }}" class="icon view_image" data-lightbox="product-gallery">

                <i class="fa fa-plus text-primary"></i>
            </a>
        </div>
    @endforeach
</div>

<style>
    .position-relative {
        position: relative;
    }

    .icon {
        font-size: 15px;
        background-color: rgba(255, 255, 255, 0.7);
        border-radius: 50%;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: absolute;
        cursor: pointer;
        transition: background-color 0.3s, box-shadow 0.3s;
    }

    .delete_image {
        top: 50%;
        right: 10%;
    }

    .view_image {
        top: 10%;
        right: 10%;
    }

    .icon:hover {
        background-color: rgba(255, 255, 255, 0.9);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }
</style>
