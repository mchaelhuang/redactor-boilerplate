<?php

use File, Image, Input;
use Symfony\Component\Finder\Finder;

/**
 * Laravel 4.2 with Intervention Image
 */
class RedactorController {

  public function postUpload()
  {
    $allowed = ['png', 'jpg', 'jpeg', 'gif'];

    if (Input::hasFile('file')) {
      $image = Input::file('file');

      $image_dir = 'uploads/medias/';
      $extension = strtolower($image->getClientOriginalExtension());
      $filename = str_random(12) . '.' . $extension;

      if (! in_array($extension, $allowed)) {
        return array('errors' => 'file type is not allowed');
      }

      $image->move($image_dir, $filename);

      // Make thumbnail
      $thumb_dir = 'uploads/medias-thumbs/';
      $thumb = Image::make($image_dir . $filename)
                  ->fit(122, 91)
                  ->encode($extension);

      $thumb->save($thumb_dir . $filename);

      return array('url' => uploads('medias/' . $filename));
    }
  }

  public function getMedia()
  {
    $media_dir = public_path('uploads/medias');

    $files = Finder::create()
                ->files()
                ->in($media_dir)
                ->sortByModifiedTime();

    $files = array_reverse(iterator_to_array($files, false));
    
    $images = array();

    foreach ($files as $file) {
      $filename = ltrim(str_replace($media_dir, '', $file), '/');

      $images[] = array(
        'thumb' => uploads('medias-thumbs/' . $filename),
        'url'   => uploads('medias/' . $filename),
        'title' => $filename,
      );
    }

    return $images;
  }

}
