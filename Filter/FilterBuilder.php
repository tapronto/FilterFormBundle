<?php
namespace Tapronto\FormFilterBundle\Filter;

class FilterBuilder implements FilterBuilderInterface {
    private $filters = array();
    private $options = array();

    public function setFilterEntity($entity) {
        $this->filterEntity = $entity;
    }

    public function addFilterConstraint($fieldName, $filterType, $filterOptions = array()) {
        $this->filters[$fieldName] = $filterType;
        $this->options[$fieldName] = $filterOptions;
    }

    public function getAllConstraints() {
        return $this->filters;
    }

    public function getConstraints($fieldName) {
        return $this->filters[$fieldName];
    }

    public function getAllOptions() {
        return $this->options;
    }

    public function getOptions($fieldName) {
        return $this->options[$fieldName];
    }
}