<?php
namespace Tapronto\FormFilterBundle\Form;

use Tapronto\FormFilterBundle\Filter\FilterBuilderInterface;
use Symfony\Component\Form\FormBuilderInterface;

abstract class AbstractFormFilter {
    public function createFormFilter(FilterBuilderInterface $filterBuilder) {
        foreach ($filterBuilder->getAllConstraints() as $fieldName => $filterType) {
            $this->formBuilder->add($fieldName, $filterType, $filterBuilder->getOptions($fieldName));
        }

        return $this->formBuilder->getForm();
    }

    abstract function buildFilter(FilterBuilderInterface $builder);

    public function setFormBuilder(FormBuilderInterface $builder) {
        $this->formBuilder = $builder;
    }
}