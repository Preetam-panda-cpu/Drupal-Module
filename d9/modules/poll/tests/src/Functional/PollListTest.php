<?php

namespace Drupal\Tests\poll\Functional;

/**
 * Tests the poll list.
 *
 * @group poll
 */
class PollListTest extends PollTestBase {

  /**
   * Test if a list of polls is displayed properly.
   */
  public function testViewListPolls() {
    $poll = $this->poll;
    $poll2 = $this->pollCreate();

    // Check that both polls appears in the list of polls.
    $this->drupalLogin($this->web_user);

    $this->drupalGet('admin/content/poll');
    $this->assertSession()->statusCodeEquals(403);

    $this->drupalGet('polls');
    $this->assertSession()->pageTextContains($poll->label());
    $this->assertSession()->pageTextContains($poll2->label());

    // Check to see if the vote was recorded.
    $edit = array('choice' => $this->getChoiceId($poll, 1));
    $this->submitForm($edit, t('Vote'), 'poll-view-form-1');
    $this->assertSession()->pageTextContains('Your vote has been recorded.');

    // Check overview list with "access poll overview" permission
    $account = $this->drupalCreateUser([
      'access poll overview',
    ]);
    $this->drupalLogin($account);
    $this->drupalGet('admin/content/poll');
    $this->assertSession()->statusCodeEquals(200);
  }

}
