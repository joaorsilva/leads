<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of views/app/modules/index
 * Copyright (c) 2016 SPAGI Sistemas, ME.
 * Todos os direitos reservados.
 * @author João Lopes Ribeiro da Silva <joao.r.silva@gmail.com>
 */
?>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">List of <?php echo($this->spagi_pagedata->page['title'])?></h3>
                </div>    
                <div class="box-body">
                    <div class="box box-primary collapsed-box box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-filter"></i>&nbsp;<?php echo($this->spagi_i18n->_('__lists__Table data filter'))?></h3>
                            <div class="box-tools pull-right">
                                <button id="filter-collapse" type="button" class="btn btn-box-tool" data-widget="collapse" >
                                    <i class="fa fa-plus"></i>
                                </button>    
                            </div>
                        </div>
                        <div class="box-body">
                            <form id="form-filter" name="filter" method="post" action="<?php echo($this->spagi_pagedata->route)?>select_list">
                                <input type="hidden" id="default-filter" name="default-filter" value="1"/>
                                <div class="form-group">
                                    <label class="sr-only" for="filter-id">#</label>
                                    <input type="number" class="form-control" id="filter-id" name="filter[id]" placeholder="#" min="1">
                                </div>
                                <div class="form-group">
                                    <label class="sr-only" for="filter-name">Name</label>
                                    <input type="text" class="form-control" id="filter-name" name="filter[name]" placeholder="Name">
                                </div>
                                <div class="form-group" style="min-width: 150px;">
                                    <label class="sr-only" for="filter-created_by">Created by</label>
                                    <select class="form-control select2" style="width:100%;" id="filter-created_by" name="filter[created_by]">
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="sr-only" for="filter-created_date">Created date</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right" id="filter-created_date" name="filter[created_date]" placeholder="Created date">
                                    </div>
                                </div>
                                <div class="form-group" style="min-width: 150px;">
                                    <label class="sr-only" for="filter-updated_by">Updated by</label>
                                    <select class="form-control select2" style="width:100%;" id="filter-updated_by" name="filter[updated_by]">
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="sr-only" for="filter-updated_date">Updated date</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right" id="filter-updated_date" name="filter[updated_date]" placeholder="Updated date">
                                    </div>
                                </div>
                                <div class="form-group" style="min-width: 150px;">
                                    <label class="sr-only" for="filter-status">Status</label>
                                    <select class="form-control select2" multiple="multiple" data-placeholder="Status" style="width:100%;" id="filter-status" name="filter[status][]">
                                        <option value="1"><?php echo($this->spagi_i18n->_('__lists__Active'))?></option>
                                        <option value="2"><?php echo($this->spagi_i18n->_('__lists__Inactive'))?></option>
                                        <option value="3"><?php echo($this->spagi_i18n->_('__lists__Deleted'))?></option>
                                    </select>
                                </div>
                                <div class="form-group pull-right">
                                    <button id="filter-submit" type="submit" class="btn btn-success"><i class="fa fa-filter"></i>&nbsp;<?php echo($this->spagi_i18n->_('__lists__Filter'))?></button>
                                    <button id="filter-clear" type="button" class="btn btn-info"><i class="fa fa-eraser"></i>&nbsp;<?php echo($this->spagi_i18n->_('__lists__Clear'))?></button>
                                </div>
                                <!-- Pagination data -->
                                <input type="hidden" name="pagination[page]" id="pagination-page" value="0"/>
                                <input type="hidden" name="pagination[page_size]" id="pagination-page-size" value="10"/>
                                <!-- /Pagination data -->
                                <!-- Sort data -->
                                <input type="hidden" name="sort[field]" id="sort-field" value=""/>
                                <input type="hidden" name="sort[direction]" id="sort-direction" value=""/>
                                <!-- /Sort data -->
                            </form>    
                        </div>
                    </div>
                    <div class="box-footer clearfix">
                        <div class="row row-narrow-5">
                            <div class="form-group pull-left form-inline">
                                <label for="rows_per_page"><?php echo($this->spagi_i18n->_('__lists__Rows per page'))?>:</label>&nbsp;
                                <select name="page_size" id="page-size" class="form-control">
                                    <option value="10">10</option>
                                    <option value="20">20</option>
                                    <option value="40">40</option>
                                    <option value="80">80</option>
                                    <option value="100">100</option>
                                </select>
                            </div>
                            <div class=" pull-right">
                                <a class="btn btn-success" href="<?php echo($this->spagi_pagedata->route)?>edit/new"><i class="fa fa-file-o"></i>&nbsp;<?php echo($this->spagi_i18n->_('__lists__New_record'))?></a>
                                <a id="delete-many" class="btn btn-danger hidden" href="<?php echo($this->spagi_pagedata->route)?>delete"><i class="fa fa-trash-o"></i>&nbsp;<?php echo($this->spagi_i18n->_('__lists__Delete_selected'))?></a>                                    
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="list" class="table table-responsive table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">&nbsp;</th>
                                    <th class="text-center hidden-xs"><a href="javascript:void(0)" id="field-id">#<i class="glyphicon glyphicon-sort-by-attributes pull-right"></i></a></th>
                                    <th class="text-left"><a href="javascript:void(0)" id="field-name">Name&nbsp;<i class="glyphicon glyphicon-sort pull-right"></i></a></th>
                                    <th class="text-left hidden-sm hidden-xs" nowrap><a href="javascript:void(0)" id="field-created_by">Created By&nbsp;<i class="glyphicon glyphicon-sort pull-right"></i></a></th>
                                    <th class="text-right hidden-sm hidden-xs"><a href="javascript:void(0)" id="field-created_date">Created Date&nbsp;<i class="glyphicon glyphicon-sort pull-right"></i></a></th>
                                    <th class="text-left hidden-sm hidden-xs"><a href="javascript:void(0)" id="field-updated_by">Updated By&nbsp;<i class="glyphicon glyphicon-sort pull-right"></i></a></th>
                                    <th class="text-right hidden-sm hidden-xs"><a href="javascript:void(0)" id="field-updated_date">Updated Date&nbsp;<i class="glyphicon glyphicon-sort pull-right"></i></a></th>
                                    <th class="text-center hidden-xs"><a href="javascript:void(0)" id="field-status">Status&nbsp;<i class="glyphicon glyphicon-sort pull-right"></i></a></th>
                                    <th class="text-right">Operations</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="row-single" class="hidden">
                                    <td colspan="9" class="text-center"><i class="fa fa-spinner fa-spin"></i>&nbsp;<?php echo($this->spagi_i18n->_('__lists__Loading...'))?></td>
                                </tr>    
                                <tr id="row-error" class="hidden">
                                    <td colspan="9" class="text-center">
                                        <div class="callout callout-danger">
                                            <h4><i class="fa fa-warning"></i>&nbsp;<?php echo($this->spagi_i18n->_('__lists__Error loading your data'))?></h4>
                                            <p><?php echo($this->spagi_i18n->_('__lists__Problem loading'))?></p>
                                            <button id="table-retry" type="button" class="btn btn-warning"><i class="fa fa-refresh"></i>&nbsp;Retry</button>
                                        </div>
                                    </td>
                                </tr>    
                                <tr id="row-no-data" class="hidden">
                                    <td colspan="9" class="text-center">
                                        <div class="callout callout-warning">
                                            <h4><i class="fa fa-exclamation-circle"></i>&nbsp;<?php echo($this->spagi_i18n->_('__lists__No data found'))?></h4>
                                            <p><?php echo($this->spagi_i18n->_('__lists__No data found criteria'))?></p>
                                        </div>
                                    </td>
                                </tr>    
                                <tr id="row-template" class="hidden">
                                    <td class="text-center table-row"><input type="checkbox" class="dynamic-checkbox" name="selected[0]" value="0"/></td>
                                    <td class="text-center table-row hidden-xs"></td>
                                    <td class="text-left table-row"></td>
                                    <td class="text-left table-row hidden-sm hidden-xs"></td>
                                    <td class="text-right table-row hidden-sm hidden-xs"></td>
                                    <td class="text-left table-row hidden-sm hidden-xs"></td>
                                    <td class="text-right table-row hidden-sm hidden-xs"></td>
                                    <td class="text-center table-row hidden-xs"><span class="label"></span></td>
                                    <td class="text-right" style="min-width: 140px;">
                                        <div class="btn-group">
                                            <a class="btn btn-info" data-id="" href="<?php echo($this->spagi_pagedata->route) ?>show/"><i class="fa fa-search"></i></a>
                                            <a class="btn btn-warning" data-id="" href="<?php echo($this->spagi_pagedata->route)?>edit/"><i class="fa fa-pencil-square-o"></i></a>
                                            <a class="btn btn-danger btn-delete" data-id="" data-toggle="modal" data-target="#dialog-delete" href="javascript:void(0);"><i class="fa fa-trash-o"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>   
                    </div>
                    <div class="box-footer clearfix">
                        <div class="row row-narrow-5">
                            <div class="pull-left">
                                <?php echo($this->spagi_i18n->_('__lists__pagination_Showing'))?> <span id="row-start"><b>1</b></span> <?php echo($this->spagi_i18n->_('__lists__pagination_to'))?> <span id="row-end"><b>10</b></span> <?php echo($this->spagi_i18n->_('__lists__pagination_of'))?> <span id="row-totals"><b>1000</b></span> <?php echo($this->spagi_i18n->_('__lists__pagination_records'))?>
                            </div>
                            <div class="btn-group pull-right">
                                <a class="btn btn-default pag" id="page-prev" href="javascript:void(0);" data-page="0"><i class="fa fa-chevron-left"></i></a>
                                <a class="btn btn-default pag pages" id="page-number" data-page="1">1</a>
                                <a class="btn btn-default pag" id="page-next" href="javascript:void(0);" data-page="0"><i class="fa fa-chevron-right"></i></a>
                            </div>
                        </div>    
                    </div>
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
                    <h4 class="modal-title"><i class="fa fa-exclamation-triangle"></i>&nbsp;<?php echo($this->spagi_i18n->_('__lists__Delete'))?></h4>
                </div>
                <div class="modal-body">
                    <p><?php echo($this->spagi_i18n->_('__lists__delete_record_question'))?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                    <button type="button" id="btn-delete" class="btn btn-outline" data-dismiss="modal" data-url="<?php echo($this->spagi_pagedata->route)?>delete/">Yes</button>
                </div>
            </div>
        </div>
    </div>
    <span id="base-url" data-url="<?php echo($this->spagi_pagedata->route)?>" class="hidden"></span>
</section>


