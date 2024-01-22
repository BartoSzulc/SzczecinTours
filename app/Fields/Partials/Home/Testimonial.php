<?php

namespace App\Fields\Partials\Home;

use App\Options\Partials\Buttons;

use Log1x\AcfComposer\Partial;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Testimonial extends Partial
{
    /**
     * The partial field group.
     *
     * @return \StoutLogic\AcfBuilder\FieldsBuilder
     */
    public function fields()
    {
        $testimonial = new FieldsBuilder('testimonial');

        $testimonial
        ->addGroup('testimonial', ['label' => 'Opinie klientów'])
            ->addWysiwyg('title', ['label' => 'Tytuł'])
            ->addWysiwyg('content', ['label' => 'Treść'])
            ->addRepeater('elements', ['label' => 'Dodaj elementy oferty', 'button_label' => 'Dodaj element'])
                ->addWysiwyg('content', ['label' => 'Treść'])
                ->addImage('image', ['label' => 'Zdjęcie (logo)'])
                ->addText('name', ['label' => 'Imię i nazwisko'])
                ->addText('position', ['label' => 'Stanowisko'])
            ->endRepeater()
            ->addFields($this->get(Buttons::class))
        ->endGroup();
        return $testimonial;
    }
}
