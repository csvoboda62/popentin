<?php

namespace App\Controller\Admin;

use App\Entity\Pop;
use App\Form\PopImageType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PopCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Pop::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            NumberField::new('number'),
            TextareaField::new('search'),
            AssociationField::new('serie'),
            CollectionField::new('images')->setEntryType(PopImageType::class)
        ];
    }
}
