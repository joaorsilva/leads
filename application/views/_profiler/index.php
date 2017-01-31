<!DOCTYPE html>
<html lang=en> 
    <head>
        <meta charset=utf-8 />
        <meta name=viewport content="width=device-width,initial-scale=1" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name=description content="Application profiler for CodeIgniter." />
        <link rel="shortcut icon" href="/public/_profiler/images/ci.ico"/>
        <title>Profiler for CodeIgniter</title>
        <link href="/public/assets/bootstrap-3.3.6-dist/css/bootstrap.min.css" rel="stylesheet" />
        <link href="/public/assets/font-awesome-4.6.3/css/font-awesome.min.css" rel="stylesheet" />
        <link href="/public/_profiler/assets/css/_profiler.css" rel="stylesheet" />
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <!--<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-profiler-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>                        
                    </button>-->
                    <a class="navbar-brand" href="/_profiler/index/index" style="width:250px;"><img alt="CodeIgniter Profiler" src="/public/_profiler/assets/images/ci32.png" class="pull-left"/><div style="padding-top:7px;">CodeIgniter Profiler</div></a>
                </div>
                <!--<div class="collapse navbar-collapse" id="bs-profiler-collapse-1">
                    <ul class="nav navbar-nav">
                        <li><a class="navbar-brand" href="/_profiler/index/index">CodeIgniter Profiler</a></li>
                    </ul>
                </div>-->
            </div>
        </nav>
        <section id="requests" style="padding-left: 15px;padding-right: 15px;">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">Request Filter<button id="collapse-filter-button" type="button" class="btn btn-success btn-xs pull-right">Show</button></h3>
                </div>
              <div id="collapse-filter" class="panel-body collapse">
                  <form class="form-inline">
                      <div class="form-group">
                          <input type="text" class="form-control" id="fiter-id" placeholder="Request Id">
                      </div>    
                      <div class="form-group">
                          <input type="text" class="form-control" id="fiter-ip" placeholder="From Ip">
                      </div>    
                      <div class="form-group">
                          <select id="filter-method" class="form-control">
                              <option value="">Method</option>
                              <option value="GET">GET</option>
                              <option value="POST">POST</option>
                              <option value="PUT">PUT</option>
                              <option value="DELETE">DELETE</option>
                          </select>
                      </div>    
                      <div class="form-group">
                          <input type="text" class="form-control" id="fiter-uri" placeholder="Uri">
                      </div>    
                      <div class="form-group">
                          <input type="text" class="form-control" id="fiter-protocol" placeholder="Protocol">
                      </div>
                      <button type="submit" class="btn btn-primary">Filter&nbsp;<span class="fa fa-search-plus"></span></button>
                      <a class="btn btn-success">Clear&nbsp;<span class="fa fa-search-minus"></a>
                  </form>
              </div>
            </div>            
            <div class="panel panel-primary">
                <div class="panel-heading">
                  <h3 class="panel-title">Requests</h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th style="text-align:center;">Id</th>
                                    <th style="text-align:center;">Status</th>
                                    <th style="text-align:right;">Ip</th>
                                    <th>Method</th>
                                    <th>Url</th>
                                    <th style="text-align:right;">Queries</th>
                                    <th style="text-align:right;">Queries Time</th>
                                    <th style="text-align:right;">Execution Time</th>
                                    <th style="text-align:right;">Memory Peak</th>
                                    <th style="text-align:right;">Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if($data) {
                                    $response_class = "";
                                    $response_icon = "";
                                    foreach($data['rows'] as $row) {
                                        switch(floor($row->status/100)){
                                            case 5:
                                                $response_class = "danger";
                                                $response_icon = "ban";
                                                break;
                                            case 4:    
                                                $response_class = "warning";
                                                $response_icon = "exclamation-triangle";
                                                break;
                                            case 3:
                                                $response_class = "primary";
                                                $response_icon = "info-circle";
                                                break;
                                            case 2:
                                                $response_class = "success";
                                                $response_icon = "check";
                                                break;
                                            case 1:
                                                $response_class = "default";
                                                $response_class = "envelope-o";
                                                break;
                                                
                                        }
                                ?>
                                <tr>
                                    <td style="text-align:center;"><a href="/_profiler/index/index/?request=<?php echo(urlencode(str_replace('.json', '', $row->name)))?>"><?php echo($row->id)?></a></td>
                                    <td style="text-align:center;"><span class="label label-<?php echo($response_class)?>"><?php echo($row->status)?>&nbsp;&nbsp;<span class="fa fa-<?php echo($response_icon)?>"></span></span></td>
                                    <td style="text-align:right;"><?php echo($row->ip)?></td>
                                    <td><?php echo($row->method)?></td>
                                    <td><?php echo($row->url)?></td>
                                    <td style="text-align:right;"><?php echo(number_format($row->query_count,0,'.',','))?></td>
                                    <td style="text-align:right;"><?php echo(number_format($row->query_time,3,'.',',') . ' mi.')?></td>
                                    <td style="text-align:right;"><?php echo(number_format($row->execution_time,3,'.',',') . ' mi.')?></td>
                                    <td style="text-align:right;"><?php echo(number_format($row->execution_memory/1024,0,'.',',') . ' Kb')?></td>
                                    <td style="text-align:right;"><?php echo($row->time)?></td>
                                </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>            
            </div>
            <?php 
            if($data['rows']) {
            $pages = ceil($data['paging']['total_rows']/$data['paging']['rows']);
            $page = ceil($data['paging']['row']+1/$data['paging']['rows']);
            
            $max_buttons = 5;
            if($page < $max_buttons / 2) {
                $start_page = 1;
                $end_page = $max_buttons;
            } else if($page + $max_buttons / 2 > $pages) {
                $start_page = $page - $max_buttons;
                $end_page = $pages;
            } else {
                $start_page = $page - 2;
                $end_page = $page - 2;
            }
            if($end_page > $pages) {
                $end_page = $pages;
            }
            
            ?>
            <nav style="text-align: center;">
              <ul class="pagination">
                <li class="<?php if($page==1)echo('disabled')?>">
                  <a href="/_profiler/index/index?page=<?php echo($page-2)?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                  </a>
                </li>
                <?php 
                for($a=$start_page; $a<=$end_page; $a++) {
                ?>
                <li class="<?php if($a==$page)echo('active')?>"><a href="/_profiler/index/index?page=<?php echo($a-1)?>"><?php echo($a)?></a></li>
                <?php
                }
                ?>
                <li  class="<?php if($page==$pages)echo('disabled')?>">
                  <a href="/_profiler/index/index?page=<?php echo($page)?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                  </a>
                </li>
              </ul>
            </nav>
            <?php
            }
            ?>
        </section>
        
        <nav class="navbar navbar-default navbar-fixed-bottom">
            <div class="container-fluid">
                <div class="footer-links">
                    <a href="http://www.spagiweb.com">Copyright &copy; 2016 - Spagi Sistemas, ME.</a>
                </div>
        </nav>
        <script src="/public/_profiler/assets/js/jquery.min.js"></script>
        <script src="/public/assets/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
        <script src="/public/_profiler/assets/js/index.js"></script>
    </body>
</html>    
<?php


