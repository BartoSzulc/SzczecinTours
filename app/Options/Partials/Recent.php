<?php

namespace App\Options\Partials;

use Log1x\AcfComposer\Partial;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Recent extends Partial
{
    /**
     * The partial field group.
     *
     * @return array
     */
    public function fields()
    {
        $recent = new FieldsBuilder('recent');

        $recent
            ->addGroup('recent', ['label' => 'Produkty powiązane'])
                ->addWysiwyg('title', ['label' => 'Tytuł'])
            ->endGroup()
        ;

        return $recent;
    }
}
