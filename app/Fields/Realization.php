<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Realization extends Field
{
    /**
     * The field group.
     *
     * @return array
     */
    public function fields()
    {
        $realization = new FieldsBuilder('realization', ['title' => 'Realizacja, sekcje do z polami do wypełnienia']);

        $realization
            ->setLocation('post_type', '==', 'realizacje');

        $realization
            ->addText('year', ['label' => 'Rok realizacji'])
            ->addGallery('gallery', ['label' => 'Galeria zdjęć', 'instructions' => 'Dodaj zdjęcia do galerii', 'return_format' => 'id'])
            ;
        return $realization->build();
    }
}
