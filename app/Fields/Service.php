<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Service extends Field
{
    /**
     * The field group.
     *
     * @return array
     */
    public function fields()
    {
        $service = new FieldsBuilder('service', ['title' => 'Serwis']);

        $service
        ->setLocation('page_template', '==', 'template-serwis.blade.php');

        $service

            ->addGroup('service', ['label' => 'Serwis'])
                ->addWysiwyg('title', ['label' => 'Tytuł'])
                ->addWysiwyg('subtitle', ['label' => 'Podtytuł'])
                ->addText('form_title', ['label' => 'Tytuł formularza'])
                ->addText('shortcode', ['label' => 'Shortcode'])
            ->endGroup()
        ;

        return $service->build();
    }
}
