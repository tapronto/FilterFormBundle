<?php
namespace Tapronto\FormFilterBundle\Form;

class FilterForm {
    private $form;
    private $filter;
    private $modelClass;
    private $entityManager;
    private $documentManager;

    public function __construct($form, $filter) {
        $this->form = $form;
        $this->filter = $filter;
    }

    public function buildFilters() {
        foreach ($this->getData() as $field => $constraint) {
            $this->addConstraint($field, $constraint);
        }
    }

    public function createView() {
        return $this->form->createView();
    }

    public function bindRequest($request) {
        return $this->form->bindRequest($request);
    }

    public function getData() {
        return $this->form->getData();
    }

    public function addConstraint($filter, $constraint) {
        $this->filter->addConstraint($filter, $constraint);
    }

    public function getConstraints() {
        return $this->filter->getConstraints();
    }

    public function getFilterQuery($managerType = 'orm') {
        $objectManager = null;

        if($managerType == 'orm') {
            $objectManager = $this->getEntityManager();
        } else {
            $objectManager = $this->getDocumentManager();
        }

        return $objectManager->getRepository($this->getModelClass())->findBy($this->getConstraints());
    }

    public function getModelClass() {
        return $this->modelClass;
    }
    
    public function setModelClass($modelClass) {
        $this->modelClass = $modelClass;
    
        return $this;
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