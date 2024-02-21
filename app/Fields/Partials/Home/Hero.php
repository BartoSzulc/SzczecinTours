<?php

namespace App\Fields\Partials\Home;

use App\Options\Partials\Buttons;

use Log1x\AcfComposer\Partial;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Hero extends Partial
{
    /**
     * The partial field group.
     *
     * @return \StoutLogic\AcfBuilder\FieldsBuilder
     */
    public function fields()
    {
        $hero = new FieldsBuilder('hero');

        $hero
            ->addRepeater('hero', ['label' => 'Hero/slajder', 'button_label' => 'Dodaj slajd'])
                ->addWysiwyg('title', ['label' => 'Tytuł'])
                ->addImage('image', ['label' => 'Zdjęcie'])
            ->endRepeater();

        return $hero;
    }
}
