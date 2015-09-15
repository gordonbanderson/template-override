<?php
/*
Template override extension for the model
1) Adds an AlternativeTemplate field
2) Ability to edit that
*/
class TemplateOverrideExtension extends DataExtension {

	private static $db = array('AlternativeTemplate' => 'Varchar');


	public function updateCMSFields(FieldList $fields) {
		$templatei18n = _t('TemplateOverride.TEMPLATE', 'Template');
		$fields->addFieldToTab( 'Root.'.$templatei18n, new TextField( 'AlternativeTemplate',
				_t('TemplateOverride.ALTERNATIVE_TEMPLATE_NAME', 'Alternative template name') ) );

		$info_field = new LiteralField(
			$name = 'infofield',
			$content = '<p class="message">'._t('TemplateOverride.INFO', 'If you wish to change'.
						' the default template, type the name of the template here.  Otherwise '.
						' the normal default template will be used.  Normally this will not '.
						' require changing.').'</p>'
		);

		$fields->addFieldToTab( 'Root.'.$templatei18n, $info_field );
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
