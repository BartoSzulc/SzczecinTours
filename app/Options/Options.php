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
            ->addTab('header', ['label' => 'Nagłówek'])
                ->addFields($this->get(Header::class))
            ->addTab('recent', ['label' => 'Produkty powiązane'])
                ->addFields($this->get(Recent::class)) 
            ->addTab('dodatkowe_skrypty_tab', ['label' => 'Dodatkowe skrypty'])
                ->addTextarea('head', ['label' => 'Kod w sekcji head'])
                ->addTextarea('body', ['label' => 'Kod w sekcji body (przed zamknięciem body)'])

                ;

        return $options->build();
    }
}
