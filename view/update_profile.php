<div class="profile-form">
    <h1>Chỉnh sửa thông tin cá nhân</h1>
    <form id="profileForm" action="index.php?action=update-profile" method="POST" enctype="multipart/form-data">
        <label for="name">Họ và tên:</label><br>
        <input type="text" id="name" name="name" value="<?php echo $_SESSION["full_name"] ?>" required><br><br>

        <label for="name">Email:</label><br>
        <input type="email" id="email" name="email" value="<?php echo $_SESSION["email"] ?>" required><br><br>


        <label for="bio">Tiểu sử:</label><br>
        <textarea id="bio" name="bio" rows="4"><?php echo $_SESSION['bio'] ?></textarea><br><br>

        <label for="interests">Hướng nguyên cứu (phân cách bằng dấu phẩy):</label><br>
        <input type="text" id="interests" name="interests" value="<?php echo $_SESSION["interests"] ?>"><br><br>

        <label for="profile_image">Ảnh đại diện:</label><br>
        <input type="file" id="profile_image" name="uploaded_file"><br><br>

        <input type="hidden" id="profile_json" name="profile_json">
        <button type="submit" name="btnUpload">Lưu thông tin</button>
    </form>
</div>

<script>
    document.getElementById('profileForm').onsubmit = function () {
        var bio = document.getElementById('bio').value;
        var interests = document.getElementById('interests').value.split(',').map(function (item) {
            return item.trim();
        });

        var profileJson = {
            bio: bio,
            interests: interests
        };

        document.getElementById('profile_json').value = JSON.stringify(profileJson);
    };
</script>
