<?php
/**
 */

namespace execut\seo\crudFields;


use execut\crudFields\fields\Editor;
use execut\crudFields\fields\Group;
use execut\crudFields\fields\RawField;
use execut\crudFields\fields\StringField;
use execut\seo\FieldsAttacher;
use yii\helpers\Html;

class Fields extends \execut\crudFields\Plugin
{
    public $varsList = [];
    protected function _getFields() {
        $helper = new FieldsAttacher([
            'tables' => [
                $this->owner->owner->tableName(),
            ],
        ]);
        $helper->up();

        $fields = [
            [
                'class' => Group::class,
                'module' => 'seo',
                'label' => 'Seo',
            ],
            [
                'class' => StringField::class,
                'module' => 'seo',
                'attribute' => 'header',
            ],
            [
                'class' => StringField::class,
                'module' => 'seo',
                'attribute' => 'title',
            ],
            [
                'class' => StringField::class,
                'module' => 'seo',
                'attribute' => 'description',
            ],
            [
                'class' => StringField::class,
                'module' => 'seo',
                'attribute' => 'keywords',
            ],
            [
                'module' => 'seo',
                'class' => Editor::class,
                'attribute' => 'text',
            ],
        ];


        if ($this->varsList) {
            $varsListParts = [];
            foreach ($this->varsList as $key => $description) {
                $varsListParts[] = '{' . $key . '} - ' . $description;
            }

            $fields['VarsList'] = [
                'class' => RawField::class,
                'module' => 'seo',
//                'attribute' => 'vars_list',
                'value' => Html::ul($varsListParts),
            ];
        }

        return $fields;
    }
}