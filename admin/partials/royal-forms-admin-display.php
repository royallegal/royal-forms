<div class="wrap">
    <h1 class="wp-heading-inline">IRA Quiz</h1>
    <a href="/wp-admin/admin.php?page=iraquiz-add" class="page-title-action">Add New</a>
    <hr class="wp-header-end">


    <table class="wp-list-table widefat fixed striped users">
    <thead>
    <tr>
        <td id="cb" class="manage-column" style="width: 50px;">ID</td>
        <th scope="col" class="manage-column">Quiz Name</th>
        <th scope="col" class="manage-column"># Questions</th>
        <th scope="col" class="manage-column">Createad At</th>
        <th scope="col" class="manage-column">Edit</th>
        <th scope="col" class="manage-column">Delete</th>
    </tr>
    </thead>

    <tbody id="the-list" data-wp-lists="list:user">
    <?php foreach ( $query as $result ) {
        $questions = json_decode($result->questions, true);
    ?>
    <tr>
        <td id="cb" class="manage-column"><?=$result->id;?></td>
        <th scope="col" class="manage-column"><?=$result->quiz_name;?></th>
        <th scope="col" class="manage-column"><?=count($questions);?></th>
        <th scope="col" class="manage-column"><?=$result->time;?></th>
        <th scope="col" class="manage-column">Edit</th>
        <th scope="col" class="manage-column">Delete</th>
    </tr>
    <?php } ?>
    </tbody>

    <tfoot>
    <tr>
        <td id="cb" class="manage-column" style="width: 50px;">ID</td>
        <th scope="col" class="manage-column">Quiz Name</th>
        <th scope="col" class="manage-column"># Questions</th>
        <th scope="col" class="manage-column">Createad At</th>
        <th scope="col" class="manage-column">Edit</th>
        <th scope="col" class="manage-column">Delete</th>
    </tr>
</tfoot>

</table>
    <div class="tablenav bottom">
    <div class="tablenav-pages one-page"><span class="displaying-num"><?=count($query)?> items</span></div>
    <br class="clear">
    </div>
<br class="clear">
</div>