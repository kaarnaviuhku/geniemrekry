<?php
/**
 * Template Name: Events Page
 *
 * This template needs a page to function!
 */

class PageEvents extends MiddleModel {

    /**
     * This returns the page set for frontpage.
     *
     * @return array|null|WP_Post
     */
    public function Page() {

        $page = get_post( get_the_ID() );

        return $page;
    }

    /**
     * This returns the featured image.
     *
     * @return array|null|WP_Post
     */
    public function FeaturedImage() {

        $featured_image = get_post_thumbnail_id( get_the_ID() );

        return $featured_image;
    }

    /**
     * Fetch all Events.
     *
     * @return WP_Query
     */
    public function AllEvents() {
        return $this->get_all_events();
    }

    /**
     * Fetch future Events.
     *
     * @return WP_Query
     */
    public function FutureEvents() {
        return $this->get_future_events();
    }
}