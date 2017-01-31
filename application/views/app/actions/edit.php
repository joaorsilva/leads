<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo($this->spagi_pagedata->page['title'])?></h3>
                </div>    
                <div class="box-body">
                    <div id="data-error" class="callout callout-danger hidden">
                        <h4><i class="fa fa-exclamation-triangle"></i><span></span></h4>
                        <p></p>
                    </div>
                    <form role="form" id="record" name="form-record" action="<?php echo($this->spagi_pagedata->route)?>save/" method="POST" class="hidden">
                        <div class="form-group">
                            <label class="control-label" for="form-id"><?php echo($this->spagi_i18n->_('__forms__ Record Id'))?>:</label>
                            <input type="text" class="form-control text-right" id="form-id" name="form[id]" style="max-width: 100px" value="<?php echo($this->spagi_pagedata->page['id'])?>" disabled/>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="form-name"><?php echo($this->spagi_i18n->_('__actions__edit Name'))?>:</label>
                            <input type="text" class="form-control" id="form-name" name="form[name]" style="max-width: 500px" <?php if($this->spagi_pagedata->page['show']) echo("disabled")?> />
                            <span id="form-name-error" class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="form-app_modules_id"><?php echo($this->spagi_i18n->_('__actions__edit Module'))?>: </label>
                            <select class="form-control select2" style="width:100%" id="form-app_modules_id" name="form[app_modules_id]">
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="form-app_controllers_id"><?php echo($this->spagi_i18n->_('__actions__edit Controller'))?>: </label>
                            <select class="form-control select2" style="width:100%" id="form-app_controllers_id" name="form[app_controllers_id]">
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="form-key"><?php echo($this->spagi_i18n->_('__actions__edit Key'))?>:</label>
                            <input type="text" class="form-control" id="form-key" name="form[key]" style="max-width: 300px" disabled/>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="form-active">
                                <input type="checkbox" id="form-active" name="form[active]" style="max-width: 300px" <?php if($this->spagi_pagedata->page['show']) echo("disabled")?>/>&nbsp;<?php echo($this->spagi_i18n->_('__forms__ Active'))?>
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="form-deleted">
                                <input type="checkbox" id="form-deleted" class="" name="form[deleted]" style="max-width: 300px" <?php if($this->spagi_pagedata->page['show']) echo("disabled")?> />&nbsp;<?php echo($this->spagi_i18n->_('__forms__ Deleted'))?>
                            </label>
                        </div>
                        <div class="box box-primary collapsed-box box-solid">
                            <div class="box-header with-border">
                                <h3 class="box-title"><i class="fa fa-tag"></i>&nbsp;<?php echo($this->spagi_i18n->_('__forms__ Metadata'))?></h3>
                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse" >
                                        <i class="fa fa-plus"></i>
                                    </button>    
                                </div>                                
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <label class="control-label" for="form-created_by"><?php echo($this->spagi_i18n->_('__forms__ Created By'))?>:</label>
                                    <input type="text" class="form-control" id="form-created_by" name="form[created_by]" style="max-width: 400px" disabled/>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="form-created_date"><?php echo($this->spagi_i18n->_('__forms__ Created Date'))?>:</label>
                                    <input type="text" class="form-control" id="form-created_date" name="form[created_date]" style="max-width: 200px" disabled/>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="form-updated_by"><?php echo($this->spagi_i18n->_('__forms__ Updated By'))?>:</label>
                                    <input type="text" class="form-control" id="form-updated_by" name="form[updated_by]" style="max-width: 400px" disabled/>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="form-updated_date"><?php echo($this->spagi_i18n->_('__forms__ Updated Date'))?>:</label>
                                    <input type="text" class="form-control" id="form-updated_date" name="form[updated_date]" style="max-width: 200px" disabled/>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="form-deleted_by"><?php echo($this->spagi_i18n->_('__forms__ Deleted By'))?>:</label>
                                    <input type="text" class="form-control" id="form-deleted_by" name="form[deleted_by]" style="max-width: 400px" disabled/>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="form-deleted_date"><?php echo($this->spagi_i18n->_('__forms__ Deleted Date'))?>:</label>
                                    <input type="text" class="form-control" id="form-deleted_date" name="form[deleted_date]" style="max-width: 200px" disabled/>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <a class="btn btn-default" href="<?php echo($this->spagi_pagedata->route)?>"><i class="fa fa-arrow-circle-o-left"></i>&nbsp;<?php echo($this->spagi_i18n->_('__forms__ Cancel'))?></a>&nbsp;
                            <?php if(!$this->spagi_pagedata->page['show']) {?>
                            <button type="submit"  class="btn btn-success" id="save-form"><i class="fa fa-save"></i>&nbsp;<?php echo($this->spagi_i18n->_('__forms__ Save'))?></button>
                            <button type="button" id="delete-record" class="btn btn-danger pull-right" data-toggle="modal" data-target="#dialog-delete"><i class="fa fa-eraser"></i>&nbsp;<?php echo($this->spagi_i18n->_('__forms__ Delete'))?></button>
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
                    <h4 class="modal-title"><i class="fa fa-exclamation-triangle"></i>&nbsp;<?php echo($this->spagi_i18n->_('__forms__ Delete'))?></h4>
                </div>
                <div class="modal-body">
                    <p><?php echo($this->spagi_i18n->_('__forms__ delete_sure'))?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo($this->spagi_i18n->_('__global__ No'))?></button>
                    <button type="button" id="btn-delete" class="btn btn-outline" data-url="<?php echo($this->spagi_pagedata->route)?>delete/"><?php echo($this->spagi_i18n->_('__global__ Yes'))?></button>
                </div>
            </div>
        </div>
    </div>
    <span id="base-url" data-url="<?php echo($this->spagi_pagedata->route)?>" class="hidden"></span>
    <span id="api-url" data-url="<?php echo($this->spagi_pagedata->api_route)?>" class="hidden"></span>
    <span id="data-none-caption" class="hidden">&nbsp;<?php echo($this->spagi_i18n->_('__forms__ no_data'))?></span>
    <span id="data-none-text" class="hidden"><?php echo($this->spagi_i18n->_('__forms__ no_data_for_request'))?></span>
    <span id="data-error-caption" class="hidden">&nbsp;<?php echo($this->spagi_i18n->_('__forms__ error'))?></span>
    <span id="data-error-text" class="hidden"><?php echo($this->spagi_i18n->_('__forms__ error_request'))?></span>
</section>  

