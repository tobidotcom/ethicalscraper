(function($) {
    'use strict';

    $(function() {
        // Handle chat form submission
        $('#codegpt-chat-form').submit(function(e) {
            e.preventDefault();
            var prompt = $('#codegpt-chat-input').val();
            sendPromptToAI(prompt);
        });

        // Function to send prompt to AI and receive response
        function sendPromptToAI(prompt) {
            var data = {
                action: 'codegpt_send_prompt',
                prompt: prompt
            };

            $.post(codegpt_ajax_object.ajax_url, data, function(response) {
                if (response.success) {
                    displayChatResponse(prompt, response.data.response);
                } else {
                    displayError(response.data.error);
                }
            });
        }

        // Function to display chat response
        function displayChatResponse(prompt, response) {
            var chatOutput = $('#codegpt-chat-output');
            var promptHtml = '<div class="codegpt-chat-message codegpt-chat-prompt"><strong>You:</strong> ' + prompt + '</div>';
            var responseHtml = '<div class="codegpt-chat-message codegpt-chat-response"><strong>AI:</strong> ' + response + '</div>';
            chatOutput.append(promptHtml);
            chatOutput.append(responseHtml);
            $('#codegpt-chat-input').val('');
        }

        // Function to display error message
        function displayError(error) {
            $('#codegpt-error').text(error);
        }
    });
})(jQuery);