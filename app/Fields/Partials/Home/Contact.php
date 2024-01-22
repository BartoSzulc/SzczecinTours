<?php

namespace App\Fields\Partials\Home;
use App\Options\Partials\Buttons;
use Log1x\AcfComposer\Partial;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Contact extends Partial
{
    /**
     * The partial field group.
     *
     * @return \StoutLogic\AcfBuilder\FieldsBuilder
     */
    public function fields()
    {
        $contact = new FieldsBuilder('contact');

        $contact
            ->addGroup('contact', ['label' => 'Kontakt'])
                ->addGroup('left-col', ['label' => 'Lewa kolumna'])
                    ->addWysiwyg('title', ['label' => 'Tytuł'])
                    ->addWysiwyg('subtitle', ['label' => 'Podtytuł'])
                    ->addWysiwyg('description', ['label' => 'Adres'])
                    ->addWysiwyg('nip_regon', ['label' => 'NIP/REGON'])
                    ->addFields($this->get(Buttons::class))
                ->endGroup()
                ->addUrl('map', ['label' => 'Link do mapy'])
                ->addGroup('right-col', ['label' => 'Prawa kolumna'])
                    ->addRepeater('elements', ['label' => 'Elementy kontaktowe', 'button_label' => 'Dodaj element'])
                        ->addSelect('type', ['label' => 'Typ', 'choices' => ['phone' => 'Telefon', 'mail' => 'Mail']])
                        ->addImage('icon', ['label' => 'Ikona'])
                        ->addText('text', ['label' => 'Tekst (mail, telefon, etc)'])
                    ->endRepeater()
                    ->addFields($this->get(Buttons::class))
                ->endGroup()
            ->endGroup()
        ;

        return $contact;
    }
}
