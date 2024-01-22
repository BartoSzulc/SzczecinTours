<?php

namespace App\Fields\Partials\Home;

use App\Options\Partials\Buttons;

use Log1x\AcfComposer\Partial;
use StoutLogic\AcfBuilder\FieldsBuilder;

class WhyUs extends Partial
{
    /**
     * The partial field group.
     *
     * @return \StoutLogic\AcfBuilder\FieldsBuilder
     */
    public function fields()
    {
        $whyUs = new FieldsBuilder('why_us');

        $whyUs
        
        ->addGroup('whyus', ['label' => 'Dlaczego warto?'])
            ->addWysiwyg('title', ['label' => 'Tytuł'])
            ->addWysiwyg('subtitle', ['label' => 'Podtytuł'])
            ->addWysiwyg('content', ['label' => 'Treść'])
            ->addRepeater('elements', ['label' => 'Dodaj elementy oferty', 'button_label' => 'Dodaj element'])
                ->addImage('image', ['label' => 'Zdjęcie'])
                ->addWysiwyg('content', ['label' => 'Treść'])
            ->endRepeater()
           ->addFields($this->get(Buttons::class))
        ->endGroup()
        ;
        return $whyUs;
    }
}
