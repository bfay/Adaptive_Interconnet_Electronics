<?php
/**
 *
 * $HeadURL: https://www.onthegosystems.com/misc_svn/common/trunk/toolset-forms/classes/class.radios.php $
 * $LastChangedDate: 2014-08-14 15:35:38 +0800 (Thu, 14 Aug 2014) $
 * $LastChangedRevision: 25961 $
 * $LastChangedBy: francesco $
 *
 */
require_once 'class.field_factory.php';

/**
 * Description of class
 *
 * @author Srdjan
 */
class WPToolset_Field_Radios extends FieldFactory
{

    public function metaform()
    {
        $value = $this->getValue();
        $data = $this->getData();
        $name = $this->getName();
        $form = array();
        $options = array();
        foreach ( $data['options'] as $option ) {
            $one_option_data = array(
                '#value' => $option['value'],
                '#title' => $option['title'],
                '#validate' => $this->getValidationData()
            );
			if ( !is_admin() ) {// TODO maybe add a doing_ajax() check too, what if we want to load a form using AJAX?
				$one_option_data['#before'] = '<li class="wpt-form-item wpt-form-item-radio">';
				$one_option_data['#after'] = '</li>';
				$one_option_data['#pattern'] = '<BEFORE><PREFIX><ELEMENT><LABEL><ERROR><SUFFIX><DESCRIPTION><AFTER>';
			}
            /**
             * add default value if needed
             * issue: frontend, multiforms CRED
             */
            if ( array_key_exists( 'types-value', $option ) ) {
                $one_option_data['#types-value'] = $option['types-value'];
            }
            /**
             * add to options array
             */
            $options[] = $one_option_data;
        }
        $options = apply_filters( 'wpt_field_options', $options, $this->getTitle(), 'select' );
        /**
         * default_value
         */
        if ( !empty( $value ) || $value == '0' ) {
            $data['default_value'] = $value;
        }
        /**
         * metaform
         */
        $form_attr = array(
            '#type' => 'radios',
            '#title' => $this->getTitle(),
            '#description' => $this->getDescription(),
            '#name' => $name,
            '#options' => $options,
            '#default_value' => isset( $data['default_value'] ) ? $data['default_value'] : false,
            '#repetitive' => $this->isRepetitive(),
            '#validate' => $this->getValidationData(),
        );
		
        if ( !is_admin() ) {// TODO maybe add a doing_ajax() check too, what if we want to load a form using AJAX?
                $form_attr['#before'] = '<ul class="wpt-form-set wpt-form-set-radios wpt-form-set-radios-' . $name . '">';
                $form_attr['#after'] = '</ul>';
        }
		
        $form[] = $form_attr;

        return $form;
    }

}
