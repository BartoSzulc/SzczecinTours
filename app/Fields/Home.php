<?php

namespace App\Fields;

use App\Fields\Partials\Home\Hero;


use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Home extends Field
{
    /**
     * The field group.
     *
     * @return array
     */
    public function fields()
    {
        $home = new FieldsBuilder('home', ['title' => 'Sekcje z polami do wypełnienia']);

        $home
            ->setLocation('page_type', '==', 'front_page');

        $home
        ->addTab('hero', ['label' => 'Hero', 'placement' => 'left'])
            ->addFields($this->get(Hero::class)) 
        ;

        return $home->build();
    }
}
