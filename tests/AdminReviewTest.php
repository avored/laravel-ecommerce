<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AdminReviewTest extends TestCase {

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAdminReviewList() {
        $this->adminUserLogin();
        $this->visit('/admin/review')->see('Review List')
        ;
    }

  

    /**
     * A basic test example.
     *
     * @return void
     
    public function testAdminReviewEdit() {
        $this->reviewLogin();
        $review = Auth::guard('admin')->user();
        $this->route('GET', 'admin.review.edit', $review->id);
        $this->seeInField('email', $review->email);
    }

    /**
     * A basic test example.
     *
     * @return void
   
    public function testAdminReviewUpdate() {
        $this->reviewLogin();
        $review = Auth::guard('admin')->user();
        $data = ['first_name' => 'new updated first name', 'last_name' => 'new updated last name'];
        $this->route('PUT', 'admin.review.update', $review->id, $data);
        $this->seeInDatabase('admin_users', $data);
    }

    public function testAdminReviewDestroy() {
        $this->reviewLogin();

        $review = $this->_creteAdminReview();
        $this->route('DELETE', 'admin.review.destroy', $review->id);
        $this->dontSeeInDatabase('admin_users', ['id' => $review->id]);
    }

    private function _creteAdminReview() {
        return AdminReview::create([
                    'first_name' => str_random(6),
                    'last_name' => str_random(6),
                    'email' => str_random(6) . "@gmail.com",
                    'password' => 'admin123',
                    'password_confirmation' => 'admin123',
                    'role_id' => 1,
        ]);
    }
     * 
     */

}
