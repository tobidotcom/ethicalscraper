<?php
/**
 * Provide an admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://example.com
 * @since      1.0.0
 *
 * @package    Codegpt_Clone
 * @subpackage Codegpt_Clone/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
    <div id="codegpt-chat-container">
        <div id="codegpt-chat-form">
            <h3>Chat with AI</h3>
            <input type="text" id="codegpt-chat-input" placeholder="Enter your prompt or query">
            <button id="codegpt-send-prompt">Send</button>
        </div>
        <div id="codegpt-chat-output"></div>
    </div>
    <div id="codegpt-error" class="codegpt-error"></div>
</div>