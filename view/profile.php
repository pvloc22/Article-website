<div class="profile">
    <div class="profile-author">
        <div class="image-item">
            <img src="<?php echo $_SESSION['image_path']; ?>" alt="" style="width: 300px; height: 300px;border-radius: 20px ;">
        </div>
        <div class="information">
            <div class="part-information">
                <p><span class="solid">Full name: </span>
                    <?php echo $data_info->full_name; ?>
                </p>
                <p><span class="solid">Email: </span>
                    <?php echo $_SESSION['email']; ?>
                </p>
                <p><span class="solid">Tiểu sử: </span>
                    <?php echo $data_info->profile_json_text->bio ?>
                </p>
                <p><span class="solid">Hướng nguyên cứu quan tâm: </span>
                    <?php echo implode(', ', $data_info->profile_json_text->interests) ?>
                </p>
            </div>
            <a href="index.php?action=page-update-profile"><input type="button" value="Update"></a>
        </div>
    </div>

    <h2>Những bài báo từng tham gia</h2>
    <div class="items">
        <div class="items">
            <?php foreach ($data as $paper): ?>
                <a href="index.php?action=detail-item" class="item-link">
                    <div class="item">
                        <h3><?php echo $paper->title; ?></h3>
                        <div class="space-content">
                            <div class="space-content-author-name">
                                <p><span class="solid">Authors: </span><span
                                        class="detail-content"><?php echo $paper->listAuthor; ?></span></p>
                            </div>
                            <div class="space-content-conference-name">
                                <p><span class="solid">Conference: </span><span
                                        class="detail-content"><?php echo $paper->conference; ?></span></p>
                            </div>
                            <div class="space-content-abstract">
                                <p><span class="solid">Abstract: </span><span
                                        class="detail-content"><?php echo $paper->abstract; ?></span></p>
                            </div>
                        </div>
                        <p class="date"><?php echo $paper->dateAdded ?></p>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>
