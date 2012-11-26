<?php
namespace Tapronto\FormFilterBundle;

use Tapronto\FormFilterBundle\Form\AbstractFilterForm;
use Tapronto\FormFilterBundle\Form\FilterForm;
use Tapronto\FormFilterBundle\Filter\FilterBuilder;
use Tapronto\FormFilterBundle\Filter\FilterBuilderInterface;
use Tapronto\FormFilterBundle\Filter\Filter;

class FilterFormService {
    public function __construct($formFactory, $session) {
        $this->formFactory = $formFactory;
        $this->session = $session;
    }

    public function createFilterForm(AbstractFilterForm $formFilterMetaData, $defaultData = null) {
        $this->formBuilder = $this->formFactory->createBuilder('form', $defaultData);
        $filterBuilder = new FilterBuilder();

        $formFilterMetaData->buildFilter($filterBuilder);
        $form = $this->newFormByFilter($filterBuilder);
        $filter = new Filter($this->session);
        $filterForm = new FilterForm($form, $filter);

        $filterForm->setModelClass($formFilterMetaData->getClass());
        $filterForm->setEntityManager($this->getEntityManager());
        $filterForm->setDocumentManager($this->getDocumentManager());

        return $filterForm;
    }

    private function newFormByFilter(FilterBuilderInterface $filterBuilder) {
        foreach ($filterBuilder->getAllConstraints() as $fieldName => $filterType) {
            $this->formBuilder->add($fieldName, $filterType, $filterBuilder->getOptions($fieldName));
        }

        return $this->formBuilder->getForm();
    }

    public function getEntityManager() {
        return $this->entityManager;
    }
    
    public function setEntityManager($entityManager) {
        $this->entityManager = $entityManager;
    
        return $this;
    }

    public function getDocumentManager() {
        return $this->documentManager;
    }
    
    public function setDocumentManager($documentManager) {
        $this->documentManager = $documentManager;
    
        return $this;
    }
}