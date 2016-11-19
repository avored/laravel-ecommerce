<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Mage2\Page\Models\Page;

class AdminPageTest extends TestCase
{

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAdminPageList() {
        $this->adminUserLogin();
        $this->visit('/admin/page')
            ->see('Page List')
        ;
    }
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAdminPageCreate() {
        $this->adminUserLogin();
        $pageTitle = str_random();
        $this->visit('/admin/page/create')
            ->see('Create Page')
            ->type($pageTitle,'title')
            ->type(str_slug($pageTitle),'slug')
            ->type('content page content', 'content')
            ->press('Create Page')
            ->seePageIs('/admin/page')
            ->see($pageTitle)
        ;
        //Delete created page
        Page::all()->last()->delete();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAdminPageEdit() {
        $this->adminUserLogin();


        $page = $this->_cretePage();


        $this->visit('/admin/page/' . $page->id. '/edit')
            ->see('Edit Page')
            ->seeInField('title',$page->title)
            ->type('xyz','title')
            ->press('')
        ;

        $this->_deletePage($page->id);
    }


    public function testAdminPageDestroy() {
        $this->adminUserLogin();

        $page = $this->_cretePage();
        $this->visit('/admin/page')
            ->see($page->title);
        $this->_deletePage($page->id);
    }

    private function _cretePage() {
        $title = str_random();
        $page = Page::create(['title' => $title,  'content' => 'some description','slug' => str_slug($title)]);
        return $page;
    }


    private function _deletePage($id) {
        Page::destroy($id);
    }


}
