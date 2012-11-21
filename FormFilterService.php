<?php
namespace Tapronto\FormFilterBundle;

use Tapronto\FormFilterBundle\Form\AbstractFormFilter;
use Tapronto\FormFilterBundle\Form\FormFilter;
use Tapronto\FormFilterBundle\Filter\FilterBuilder;
use Tapronto\FormFilterBundle\Filter\FilterBuilderInterface;
use Tapronto\FormFilterBundle\Filter\Filter;

class Filter {
    public function __construct($formFactory) {
        $this->formBuilder = $formFactory->createBuilder('form');
    }

    public function createFormFilter(AbstractFormFilter $formFilterMetaData) {
        $filterBuilder = new FilterBuilder();
        $formFilterMetaData->buildFilter($filterBuilder);
        $form = $this->newFormByFilter($filterBuilder);
        $filter = new Filter();

        return new FormFilter($form, $filter);
    }

    private function newFormByFilter(FilterBuilderInterface $filterBuilder) {
        foreach ($filterBuilder->getAllConstraints() as $fieldName => $filterType) {
            $this->formBuilder->add($fieldName, $filterType, $filterBuilder->getOptions($fieldName));
        }

        return $this->formBuilder->getForm();
    }
}