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

    /**
     * Excerpt
     *
     * @return array|object|WP_Post|null
     * @throws Exception If global $post is not available or $id param is not defined.
     */
    public function excerpt() {
        $string = strip_tags( get_the_content( get_the_ID() ) );
        $length = 30;

        if (strlen($string) > $length) {
            $cut = substr( $string, 0, $length );
            $string = substr( $cut, 0, strrpos( $cut, ' ' ) ) . '...';
        }
        return $string;
    }
}