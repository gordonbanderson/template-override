<?php


/*
Template override extension for the model
1) Adds an AlternativeTemplate field
2) Ability to edit that
*/
class TemplateOverrideExtension extends DataObjectDecorator {

  function extraStatics() { 
    return array( 'db'=>array('AlternativeTemplate' => 'Varchar' ));
  }


  public function updateCMSFields( FieldSet &$fields ) {
    $fields->addFieldToTab( "Root.Content.Template", new TextField( 'AlternativeTemplate', 'Alternative Template Name' ) );

    $info_field = new LiteralField(
      $name = 'infofield',
      $content = '<p>If you wish to change the default template, type the name of the template here.
          Otherwise the normal default template will be used</p>
          '
    );

    $fields->addFieldToTab( 'Root.Content.Template', $info_field );
  }



}



class PageControllerTemplateOverrideExtension extends Extension {

  /*
  If the alternative template exists, render that, otherwise render with the default template
  */
  function index() {
    $template = $this->owner->AlternativeTemplate;
    if ( isset($template) && $template != '' ) {
      return $this->owner->renderWith( array( $this->owner->AlternativeTemplate, 'Page' ) );
    } else {
      return array();
    }
  }
}
?>
