<?php

namespace App\Fields\Partials\Home;

use Log1x\AcfComposer\Partial;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Newsletter extends Partial
{
    /**
     * The partial field group.
     *
     * @return \StoutLogic\AcfBuilder\FieldsBuilder
     */
    public function fields()
    {
        $newsletter = new FieldsBuilder('newsletter');

        $newsletter
        ->addGroup('newsletter', ['label' => 'Newsletter'])
            ->addWysiwyg('title', ['label' => 'Tytuł'])
            ->addWysiwyg('content', ['label' => 'Treść'])
            ->addText('shortcode', ['label' => 'Shortcode do formularza'])
        ->endGroup()
        ;

        return $newsletter;
    }
}
