<?php

namespace App\Options\Partials;

use Log1x\AcfComposer\Partial;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Buttons extends Partial
{
    /**
     * The partial field group.
     *
     * @return array
     */
    public function fields()
    {
        $buttons = new FieldsBuilder('buttons');

        $buttons

            ->addSelect('button_version', ['label' => 'Wersja przycisku', 'choices' => ['v1' => 'Wersja pierwsza', 'v2' => 'Wersja druga'], 'wrapper' => ['width' => '100%'], 'default_value' => 'v1'])
            ->addLink('button_link', ['label' => 'Link oraz tekst przycisku', 'wrapper' => ['width' => '100%']]);

        return $buttons;
    }
}
