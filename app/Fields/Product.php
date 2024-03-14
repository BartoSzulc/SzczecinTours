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
            ->addDateTimePicker('tour_datetime', ['label' => 'Pełna data wycieczki automatycznie zaciągana z powyższych pól.', 'display_format' => 'd.m.Y G:i', // Display format in the UI
            'return_format' => 'Y-m-d H:i:s'])
            ->addText('tour_price', ['label' => 'Cena wycieczki'])
            ->addText('tour_duration', ['label' => 'Czas trwania wycieczki'])
            ->addText('tour_location', ['label' => 'Miejsce wycieczki'])
            ->addText('tour_location_link', ['label' => 'Link do miejsca wycieczki'])
            ->addText('tour_language', ['label' => 'Tekst wyświetlany przy fladze', 'instructions' => 'Wycieczka w polskiej wersji językowej'])
            ->addRepeater('add_button_tour', ['label' => 'Dodaj przycisk', 'button_label' => 'Dodaj przycisk', 'max' => 3])
                ->addSelect('tour_button_version', ['label' => 'Wersja przycisku', 'choices' => ['v1' => 'Kup bilet online', 'v2' => 'Link do wydarzenia', 'v3' => 'Napiwek'], 'wrapper' => ['width' => '100%'], 'default_value' => 'v1'])
                ->addGroup('tour_paid', ['label' => 'Kup bilet online', 'conditional_logic' => [['field' => 'tour_button_version', 'operator' => '==', 'value' => 'v1']]])
                    ->addText('tour_text', ['label' => 'Tekst przycisku', 'default_value' => 'Kup bilet online'])
                    ->addText('tour_link', ['label' => 'Link'])
                ->endGroup()
                ->addGroup('tour_free', ['label' => 'Link do wydarzenia', 'conditional_logic' => [['field' => 'tour_button_version', 'operator' => '==', 'value' => 'v2']]])
                    ->addText('tour_text', ['label' => 'Tekst przycisku', 'default_value' => 'Link do wydarzenia'])
                    ->addText('tour_link', ['label' => 'Link'])
                ->endGroup()
                ->addGroup('tour_tip', ['label' => 'Napiwek', 'conditional_logic' => [['field' => 'tour_button_version', 'operator' => '==', 'value' => 'v3']]])
                    ->addText('tour_text', ['label' => 'Tekst przycisku', 'default_value' => 'Napiwek'])
                    ->addText('tour_link', ['label' => 'Link'])
                ->endGroup()
            ->endRepeater()
            ->addFlexibleContent('flexeditor', ['button_label' => 'Dodaj sekcję', 'label' => 'Więcej informacji'])
                ->addLayout('wysiwyg', ['label' => 'WYSIWYG'])
                    ->addWysiwyg('content', ['label' => 'WYSIWYG'])
                ->addLayout('small-text', ['label' => 'Mały tekst, jasno szary'])
                    ->addWysiwyg('content', ['label' => 'WYSIWYG'])
                ->addLayout('big-text', ['label' => 'Duży tekst, ciemno szary'])
                    ->addWysiwyg('content', ['label' => 'WYSIWYG'])
            ->endFlexibleContent()

            ->addTab('gallery_tab', ['placement' => 'left', 'label' => 'Galeria zdjęć'])
            ->addGallery('tour_gallery', ['label' => 'Galeria zdjęć',  'library' => 'all', 'instructions' => 'Dodaj zdjęcia z wycieczki (możemy powtórzyć zdjęcie z miniaturki)'])

            ->addTab('other_tours_tab', ['placement' => 'left', 'label' => 'Ta sama wycieczka w innym terminie'])
            ->addRelationship('other_tours', ['label' => 'Ta sama wycieczka w innym terminie', 'elements' => 'featured_image', 'post_type' => ['wycieczki'], 'filters' => ['search', 'taxonomy']])

            ;
        return $product->build();
    }
}
