<?php

namespace App\Fields;

use App\Options\Partials\Buttons;

use Log1x\AcfComposer\Field;

use StoutLogic\AcfBuilder\FieldsBuilder;

class Contact extends Field
{
    /**
     * The field group.
     *
     * @return array
     */
    public function fields()
    {
        $contact = new FieldsBuilder('contact', ['title' => 'Kontakt']);

        $contact
            ->setLocation('page_template', '==', 'template-kontakt.blade.php');

        $contact
            ->addGroup('contact', ['label' => 'Kontakt'])
                ->addGroup('left-col', ['label' => 'Lewa kolumna'])
                    ->addWysiwyg('subtitle', ['label' => 'Podtytuł'])
                    ->addWysiwyg('description', ['label' => 'Adres'])
                    ->addWysiwyg('nip_regon', ['label' => 'NIP/REGON'])
                    ->addFields($this->get(Buttons::class))
                    ->addRepeater('elements', ['label' => 'Elementy kontaktowe', 'button_label' => 'Dodaj element'])
                        ->addSelect('type', ['label' => 'Typ', 'choices' => ['phone' => 'Telefon', 'mail' => 'Mail']])
                        ->addImage('icon', ['label' => 'Ikona'])
                        ->addText('text', ['label' => 'Tekst (mail, telefon, etc)'])
                    ->endRepeater()
                ->endGroup()
                ->addUrl('map', ['label' => 'Link do mapy'])
                ->addGroup('form', ['labek' => 'Formularz kontaktowy'])
                    ->addText('title', ['label' => 'Tytuł'])
                    ->addText('shortcode', ['label' => 'Shortcode formularza'])
                ->endGroup()
            ->endGroup()
            ;

        return $contact->build();
    }
}
