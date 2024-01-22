<?php

namespace App\Options\Partials;

use Log1x\AcfComposer\Partial;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Header extends Partial
{
    /**
     * The partial field group.
     *
     * @return array
     */
    public function fields()
    {
        $header = new FieldsBuilder('header');

        $header
            ->addGroup('header', ['label' => 'Nagłówek strony'])
                ->addText('mail', ['label' => 'Adres e-mail'])
                ->addText('phone', ['label' => 'Numer telefonu'])
                ->addText('linkedin', ['label' => 'Adres Linkedin'])
                ->addText('facebook', ['label' => 'Adres Facebook'])
                ->addTrueFalse('language', ['label' => 'Wersja językowa (pokaż?)'])
            ->endGroup()
          ;

        return $header;
    }
}
