<?php

namespace App\Options;

use Log1x\AcfComposer\Options as Field;

use App\Options\Partials\Recent;
use App\Options\Partials\Header;

use StoutLogic\AcfBuilder\FieldsBuilder;

class Options extends Field
{
    /**
     * The option page menu name.
     *
     * @var string
     */
    public $name = 'Zarządzanie motywem';

    /**
     * The option page document title.
     *
     * @var string
     */
    public $title = 'Zarządzanie motywem | Ustawienia';

    /**
     * The option page field group.
     *
     * @return array
     */
    public function fields()
    {
        $options = new FieldsBuilder('options');

        $options
           
            ->addTab('footer_tab', ['label' => 'Stopka'])
                ->addGroup('footer', ['label' => 'Stopka'])
                    ->addUrl('policy_link', ['label' => 'Link do polityki prywatności'])
                    ->addText('policy_text', ['label' => 'Tekst polityki prywatności'])
                    ->addRepeater('footer_menu', ['label' => 'Menu stopki', 'button_label' => 'Dodaj pozycję', 'max' => 2])
                        ->addText('title', ['label' => 'Tytuł'])
                        ->addRepeater('links', ['label' => 'Linki', 'button_label' => 'Dodaj link lub zwykły tekst', 'instructions' => 'Jeśli chcesz dodać zwykły tekst, pozostaw pole "Link" puste'])
                            ->addText('title', ['label' => 'Tekst'])
                            ->addUrl('link', ['label' => 'Link'])
                        ->endRepeater()
                    ->endRepeater()
                ->endGroup()
            ->addTab('modal_tab', ['label' => 'Modal (Kontakt)'])
            ->addGroup('modal', ['label' => 'Modal (Kontakt)'])
                ->addText('modal_title', ['label' => 'Tytuł'])
                ->addText('modal_phone', ['label' => 'Telefon'])
                ->addText('modal_email', ['label' => 'Email'])
            ->endGroup()
            ->addTab('recent', ['label' => 'Produkty powiązane'])
                ->addFields($this->get(Recent::class)) 
            ->addTab('dodatkowe_skrypty_tab', ['label' => 'Dodatkowe skrypty'])
                ->addTextarea('head', ['label' => 'Kod w sekcji head'])
                ->addTextarea('body', ['label' => 'Kod w sekcji body (przed zamknięciem body)'])

                ;

        return $options->build();
    }
}
