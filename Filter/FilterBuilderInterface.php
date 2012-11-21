<?php
namespace Tapronto\FormFilterBundle\Filter;

interface FilterBuilderInterface {
    const TEXT_TYPE = 'text';
    const ENTITY_TYPE = 'entity';
    const LIST_TYPE = 'list';
    const CHECKBOX_TYPE = 'checkbox';
    const DATE_TYPE = 'date';

    function setFilterEntity($entity);

    function addFilterConstraint($fieldName, $constraintType, $options = array());
}