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
        if($managerType == 'orm') {
            $builder = $this->getEntityManager()->createQueryBuilder($this->getModelClass());

            foreach ($this->getConstraints() as $field => $value) {
                if($value) {
                    $builder->where("$field LIKE :param");
                    $builder->setParameter("%$value%");
                }
            }
        } else {
            $builder = $this->getDocumentManager()->getRepository($this->getModelClass())->createQueryBuilder();

            foreach ($this->getConstraints() as $field => $value) {
                if($value) {
                    $builder->field($field)->equals(new \MongoRegex("/.*$value.*/"));
                }
            }
        }

        return $builder->getQuery();
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