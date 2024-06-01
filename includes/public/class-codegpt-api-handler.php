<?php
/**
 * CodeGPT API Handler class
 */
class CodeGPT_API_Handler {
    /**
     * CodeGPT API instance
     *
     * @var CodeGPT_API
     */
    private $codegpt_api;

    /**
     * Constructor
     *
     * @param CodeGPT_API $codegpt_api CodeGPT API instance.
     */
    public function __construct( $codegpt_api ) {
        $this->codegpt_api = $codegpt_api;
    }

    /**
     * Generate code snippet based on description
     *
     * @param string $description Code description.
     * @return string|WP_Error Generated code snippet or error object.
     */
    public function generate_code_snippet( $description ) {
        $response = $this->codegpt_api->generate_code( $description );

        if ( is_wp_error( $response ) ) {
            return $response;
        }

        return $response['code'];
    }

    /**
     * Complete code based on code fragment and description
     *
     * @param string $code_fragment Existing code fragment.
     * @param string $description   Code completion description.
     * @return string|WP_Error Completed code or error object.
     */
    public function complete_code( $code_fragment, $description ) {
        $response = $this->codegpt_api->complete_code( $code_fragment, $description );

        if ( is_wp_error( $response ) ) {
            return $response;
        }

        return $response['code'];
    }
}