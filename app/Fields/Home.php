<?php

namespace App\Fields;

use App\Fields\Partials\Home\Hero;
use App\Fields\Partials\Home\About;
use App\Fields\Partials\Home\Offer;
use App\Fields\Partials\Home\Testimonial;
use App\Fields\Partials\Home\Newsletter;
use App\Fields\Partials\Home\Contact;
use App\Fields\Partials\Home\Realizations;
use App\Fields\Partials\Home\WhyUs;


use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Home extends Field
{
    /**
     * The field group.
     *
     * @return array
     */
    public function fields()
    {
        $home = new FieldsBuilder('home', ['title' => 'Sekcje z polami do wypełnienia']);

        $home
            ->setLocation('page_type', '==', 'front_page');

        $home
        ->addTab('hero', ['label' => 'Hero', 'placement' => 'left'])
            ->addFields($this->get(Hero::class)) 
        ->addTab('about', ['label' => 'O mnie', 'placement' => 'left'])
            ->addFields($this->get(About::class))
        ->addTab('offer', ['label' => 'Oferta', 'placement' => 'left'])
            ->addFields($this->get(Offer::class))
        ->addTab('testimonial', ['label' => 'Opinie', 'placement' => 'left'])
            ->addFields($this->get(Testimonial::class))
        ->addTab('newsletter', ['label' => 'Newsletter', 'placement' => 'left'])
            ->addFields($this->get(Newsletter::class))
        ->addTab('realizations', ['label' => 'Realizacje', 'placement' => 'left'])
            ->addFields($this->get(Realizations::class))
        ->addTab('whyus', ['label' => 'Dlaczego warto?', 'placement' => 'left'])   
            ->addFields($this->get(WhyUs::class))
        ->addTab('contact', ['label' => 'Kontakt', 'placement' => 'left'])
            ->addFields($this->get(Contact::class))
        ;

        return $home->build();
    }
}
