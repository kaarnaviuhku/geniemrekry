<?php
/**
 * A middle model is used to wrap redundant data binding.
 */

/**
 * Class MiddleModel
 */
class MiddleModel extends \DustPress\Model {

    /**
     * Binds submodules for all extending classes.
     */
    public function Submodules() {
        $this->bind_sub( 'Header' );
        $this->bind_sub( 'Footer' );
    }

    /**
     * A wrapper function for querying all events.
     *
     * @param int $page     The page we are on.
     * @param int $per_page How many events to query.
     *
     * @return array|bool|WP_Query
     */
    protected function get_all_events( $page = 0, $per_page = 0 ) {

        $args = [
            'post_type'                 => 'events',
            'posts_per_page'            => -1,
            'update_post_meta_cache'    => false,
            'update_post_term_cache'    => false,
            'no_found_rows'             => false,
            'query_object'              => true,
            'meta_key'			        => 'event_starts',
            'orderby'                   => 'meta_value',
            'order'                     => 'ASC',
        ];

        // Use the Query class to get extended data for all posts.
        return \DustPress\Query::get_acf_posts( $args );
    }

    /**
     * A wrapper function for querying future events.
     *
     * @param int $page     The page we are on.
     * @param int $per_page How many events to query.
     *
     * @return array|bool|WP_Query
     */
    protected function get_future_events( $page = 0, $per_page = 0 ) {

        $today = date('Ymd', time());

        $args = [
            'post_type'                 => 'events',
            'posts_per_page'            => -1,
            'update_post_meta_cache'    => false,
            'update_post_term_cache'    => false,
            'no_found_rows'             => false,
            'query_object'              => true,
            'meta_key'			        => 'event_starts',
            'orderby'                   => 'meta_value',
            'order'                     => 'ASC',
            'meta_query'	            => array(
                'relation'		=> 'OR',
                array(
                    'key'	 	=> 'event_starts',
                    'value'	  	=> $today,
                    'compare' 	=> '>=',
                    'type'      => 'DATETIME',
                ),
                array(
                    'key'	 	=> 'event_ends',
                    'value'	  	=> $today,
                    'compare' 	=> '>=',
                    'type'      => 'DATETIME',
                )
            ),
        ];

        // Use the Query class to get extended data for all posts.
        return \DustPress\Query::get_acf_posts( $args );
    }
}