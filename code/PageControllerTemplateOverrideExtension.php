<?php

class PageControllerTemplateOverrideExtension extends Extension {

	/*
	If the alternative template exists, render that, otherwise render with the default template
	*/
	public function index() {
		return $this->useTemplateOverride();
	}

	/**
	 * Render this page using the template override iff it exists
	 * @return array An array suitable for SilverStripe to use the correct template
	 */
	public function useTemplateOverride($data = null) {
		$template = $this->owner->AlternativeTemplate;
		if (isset($template) && $template != '') {
			if ($data) {
				return $this->owner->customise(new ArrayData($data))
						->renderWith(array($this->owner->AlternativeTemplate, $this->owner->ClassName, 'Page'));
			} else {
				return $this->owner->renderWith(array($this->owner->AlternativeTemplate, $this->owner->ClassName, 'Page'));
			}

		} else {
			if ($data) {
				return $data;
			} else {
				return array();
			}

		}
	}
}
