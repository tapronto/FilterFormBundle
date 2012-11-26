<?php
namespace Tapronto\FormFilterBundle\Form;

use Tapronto\FormFilterBundle\Filter\FilterBuilderInterface;
use Symfony\Component\Form\FormBuilderInterface;

abstract class AbstractFilterForm {
    abstract function buildFilter(FilterBuilderInterface $builder);
    abstract function getClass();
}