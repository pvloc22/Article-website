<?php foreach ($data as $topic): ?>
    <div class="topic">
        <h2><?php echo $topic->topic ?> </h2>
        <div class="items">
            <?php foreach ($topic->papers as $paper): ?>
                <a href="index.php?action=detail-item&paper-id=<?php echo $paper->paperId?>" class="item-link">
                    <div class="item">
                        <h3><?php echo $paper->title; ?></h3>
                        <div class="space-content">
                            <div class="space-content-author-name">
                                <p><span class="solid">Authors: </span><span class="detail-content"><?php echo $paper->listAuthor; ?></span></p>
                            </div>
                            <div class="space-content-conference-name">
                                <p><span class="solid">Conference: </span><span class="detail-content"><?php echo $paper->conference; ?></span></p>
                            </div>
                            <div class="space-content-abstract">
                                <p><span class="solid">Abstract: </span><span class="detail-content"><?php echo $paper->abstract; ?></span></p>
                            </div>
                        </div>
                        <p class="date"><?php echo $paper->dateAdded ?></p>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
        <div class="Pagination">
            <!-- <a href=""><span>Trang 1</span></a>
            <a href="">Trang 2</a> -->
        </div>
    </div>
<?php endforeach; ?>
