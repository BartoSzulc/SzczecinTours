<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class ProductGallery extends Field
{
    /**
     * The field group.
     *
     * @return array
     */
    public function fields()
    {
        $gallery = new FieldsBuilder('product_gallery', ['title' => 'Galeria wycieczki']);

        $gallery

            ->setLocation('post_type', '==', 'wycieczki');

        $gallery
            
            ;

        return $gallery;
    }
}
