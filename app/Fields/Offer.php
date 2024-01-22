<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Offer extends Field
{
    /**
     * The field group.
     *
     * @return array
     */
    public function fields()
    {
        $offer = new FieldsBuilder('offer', ['title' => 'Oferta']);

        $offer
        ->setLocation('page_template', '==', 'template-oferta.blade.php');

        $offer
            ->addGroup('offer', ['label' => 'Oferta'])
                ->addWysiwyg('title', ['label' => 'Tytuł'])
                ->addWysiwyg('subtitle', ['label' => 'Podtytuł'])
            ->endGroup()
;
        return $offer->build();
    }
}
