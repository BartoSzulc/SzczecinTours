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
            ->setLocation('post_type', '==', 'wycieczki');

        $product
            ->addTab('tour_tab', ['placement' => 'left', 'label' => 'Informacje o wycieczce'])
            ->addDatePicker('tour_date', ['label' => 'Data wycieczki',  'display_format' => 'd.m.Y',
            'return_format' => 'd.m.Y',])
            ->addTimePicker('tour_time', ['label' => 'Godzina wycieczki', 'display_format' => 'G:i',
            'return_format' => 'G:i',])
            ->addText('tour_price', ['label' => 'Cena wycieczki'])
            ->addText('tour_duration', ['label' => 'Czas trwania wycieczki'])
            ->addText('tour_location', ['label' => 'Miejsce wycieczki'])
            ->addText('tour_persons', ['label' => 'Ilość osób'])
            ->addSelect('tour_button_version', ['label' => 'Wersja przycisku', 'choices' => ['v1' => 'Kup bilet online', 'v2' => 'Wejście za darmo', 'v3' => 'Napiwek'], 'wrapper' => ['width' => '100%'], 'default_value' => 'v1'])
            ->addGroup('tour_paid', ['label' => 'Kup bilet online', 'conditional_logic' => [['field' => 'tour_button_version', 'operator' => '==', 'value' => 'v1']]])
                ->addText('tour_text', ['label' => 'Tekst przycisku', 'default_value' => 'Kup bilet online'])
                ->addUrl('tour_link', ['label' => 'Link'])
            ->endGroup()
            ->addGroup('tour_free', ['label' => 'Wejście za darmo', 'conditional_logic' => [['field' => 'tour_button_version', 'operator' => '==', 'value' => 'v2']]])
                ->addText('tour_text', ['label' => 'Tekst przycisku', 'default_value' => 'Wejście za darmo'])
                ->addUrl('tour_link', ['label' => 'Link'])
            ->endGroup()
            ->addGroup('tour_tip', ['label' => 'Napiwek', 'conditional_logic' => [['field' => 'tour_button_version', 'operator' => '==', 'value' => 'v3']]])
                ->addText('tour_text', ['label' => 'Tekst przycisku', 'default_value' => 'Napiwek'])
                ->addUrl('tour_link', ['label' => 'Link'])
            ->endGroup()
            ->addWysiwyg('tour_description', ['label' => 'Opis wycieczki'])
            
            ->addTab('gallery_tab', ['placement' => 'left', 'label' => 'Galeria zdjęć'])
            ->addGallery('tour_gallery', ['label' => 'Galeria zdjęć',  'library' => 'all', 'instructions' => 'Dodaj zdjęcia z wycieczki (możemy powtórzyć zdjęcie z miniaturki)'])



            ;
        return $product->build();
    }
}
