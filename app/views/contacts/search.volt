<?php
/**
 * @var \Phalcon\Mvc\View\Engine\Php $this
 */
?>

<?php use Phalcon\Tag; ?>

<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous"><?php echo $this->tag->linkTo(["contacts/index", "Go Back"]); ?></li>
            <li class="next"><?php echo $this->tag->linkTo(["contacts/new", "Create "]); ?></li>
        </ul>
    </nav>
</div>

<div class="page-header">
    <h1>Search result</h1>
</div>

<?php echo $this->getContent(); ?>

<div class="row">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Type</th>

                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($page->items as $contact): ?>
            <tr>
                <td><?php echo $contact->id ?></td>
                <td><?php echo $contact->name ?></td>
                <td><?php echo $contact->email ?></td>
                <td><?php echo $contact->phone ?></td>
                <td><?php echo $contact->type ?></td>

                <td><?php echo $this->tag->linkTo(["contacts/edit/" . $contact->id, "Edit"]); ?></td>
                <td><?php echo $this->tag->linkTo(["contacts/delete/" . $contact->id, "Delete"]); ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="row">
    <div class="col-sm-1">
        <p class="pagination" style="line-height: 1.42857;padding: 6px 12px;">
            <?php echo $page->current, "/", $page->total_pages ?>
        </p>
    </div>
    <div class="col-sm-11">
        <nav>
            <ul class="pagination">
                <li><?php echo $this->tag->linkTo("contacts/search", "First") ?></li>
                <li><?php echo $this->tag->linkTo("contacts/search?page=" . $page->before, "Previous") ?></li>
                <li><?php echo $this->tag->linkTo("contacts/search?page=" . $page->next, "Next") ?></li>
                <li><?php echo $this->tag->linkTo("contacts/search?page=" . $page->last, "Last") ?></li>
            </ul>
        </nav>
    </div>
</div>
