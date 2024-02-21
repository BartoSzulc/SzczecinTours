<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Taxonomy extends Field
{
    /**
     * The field group.
     *
     * @return array
     */
    public function fields()
    {
        $taxonomy = new FieldsBuilder('taxonomy', ['title' => 'Ikona kategorii']);

        $taxonomy
            ->setLocation('taxonomy', '==', 'kategoria_wycieczki');
            

        $taxonomy
            ->addImage('category_image', ['label' => 'Zdjęcie kategorii'])
            ;

        return $taxonomy->build();
    }
}
