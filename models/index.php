<?php

/**
 * This is the default model class for our theme.
 */
class Index extends MiddleModel {

    /**
     * This returns the page set for frontpage.
     *
     * @return array|null|WP_Post
     */
    public function Page() {
        return get_post( get_the_ID() );
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
     * Fetch 10 most recent posts.
     *
     * @return WP_Query
     */
    public function Query() {
        return $this->get_all_events();
    }
}