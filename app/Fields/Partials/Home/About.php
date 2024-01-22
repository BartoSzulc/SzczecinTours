<?php

namespace App\Fields\Partials\Home;

use App\Options\Partials\Buttons;


use Log1x\AcfComposer\Partial;
use StoutLogic\AcfBuilder\FieldsBuilder;

class About extends Partial
{
    /**
     * The partial field group.
     *
     * @return \StoutLogic\AcfBuilder\FieldsBuilder
     */
    public function fields()
    {
        $about = new FieldsBuilder('about');

        $about
        ->addGroup('about', ['label' => 'O nas', 'layout' => 'table'])
            ->addGroup('left-col', ['label' => 'Lewa kolumna'])
                ->addWysiwyg('title', ['label' => 'Tytuł'])
                ->addWysiwyg('subtitle', ['label' => 'Podtytuł'])
                ->addWysiwyg('content', ['label' => 'Treść'])
            ->endGroup()
            ->addImage('image', ['label' => 'Zdjęcie'])
            ->addGroup('right-col', ['label' => 'Prawa kolumna'])
                ->addWysiwyg('title', ['label' => 'Tytuł'])
                ->addWysiwyg('content', ['label' => 'Treść'])
                ->addFields($this->get(Buttons::class))
            ->endGroup()
        ->endGroup();
        
        return $about;
    }
}
