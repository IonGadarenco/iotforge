<?php
namespace App\Classes;

use Image;

class ImageLogic{

    /**
     * @var OriginalImage
     */
    public $originalImage;

    /**
     * @var $path (storage path)
     */
    public $path;

    /**
     * @var length of result image
     */
    public $length;

    /**
     * @var height of result image
     */
    public $height;

    /**
     * @var pictureLink in storage
     */
    public $pictureLink;

    /**
     * Create Path if not exist
     * @param $path
     */
    public function createStoragePath($path){
        if (!file_exists($path)) {
            mkdir($path, 755, true);
        }
    }

    public function storeImage(){

        $thumbnailImage = Image::make($this->originalImage);
        $thumbnailPath = storage_path().'/app/public/'.$this->path;
        $this->createStoragePath($thumbnailPath);

        //Resize image
        if ($this->length && $this->height){
            $thumbnailImage->fit($this->length, $this->height, function ($constraint){
                $constraint->aspectRatio();
            });
        }

        $thumbnailImage->stream();
        //$imageName = $this->originalImage->getClientOriginalName();
        $extenstion = $this->originalImage->extension();

        $time = time();
        $thumbnailImage->save($thumbnailPath.'/'.$time.'.'.$extenstion);

        $this->pictureLink = $this->path.'/'.$time.'.'.$extenstion;
    }
}
?>
