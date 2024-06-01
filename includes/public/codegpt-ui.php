<?php
/**
 * CodeGPT UI functions
 */

/**
 * Render the CodeGPT code generation form
 */
function codegpt_render_code_generation_form() {
    ?>
    <form id="codegpt-code-generation-form" method="post">
        <label for="codegpt-code-description">Code Description:</label>
        <textarea id="codegpt-code-description" name="codegpt-code-description" rows="4"></textarea>
        <button type="submit">Generate Code</button>
    </form>
    <?php
}

/**
 * Render the CodeGPT code completion form
 */
function codegpt_render_code_completion_form() {
    ?>
    <form id="codegpt-code-completion-form" method="post">
        <label for="codegpt-code-fragment">Existing Code Fragment:</label>
        <textarea id="codegpt-code-fragment" name="codegpt-code-fragment" rows="6"></textarea>
        <label for="codegpt-code-completion-description">Code Completion Description:</label>
        <textarea id="codegpt-code-completion-description" name="codegpt-code-completion-description" rows="4"></textarea>
        <button type="submit">Complete Code</button>
    </form>
    <?php
}

/**
 * Handle form submissions and display results
 */
function codegpt_handle_form_submissions() {
    if ( isset( $_POST['codegpt-code-description'] ) ) {
        $description = sanitize_textarea_field( $_POST['codegpt-code-description'] );
        $code_snippet = codegpt_generate_code_snippet( $description );
        codegpt_display_code_result( $code_snippet );
    } elseif ( isset( $_POST['codegpt-code-fragment'], $_POST['codegpt-code-completion-description'] ) ) {
        $code_fragment = sanitize_textarea_field( $_POST['codegpt-code-fragment'] );
        $description = sanitize_textarea_field( $_POST['codegpt-code-completion-description'] );
        $completed_code = codegpt_complete_code( $code_fragment, $description );
        codegpt_display_code_result( $completed_code );
    }
}

/**
 * Display the generated or completed code
 *
 * @param string $code The code to display.
 */
function codegpt_display_code_result( $code ) {
    if ( is_wp_error( $code ) ) {
        echo '<div class="codegpt-error">' . $code->get_error_message() . '</div>';
    } else {
        ?>
        <div class="codegpt-code-result">
            <pre><code><?php echo esc_html( $code ); ?></code></pre>
        </div>
        <?php
    }
}

/**
 * Generate code snippet using the CodeGPT API
 *
 * @param string $description Code description.
 * @return string|WP_Error Generated code snippet or error object.
 */
function codegpt_generate_code_snippet( $description ) {
    $codegpt_clone = CodeGPT_Clone::get_instance();
    $codegpt_api_handler = $codegpt_clone->get_codegpt_api_handler();

    return $codegpt_api_handler->generate_code_snippet( $description );
}

/**
 * Complete code using the CodeGPT API
 *
 * @param string $code_fragment Existing code fragment.
 * @param string $description   Code completion description.
 * @return string|WP_Error Completed code or error object.
 */
function codegpt_complete_code( $code_fragment, $description ) {
    $codegpt_clone = CodeGPT_Clone::get_instance();
    $codegpt_api_handler = $codegpt_clone->get_codegpt_api_handler();

    return $codegpt_api_handler->complete_code( $code_fragment, $description );
}