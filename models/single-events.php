<?php // Single event page

use DustPress\Query;

class SingleEvents extends MiddleModel {

    /**
     * Content
     *
     * @return array|object|WP_Post|null
     * @throws Exception If global $post is not available or $id param is not defined.
     */
    public function content() {
        $single = Query::get_acf_post( get_the_ID() );

        return $single;
    }
}