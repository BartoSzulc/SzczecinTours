<?php

namespace App\Fields\Partials\Home;

use Log1x\AcfComposer\Partial;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Realizations extends Partial
{
    /**
     * The partial field group.
     *
     * @return \StoutLogic\AcfBuilder\FieldsBuilder
     */
    public function fields()
    {
        $realizations = new FieldsBuilder('realizations');

        $realizations
        ->addGroup('realizations', ['label' => 'Realizacje'])
          ->addWysiwyg('title', ['label' => 'Tytuł'])
          ->addWysiwyg('content', ['label' => 'Treść'])
        ->endGroup()
        ;

        return $realizations;
    }
}
