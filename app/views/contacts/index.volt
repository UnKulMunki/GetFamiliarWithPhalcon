<?php
/**
 * @var \Phalcon\Mvc\View\Engine\Php $this
 */
?>

<div class="page-header">
    <h1>
        Search contacts
    </h1>
    <p>
        <?php echo $this->tag->linkTo(["contacts/new", "Create contacts"]) ?>
    </p>
</div>

<?php echo $this->getContent() ?>

<?php
    echo $this->tag->form(
        [
            "contacts/search",
            "autocomplete" => "off",
            "class" => "form-horizontal"
        ]
    );
?>

<div class="form-group">
    <label for="fieldId" class="col-sm-2 control-label">Id</label>
    <div class="col-sm-10">
        <?php echo $this->tag->textField(["id", "type" => "number", "class" => "form-control", "id" => "fieldId"]) ?>
    </div>
</div>

<div class="form-group">
    <label for="fieldName" class="col-sm-2 control-label">Name</label>
    <div class="col-sm-10">
        <?php echo $this->tag->textField(["name", "size" => 30, "class" => "form-control", "id" => "fieldName"]) ?>
    </div>
</div>

<div class="form-group">
    <label for="fieldEmail" class="col-sm-2 control-label">Email</label>
    <div class="col-sm-10">
        <?php echo $this->tag->textField(["email", "size" => 30, "class" => "form-control", "id" => "fieldEmail"]) ?>
    </div>
</div>

<div class="form-group">
    <label for="fieldPhone" class="col-sm-2 control-label">Phone</label>
    <div class="col-sm-10">
        <?php echo $this->tag->textField(["phone", "size" => 30, "class" => "form-control", "id" => "fieldPhone"]) ?>
    </div>
</div>

<div class="form-group">
    <label for="fieldType" class="col-sm-2 control-label">Type</label>
    <div class="col-sm-10">

<!--  ** Hard way without Volt. **
        <?php echo $this->tag->selectStatic(["type", [ "W" => "Work", "P" => "Personal"], "class" => "form-control", "id" => "fieldType"]) ?>
-->
<!-- Easy way with Volt syntax -->
        {{ select_static( 'type', 
            [
                "Family" : "Family", 
                "School" : "School",
                "Work"   : "Work", 
                "SPAM"   : "SPAM"
            ],
            'useEmpty': true, 'emptyText': 'Select Contact Type')
         }}
    </div>
</div>


<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <?php echo $this->tag->submitButton(["Search", "class" => "btn btn-default"]) ?>
    </div>
</div>

<?php echo $this->tag->endForm(); ?>
