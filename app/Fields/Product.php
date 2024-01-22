<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Product extends Field
{
    /**
     * The field group.
     *
     * @return array
     */
    public function fields()
    {
        $product = new FieldsBuilder('product', ['title' => 'Sekcje z polami do wypełnienia']);

        $product
            ->setLocation('post_type', '==', 'produkty');

        $product
        ->addTab('configurator-tab', ['label' => 'Konfigurator'])
            ->addSelect('select_product', ['label' => 'Wybierz typ produktu', 'choices' => ['v1' => 'Produkt prosty', 'v2' => 'Produkt z wariantami']])
                ->addGroup('product_variations', ['label' => 'Produkt z wariantami', 'conditional_logic' => [['field' => 'select_product', 'operator' => '==', 'value' => 'v2']]])
                    ->addText('price_default', ['label' => 'Cena domyślna'])
                    ->addText('configurator_name', ['label' => 'Tytuł konfiguratora'])
                    ->addRepeater('elements', ['label' => 'Warianty produktu', 'button_label' => 'Dodaj wariant'])
                        ->addText('name', ['label' => 'Nazwa wariantu'])
                        ->addImage('image', ['label' => 'Zdjęcie wariantu'])
                        ->addText('price', ['label' => 'Cena wariantu'])
                    ->endRepeater()
                    ->addTrueFalse('show_additional', ['label' => 'Dodatkowa część wspólna? (np. Filtrowymiennik)'])
                        ->addText('additional_name', ['label' => 'Nazwa dodatkowej części wspólnej', 'conditional_logic' => [['field' => 'show_additional', 'operator' => '==', 'value' => '1']]])
                        ->addRepeater('elements_additional', ['label' => 'Warianty produktu (dodatkowe)', 'instructions' => 'Dodaj zdjęcie do każdego wiersza powyżej (w przypadku 4 wierszy dodaj 4 zdjęcia) - wyświetlają się one automatycznie od 1 do ostatniego, oraz uzepełnij cene dla tych zdjęć.', 'button_label' => 'Dodaj wariant', 'conditional_logic' => [['field' => 'show_additional', 'operator' => '==', 'value' => '1']]])
                            ->addImage('image', ['label' => 'Zdjęcie wariantu'])
                            ->addText('price', ['label' => 'Cena wariantu'])
                        ->endRepeater()
                ->endGroup()
            ->addGroup('product_simple', ['label' => 'Produkt prosty', 'conditional_logic' => [['field' => 'select_product', 'operator' => '==', 'value' => 'v1']]])
                ->addGroup('elements', ['label' => 'Elementy produktu prostego', 'button_label' => ''])
                    ->addImage('image', ['label' => 'Zdjęcie wariantu'])
                    ->addText('price', ['label' => 'Cena wariantu'])
                ->endGroup()
            ->endGroup()
        ->addTab('description-tab', ['label' => 'Opis produktu'])
            ->addRepeater('elements', ['label' => 'Elementy opisu', 'button_label' => 'Dodaj element'])
                ->addText('heading', ['label' => 'Nagłówek / Tytuł'])
                ->addWysiwyg('content', ['label' => 'Treść'])
            ->endRepeater()
        ->addTab('form-tab', ['label' => 'Formularz'])
            ->addText('form_heading', ['label' => 'Nagłówek formularza'])
            ->addText('form_shortcode', ['label' => 'Shortcode formularza'])

        ;
        return $product->build();
    }
}
