<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Application Controller</h3>
                </div>    
                <div class="box-body">
                    <div id="data-error" class="callout callout-danger hidden">
                        <h4><i class="fa fa-exclamation-triangle"></i><span></span></h4>
                        <p></p>
                    </div>
                    <form role="form" id="record" name="form-record" action="<?php echo($this->spagi_pagedata->route)?>save/" method="POST" class="hidden">
                        <div class="form-group">
                            <label class="control-label" for="form-id">Record Id:</label>
                            <input type="text" class="form-control text-right" id="form-id" name="form[id]" style="max-width: 100px" value="<?php echo($this->spagi_pagedata->page['id'])?>" disabled/>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="form-name">Name:</label>
                            <input type="text" class="form-control" id="form-name" name="form[name]" style="max-width: 500px" <?php if($this->spagi_pagedata->page['show']) echo("disabled")?> />
                            <span id="form-name-error" class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="filter-app_modules_id">Module: </label>
                            <select class="form-control select2" style="width:100%" id="form-app_modules_id" name="form[app_modules_id]">
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="form-key">Key:</label>
                            <input type="text" class="form-control" id="form-key" name="form[key]" style="max-width: 300px" disabled/>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="form-active">
                                <input type="checkbox" id="form-active" name="form[active]" style="max-width: 300px" <?php if($this->spagi_pagedata->page['show']) echo("disabled")?>/>&nbsp;Active
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="form-deleted">
                                <input type="checkbox" id="form-deleted" class="" name="form[deleted]" style="max-width: 300px" <?php if($this->spagi_pagedata->page['show']) echo("disabled")?> />&nbsp;Deleted
                            </label>
                        </div>
                        <div class="box box-primary collapsed-box box-solid">
                            <div class="box-header with-border">
                                <h3 class="box-title"><i class="fa fa-tag"></i>&nbsp;Metadata</h3>
                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse" >
                                        <i class="fa fa-plus"></i>
                                    </button>    
                                </div>                                
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <label class="control-label" for="form-created_by">Created By:</label>
                                    <input type="text" class="form-control" id="form-created_by" name="form[created_by]" style="max-width: 400px" disabled/>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="form-created_date">Created Date:</label>
                                    <input type="text" class="form-control" id="form-created_date" name="form[created_date]" style="max-width: 200px" disabled/>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="form-updated_by">Updated By:</label>
                                    <input type="text" class="form-control" id="form-updated_by" name="form[updated_by]" style="max-width: 400px" disabled/>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="form-updated_date">Updated Date:</label>
                                    <input type="text" class="form-control" id="form-updated_date" name="form[updated_date]" style="max-width: 200px" disabled/>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="form-deleted_by">Deleted By:</label>
                                    <input type="text" class="form-control" id="form-deleted_by" name="form[deleted_by]" style="max-width: 400px" disabled/>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="form-deleted_date">Deleted Date:</label>
                                    <input type="text" class="form-control" id="form-deleted_date" name="form[deleted_date]" style="max-width: 200px" disabled/>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <a class="btn btn-default" href="<?php echo($this->spagi_pagedata->route)?>"><i class="fa fa-arrow-circle-o-left"></i>&nbsp;Cancel</a>&nbsp;
                            <?php if(!$this->spagi_pagedata->page['show']) {?>
                            <button type="submit"  class="btn btn-success" id="save-form"><i class="fa fa-save"></i>&nbsp;Save</button>
                            <button type="button" id="delete-record" class="btn btn-danger pull-right" data-toggle="modal" data-target="#dialog-delete"><i class="fa fa-eraser"></i>&nbsp;Delete</button>
                            <?php } ?>
                        </div>    
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal modal-danger fade" id="dialog-delete">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title"><i class="fa fa-exclamation-triangle"></i>&nbsp;Delete</h4>
                </div>
                <div class="modal-body">
                    <p>Are you shure you want to delete this record?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                    <button type="button" id="btn-delete" class="btn btn-outline" data-url="<?php echo($this->spagi_pagedata->route)?>delete/">Yes</button>
                </div>
            </div>
        </div>
    </div>
    <span id="base-url" data-url="<?php echo($this->spagi_pagedata->route)?>" class="hidden"></span>
    <span id="data-none-caption" class="hidden">&nbsp;No data found!</span>
    <span id="data-none-text" class="hidden">No data was found for the requested record.</span>
    <span id="data-error-caption" class="hidden">&nbsp;Error!</span>
    <span id="data-error-text" class="hidden">An error occured while processing your request.</span>
</section>  

