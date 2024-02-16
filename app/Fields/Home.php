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
        ->addTab('seo_tab', ['label' => 'SEO', 'placement' => 'left'])
            ->addGroup('seo', ['label' => 'SEO'])
                ->addText('seo_title', ['label' => 'Tytuł SEO', 'instructions' => 'Tytuł SEO'])
                ->addRepeater('seo_desc', ['label' => 'Opis', 'button_label' => 'Dodaj opis'])
                    ->addText('title', ['label' => 'Tytuł'])
                    ->addWysiwyg('desc', ['label' => 'Opis'])
                ->endRepeater()
                ->addRepeater('seo_icons', ['label' => 'Ikony'])
                    ->addImage('icon', ['label' => 'Ikona'])
                    ->addTextarea('desc', ['label' => 'Opis'])
                ->endRepeater()
            ->endGroup()
        ;

        return $home->build();
    }
}
