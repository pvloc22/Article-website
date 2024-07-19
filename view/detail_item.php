<div class="container-article-details">
    <div class="article-details">
        <h2><?php echo $datapaper["title"] ?></h2>
        <p><strong>Abstract: </strong> <?php echo $datapaper["abstract"] ?></p>
        <p><strong>Topic: </strong> <?php echo $datapaper["topic_name"] ?></p>
        <p><strong>Conference Name: </strong><?php echo $datapaper["name"] ?></p>
        <p><strong>Rank: </strong><?php echo $datapaper["rank"] ?></p>
    </div>
</div>
<table class="members-table">
    <thead>
        <tr>
            <th>Member Name</th>
            <th>Role</th>
            <th>Date Joined</th>
            <?php if (isset($_SESSION['user_type'])&&$_SESSION['user_type'] == "admin"): ?>
                <th>Action</th>
            <?php endif; ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($dataAuthor as $author): ?>
            <tr>
                <td><?php echo $author->full_name ?></td>
                <td><?php echo $author->role ?></td>
                <td><?php echo $author->dateJoind ?></td>
                <?php if (isset($_SESSION['user_type']) &&$_SESSION['user_type'] == "admin"): ?>
                    <td><button onclick="deleteMember(<?php echo $author->id ?>)">Delete</button></td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php if ($is_logged_in): ?>
    <div class="add-member">
        <button onclick="addMember()">Add Me as a Member</button>
    </div>
<?php endif; ?>

<script>
function addMember() {
    // Logic to add the current user as a member
    console.log('Adding member...');
}

function deleteMember(memberId) {
    if (confirm("Are you sure you want to delete this member?")) {
        // Logic to delete the member
        console.log('Deleting member with ID:', memberId);
        // You can make an AJAX call here to delete the member from the database
    }
}
</script>
