<?php
namespace Tapronto\FormFilterBundle\Filter;

class Filter {
    public function __construct($session) {
        $this->session = $session;
    }

    public function addConstraint($field, $value) {
        $constraints = ($this->session->has('constraints')) ? $this->session->get('constraints') : array();
        $constraints[$field] = $value;
        $this->session->set('constraints', $constraints);
    }

    public function getConstraints() {
        return ($this->session->has('constraints')) ? $this->session->get('constraints') : array();
    }

    public function getConstraint($field) {
        return ($this->session->has("constraints/$field")) ? $this->session->get("constraints/$field") : array();
    }

    public function deleteConstraint($field) {
        $this->session->remove($field);
    }

    public function clearAllConstraints() {
        $this->session->remove('constraints');
    }
}