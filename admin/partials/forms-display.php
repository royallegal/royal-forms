<?php
//print_r(get_the_author('nickname', 1));
?>

<div class="wrap">
    <h1 class="wp-heading-inline">Royal Forms</h1>
    <a href="/wp-admin/admin.php?page=royal-forms-add" class="page-title-action">Add New</a>
    <hr class="wp-header-end">


    <table class="wp-list-table widefat fixed striped users">
    <thead>
    <tr>
        <td id="cb" class="manage-column" style="width: 50px;">ID</td>
        <th scope="col" class="manage-column">Form Name</th>
        <th scope="col" class="manage-column"># Questions</th>
        <th scope="col" class="manage-column">Createad By</th>
        <th scope="col" class="manage-column">Last Edit</th>
        <th scope="col" class="manage-column">Code</th>
        <th scope="col" class="manage-column">Actions</th>
    </tr>
    </thead>

    <tbody id="the-list" data-wp-lists="list:user">
    <?php foreach ( $query as $result ) {
        $questions = json_decode($result->form_content, true);
    ?>
    <tr>
        <td id="cb" class="manage-column"><?=$result->id;?></td>
        <th scope="col" class="manage-column"><?=$result->form_name;?>
            <?php if ($result->form_description) { ?><br><small><i><?=$result->form_description?></i></small><?php } ?>
        </th>
        <th scope="col" class="manage-column"><?=count($questions);?></th>
        <th scope="col" class="manage-column"><u><?=get_the_author_meta('display_name', $result->createdby)?></u> at <?=date("l jS \of F",$result->created)?></th>
        <th scope="col" class="manage-column"><?php if($result->lastedit): ?><?=$result->lastedit?> by <?=$result->lasteditby?><?php else: echo "N/A"; endif;?></th>
        <th scope="col" class="manage-column"><code>[royalform id=<?=$result->id?> /]</code></th>
        <th scope="col" class="manage-column">
            <a href="#">Edit</a> / <a href="#">Delete</a>
        </th>
    </tr>
    <?php } ?>
    </tbody>

    <tfoot>
    <tr>
        <td id="cb" class="manage-column" style="width: 50px;">ID</td>
        <th scope="col" class="manage-column">Form Name</th>
        <th scope="col" class="manage-column"># Questions</th>
        <th scope="col" class="manage-column">Createad By</th>
        <th scope="col" class="manage-column">Last Edit</th>
        <th scope="col" class="manage-column">Code</th>
        <th scope="col" class="manage-column">Actions</th>
    </tr>
</tfoot>

</table>
    <div class="tablenav bottom">
    <div class="tablenav-pages one-page"><span class="displaying-num"><?=count($query)?> items</span></div>
    <br class="clear">
    </div>
<br class="clear">
</div>