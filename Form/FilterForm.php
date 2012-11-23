<?php
namespace Tapronto\FormFilterBundle\Form;

class FilterForm {
    private $form;
    private $filter;

    public function __construct($form, $filter) {
        $this->form = $form;
        $this->filter = $filter;
    }

    public function createView() {
        return $this->form->createView();
    }
}