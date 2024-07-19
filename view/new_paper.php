<div class="add-paper">
    <h1>Add Paper</h1>
    <form action="process_add_paper.php" method="POST">
        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title" required><br><br>

        <label for="abstract">abstract:</label><br>
        <textarea id="abstract" name="abstract" rows="4" required></textarea><br><br>

        <label for="topic">Topic:</label><br>
        <select id="topic" name="topic" required>
            <option value="topic1">Topic</option>
            <option value="topic2">Topic 1</option>
            <option value="topic3">Topic 2</option>
            <!-- Populate options dynamically from database if needed -->
        </select><br><br>

        <label for="conference">Conference:</label><br>
        <select id="conference" name="conference" required>
            <option value="conf1">Conference</option>
            <option value="conf2">conference 1</option>
            <option value="conf3">conference 2</option>
            <!-- Populate options dynamically from database if needed -->
        </select><br><br>

        <div id="participants">
            <label>Participants:</label>
            <div class="participant">
                <input type="text" name="participant[]" placeholder="Name member" required>
                <select name="role[]" required>
                    <option value="author">Fist member</option>
                    <option value="contributor">Member</option>
                </select>
                <button type="button" onclick="removeParticipant(this)">Remove</button>
            </div>
        </div>
        <button id="button-participation" type="button" onclick="addParticipant()">Add member</button><br><br>
        <button type="submit">Add Paper</button>
    </form>
</div>

<script>
    // Hàm để thêm một thành viên mới
    function addParticipant() {
        var participantsDiv = document.getElementById('participants');

        // Tạo một div mới để chứa các thành phần của thành viên
        var newParticipantDiv = document.createElement('div');
        newParticipantDiv.classList.add('participant');

        // Input tên thành viên
        var nameInput = document.createElement('input');
        nameInput.type = 'text';
        nameInput.name = 'participant[]';
        nameInput.placeholder = 'Name member';
        nameInput.required = true;
        newParticipantDiv.appendChild(nameInput);

        // Select vai trò
        var roleSelect = document.createElement('select');
        roleSelect.name = 'role[]';
        roleSelect.required = true;

        // Option cho vai trò
        var authorOption = document.createElement('option');
        authorOption.value = 'author';
        authorOption.textContent = 'Tác giả';
        roleSelect.appendChild(authorOption);

        var contributorOption = document.createElement('option');
        contributorOption.value = 'contributor';
        contributorOption.textContent = 'Đóng góp viên';
        roleSelect.appendChild(contributorOption);

        newParticipantDiv.appendChild(roleSelect);

        // Button Xóa
        var removeButton = document.createElement('button');
        removeButton.type = 'button';
        removeButton.textContent = 'Xóa';
        removeButton.onclick = function () {
            participantsDiv.removeChild(newParticipantDiv);
        };
        newParticipantDiv.appendChild(removeButton);

        // Thêm div của thành viên mới vào phần tử cha
        participantsDiv.appendChild(newParticipantDiv);
    }

    // Hàm để xóa một thành viên
    function removeParticipant(button) {
        var participantDiv = button.parentNode;
        var participantsDiv = participantDiv.parentNode;
        participantsDiv.removeChild(participantDiv);
    }
</script>