<?php

class TemplateOverrideExtensionTest extends SapphireTest
{
    protected static $fixture_file = 'template-override/tests/pages.yml';

    public function testUpdateCMSFields()
    {
        $page = $this->objFromFixture('Page', 'page1');
        $fields = $page->getCMSFields();
        $tab = $fields->findOrMakeTab('Root.Template');
        $fields = $tab->FieldList();
        $names = array();
        foreach ($fields as $field) {
            $names[] = $field->getName();
        }
        $expected = array('AlternativeTemplate', 'infofield');
        $this->assertEquals($expected, $names);
    }
}
