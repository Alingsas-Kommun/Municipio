<?php

namespace Municipio\PostObject\Decorators;

use Municipio\PostObject\PostObject;
use Municipio\TestUtils\WpMockFactory;
use PHPUnit\Framework\TestCase;
use WpService\Implementations\FakeWpService;

class PostObjectFromWpPostTest extends TestCase
{
    /**
     * @testdox Get comment count returns amount of comments
     */
    public function testGetCommentCountReturnsAmountOfComments()
    {
        $wpService = new FakeWpService(['getCommentCount' => ['approved' => 2]]);
        $wpPost    = WpMockFactory::createWpPost(['ID' => 1]);

        $instance = new PostObjectFromWpPost(new PostObject(new FakeWpService()), $wpPost, $wpService);

        $result = $instance->getCommentCount();

        $this->assertEquals(2, $result);
    }

    /**
     * @testdox getPermalink() returns permalink
     */
    public function testGetPermalinkReturnsPermalink()
    {
        $wpService = new FakeWpService(['getPermalink' => 'http://example.com']);
        $wpPost    = WpMockFactory::createWpPost(['ID' => 1]);

        $instance = new PostObjectFromWpPost(new PostObject(new FakeWpService()), $wpPost, $wpService);

        $result = $instance->getPermalink();

        $this->assertEquals('http://example.com', $result);
    }

    /**
     * @testdox getTitle() returns title
     */
    public function testGetTitleReturnsTitle()
    {
        $wpPost   = WpMockFactory::createWpPost(['post_title' => 'Title']);
        $instance = new PostObjectFromWpPost(new PostObject(new FakeWpService()), $wpPost, new FakeWpService());

        $this->assertEquals('Title', $instance->getTitle());
    }

    /**
     * @testdox getPostType returns post type
     */
    public function testGetPostTypeReturnsPostType()
    {
        $wpPost   = WpMockFactory::createWpPost(['post_type' => 'post']);
        $instance = new PostObjectFromWpPost(new PostObject(new FakeWpService()), $wpPost, new FakeWpService());

        $this->assertEquals('post', $instance->getPostType());
    }

    /**
     * @testdox getPublishedTime returns timestamp from the WP_Post->post_date
     */
    public function testGetPublishedTimeReturnsTimestampFromTheWpPostPostDate()
    {
        $dateTimeString = date('Y-m-d H:i:s', $now = time());
        $wpPost         = WpMockFactory::createWpPost(['post_date' => $dateTimeString]);
        $instance       = new PostObjectFromWpPost(new PostObject(new FakeWpService()), $wpPost, new FakeWpService());

        $this->assertEquals($now, $instance->getPublishedTime());
    }

    /**
     * @testdox getPublishedTime returns gmt timestamp from the WP_Post->post_date_gmt
     */
    public function testGetPublishedTimeReturnsGmtTimestampFromTheWpPostPostDateGmt()
    {
        $dateTimeString = date('Y-m-d H:i:s', $now = time());
        $wpPost         = WpMockFactory::createWpPost(['post_date_gmt' => $dateTimeString]);
        $instance       = new PostObjectFromWpPost(new PostObject(new FakeWpService()), $wpPost, new FakeWpService());

        $this->assertEquals($now, $instance->getPublishedTime(true));
    }

    /**
     * @testdox getModifiedTime returns timestamp from the WP_Post->post_modified
     */
    public function testGetModifiedTimeReturnsTimestampFromTheWpPostPostModified()
    {
        $dateTimeString = date('Y-m-d H:i:s', $now = time());
        $wpPost         = WpMockFactory::createWpPost(['post_modified' => $dateTimeString]);
        $instance       = new PostObjectFromWpPost(new PostObject(new FakeWpService()), $wpPost, new FakeWpService());

        $this->assertEquals($now, $instance->getModifiedTime());
    }

    /**
     * @testdox getModifiedTime returns gmt timestamp from the WP_Post->post_modified_gmt
     */
    public function testGetModifiedTimeReturnsGmtTimestampFromTheWpPostPostModifiedGmt()
    {
        $dateTimeString = date('Y-m-d H:i:s', $now = time());
        $wpPost         = WpMockFactory::createWpPost(['post_modified_gmt' => $dateTimeString]);
        $instance       = new PostObjectFromWpPost(new PostObject(new FakeWpService()), $wpPost, new FakeWpService());

        $this->assertEquals($now, $instance->getModifiedTime(true));
    }
}
