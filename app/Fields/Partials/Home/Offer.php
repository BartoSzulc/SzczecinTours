<?php

namespace App\Fields\Partials\Home;

use App\Options\Partials\Buttons;

use Log1x\AcfComposer\Partial;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Offer extends Partial
{
    /**
     * The partial field group.
     *
     * @return \StoutLogic\AcfBuilder\FieldsBuilder
     */
    public function fields()
    {
        $offer = new FieldsBuilder('offer');

        $offer
        ->addGroup('offer', ['label' => 'Oferta'])
            ->addWysiwyg('title', ['label' => 'Tytuł'])
            ->addWysiwyg('content', ['label' => 'Treść'])
            ->addRepeater('elements', ['label' => 'Dodaj elementy oferty', 'button_label' => 'Dodaj element'])
                ->addWysiwyg('title', ['label' => 'Tytuł'])
                ->addWysiwyg('content', ['label' => 'Treść'])
                ->addImage('image', ['label' => 'Zdjęcie'])
                ->addFields($this->get(Buttons::class))
            ->endRepeater()
            ->addFields($this->get(Buttons::class))
        ->endGroup();
    

        return $offer;
    }
}
