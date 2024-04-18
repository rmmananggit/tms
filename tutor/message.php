<?php
include("./include/authentication.php");
include("./include/header.php");
include("./include/topbar.php");
include("./include/sidebar.php");

// Check if student_id is provided in the URL
if(isset($_GET['id'])) {
    $student_id = $_GET['id'];
} else {
    // If student_id is not provided, handle the error or redirect to another page
    // For demonstration, let's redirect to an error page
    header("Location: error.php");
    exit;
}
?>
<style>
    /* Style for chat messages */
.chat-message {
    margin-bottom: 10px;
    padding: 10px;
    border-radius: 8px;
    max-width: 70%;
}

/* Style for sent messages (right side) */
.sent-message {
    background-color: #007bff;
    color: white;
    align-self: flex-end;
}

/* Style for received messages (left side) */
.received-message {
    background-color: #f0f0f0;
    color: black;
    align-self: flex-start;
}

</style>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Chat System</div>
                <div class="card-body chat-container">
                    <ul class="chat-list" id="chatList"></ul>
                </div>
                <div class="card-footer">
                    <form id="messageForm">
                        <div class="input-group">
                            <input type="text" class="form-control" id="messageInput" placeholder="Type your message...">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary">Send</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script>
$(document).ready(function(){
    // Function to append a message to the chat list with appropriate style
    function appendMessage(message, isSent) {
        var messageClass = isSent ? 'sent-message' : 'received-message';
        var listItem = $('<li>').addClass('chat-message ' + messageClass).text(message);
        $('#chatList').append(listItem);
    }

    // Load chat messages
    function loadMessages() {
        $.ajax({
            url: 'get_messages.php',
            type: 'GET',
            data: { student_id: <?php echo $student_id; ?> },
            dataType: 'json',
            success: function(response) {
                // Clear previous messages
                $('#chatList').empty();

                // Append each message to the chat list with appropriate style
                response.forEach(function(message) {
                    appendMessage(message, false); // For received messages
                });
            },
            error: function(xhr, status, error) {
                console.error('Error loading messages: ' + xhr.responseText);
            }
        });
    }

    // Initial load
    loadMessages();

    // Submit message
    $('#messageForm').submit(function(e) {
        e.preventDefault();
        var message = $('#messageInput').val();
        $.ajax({
            url: 'send_message.php',
            type: 'POST',
            data: { message: message, student_id: <?php echo $student_id; ?> },
            success: function(response) {           
                $('#messageInput').val('');
                appendMessage(message, true); // For sent messages
            },
            error: function(xhr, status, error) {
                console.error('Error sending message: ' + xhr.responseText);
            }
        }); 
    });
});

</script>

<?php
include('./include/footer.php');
?>
