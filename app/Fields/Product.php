<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Product extends Field
{
    /**
     * The field group.
     *
     * @return array
     */
    public function fields()
    {
        $product = new FieldsBuilder('product', ['title' => 'Sekcje z polami do wypełnienia']);

        $product
            ->setLocation('post_type', '==', 'wycieczki');

        $product
            ->addDatePicker('tour_date', ['label' => 'Data wycieczki',  'display_format' => 'd.m.Y',
            'return_format' => 'd.m.Y',])
            ->addTimePicker('tour_time', ['label' => 'Godzina wycieczki', 'display_format' => 'G:i',
            'return_format' => 'G:i',])
            ->addText('tour_price', ['label' => 'Cena wycieczki'])
            

            ;
        return $product->build();
    }
}
