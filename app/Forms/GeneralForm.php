<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class GeneralForm extends Form
{
    public function buildForm()
    {


        if ($this->getData('method_field')) {
            $this->add('_method', 'hidden', [
                'value' => $this->getData('method_field')
            ]);
        }

        if ($this->getData('form_type') === 'setting') {

            $this
                ->add('group', 'select', [
                    'choices' => ['0' => '基本', '1' => '系统', '2' => '开发', '3' => '安全', '4' => '数据库', '5' => '用户'
                        , '6' => '高级', '7' => '上传'],
                    'label'=>'所属分组'
                ])
                ->add('key', 'text',[
                    'label'=>'配置名',

                ])
                ->add('value', 'text',['label'=>'配置值'])
                ->add('description', 'text',['label'=>'配置描述'])
                ->add('status', 'select',[
                    'choices' => ['0' => '正常', '1' => '锁定'],
                    'label'=>'状态'
                ])
                ->add('submit', 'submit', [
                    'attr' => ['class'=>'btn btn-info'],
                    'label' => '保存'
                ]);
        }


    }
}
