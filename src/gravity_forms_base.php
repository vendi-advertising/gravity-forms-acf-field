<?php

abstract class gravity_forms_base extends acf_field {

    /*
    *  format_value()
    *
    *  This filter is applied to the $value after it is loaded from the db and before it is returned to the template
    *
    *  @type  filter
    *  @since 3.6
    *  @date  23/01/13
    *
    *  @param $value (mixed) the value which was loaded from the database
    *  @param $post_id (mixed) the $post_id from which the value was loaded
    *  @param $field (array) the field array holding all the field options
    *
    *  @return  $value (mixed) the modified value
    */

    protected function _format_value( $value, $post_id, $field ) {

        //Return false if value is false, null or empty
        if( !$value || empty($value) ){
            return false;
        }

        //If there are multiple forms, construct and return an array of form objects
        if( is_array($value) && !empty($value) ){

            $form_objects = array();
            foreach($value as $k => $v){
              $form = GFAPI::get_form( $v );
              //Add it if it's not an error object
              if( !is_wp_error($form) ){
                  $form_objects[$k] = $form;
              }
            }
            //Return false if the array is empty
            if( !empty($form_objects) ){
                return $form_objects;
            }else{
                return false;
            }


        //Else return single form object
        }else{

            $form = GFAPI::get_form(intval($value));
            //Return the form object if it's not an error object. Otherwise return false.
            if( !is_wp_error($form) ){
                return $form;
            }else{
                return false;
            }

        }

    }
}
