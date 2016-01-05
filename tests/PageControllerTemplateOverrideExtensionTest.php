<?php

class PageControllerTemplateOverrideExtensionTest extends FunctionalTest
{
    protected static $fixture_file = 'template-override/tests/pages.yml';

    public function testLayoutTemplateOveride()
    {
        $this->logInWithPermission('ADMIN');
        $page = $this->objFromFixture('Page', 'page1');
        $page->AlternativeTemplate = 'PageInnerTest';
        $page->write();
        $page->doPublish();
        $response = $this->get('/'.$page->URLSegment);
        $this->assertEquals(200, $response->getStatusCode());

        // assert the the inner layout template has been used
        $this->assertExactMatchBySelector('div.marker', array(
            'INNER LAYOUT',
        ));
    }

    public function testOuterTemplateOveride()
    {
        $this->logInWithPermission('ADMIN');
        $page = $this->objFromFixture('Page', 'page1');
        $page->AlternativeTemplate = 'PageOuterTest';
        $page->write();
        $page->doPublish();
        $response = $this->get('/'.$page->URLSegment);
        $this->assertEquals(200, $response->getStatusCode());

        // show the the outer layout template has been used
        $this->assertExactMatchBySelector('div.marker', array(
            'OUTER OF LAYOUT',
        ));
    }

    public function testNoTemplateOverride()
    {
        $this->logInWithPermission('ADMIN');
        $page = $this->objFromFixture('Page', 'page1');
        $page->AlternativeTemplate = null;
        $page->write();
        $page->doPublish();
        $response = $this->get('/'.$page->URLSegment);
        $this->assertEquals(200, $response->getStatusCode());
        $body = $response->getBody();
        $this->assertNotContains('OUTER OF LAYOUT', $body);
        $this->assertNotContains('INNER LAYOUT', $body);
    }
}
