<?php
namespace Tapronto\FormFilterBundle\Filter;

class FilterBuilder implements FilterBuilderInterface {
    public function setFilterEntity($entity) {
        $this->filterEntity = $entity;
    }

    public function addFilterConstraint($fieldName, $filterType, $filterOptions = array()) {
        if(!is_array($this->filters))
            $this->filters = array();

        if(!is_array($this->options))
            $this->options = array();

        $this->filters[$fieldName] = $filterType;
        $this->options[$fieldName] = $options;
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