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
        <nav>
            <div class="container-fluid">
                <ul id="areas-menu" class="nav nav-pills nav-justified">
                    <li class="active" data-area="#request-area"><a href="#"><span class="fa fa-arrow-down"></span>&nbsp;Request</a></li>
                    <li data-area="#response-area"><a href="#"><span class="fa fa-arrow-up"></span>&nbsp;Response</a></li>
                    <li data-area="#database-area"><a href="#"><span class="fa fa-database"></span>&nbsp;Database&nbsp;<?php if(isset($data['database']['total_queries']) && $data['database']['total_queries']){?><span class="badge"><?php echo($data['database']['total_queries'])?></span><?php }?></a></li>
                    <li data-area="#exceptions-area"><a href="#"><span class="fa fa-ban"></span>&nbsp;Exceptions&nbsp;<?php if($data['error']) {?><span class="badge"><?php echo(count($data['error']))?></span><?php }?></a></li>
                    <li data-area="#execution-area"><a href="#"><span class="fa fa-tasks"></span>&nbsp;Execution&nbsp;<?php if($data['execution']['stack']) {?><span class="badge"><?php echo(count($data['execution']['stack']))?></span><?php }?></a></li>
                    <li data-area="#configuration-area"><a href="#"><span class="fa fa-gears"></span>&nbsp;Configuration&nbsp;<span class="badge">227</span></a></li>
                    <li data-area="#logs-area"><a href="#"><span class="fa fa-file-text-o"></span>&nbsp;Logs&nbsp;<span class="badge">227</span></a></li>
                </ul>
            </div>
        </nav>
        <section id="request-area" class="area" style="padding-left: 15px;padding-right: 15px;padding-top: 15px;">
            <div id="pannel-request" class="panel panel-primary">
                <div class="panel-heading">
                  <h3 class="panel-title">Request</h3>
                </div>
                <div class="panel-body">
                    <h3>Basic Data</h3>
                    <div class="table-responsive">
                        <table class="table table-condensed table-bordered">
                            <thead>
                            </thead>
                            <tbody>
                                <tr>
                                    <th class="info" style="width:20%">Request Time</th>
                                    <td><?php echo($data['request']['time'])?></td>
                                </tr>
                                <tr>
                                    <th class="info" style="width:20%">Request Url</th>
                                    <td><?php echo($data['request']['url'])?></td>
                                </tr>
                                <tr>
                                    <th class="info" style="width:20%">Protocol:</th>
                                    <td><?php echo($data['request']['protocol'])?></td>
                                </tr>
                                <tr>
                                    <th class="info" style="width:20%">Host:</th>
                                    <td><?php echo($data['request']['host'])?></td>
                                </tr>
                                <tr>
                                    <th class="info" style="width:20%">Port:</th>
                                    <td><?php echo($data['request']['port'])?></td>
                                </tr>
                                <tr>
                                    <th class="info" style="width:20%">Method:</th>
                                    <td><?php echo($data['request']['method'])?></td>
                                </tr>
                                <tr>
                                    <th class="info" style="width:20%">Content Type:</th>
                                    <td><?php echo($data['request']['content_type'])?></td>
                                </tr>
                                <tr>
                                    <th class="info" style="width:20%">Remote Ip:</th>
                                    <td><?php echo($data['request']['remote_ip'])?></td>
                                </tr>
                                <tr>
                                    <th class="info" style="width:20%">Remote Host:</th>
                                    <td><?php echo($data['request']['remote_host'])?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <h3>Headers</h3>
                    <div class="table-responsive">
                        <table class="table table-condensed table-bordered">
                            <thead>
                            </thead>
                            <tbody>
                                <?php foreach($data['request']['headers'] as $key=>$val) { ?>
                                <tr>
                                    <th class="info" style="width:20%"><?php echo($key)?></th>
                                    <td><?php echo($val)?></td>
                                </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <h3>Data Received</h3>
                    <div class="table-responsive">
                        <table class="table table-condensed table-bordered">
                            <thead>
                            </thead>
                            <tbody>
                                <tr>
                                    <th class="info" style="width:20%">GET</th>
                                    <td>
                                <?php
                                foreach($data['request']['globals']['get'] as $key=>$val) { 
                                    echo('<strong>' . $key . '</strong> => ' . print_r($val, TRUE) . '<br/>');
                                }
                                ?>
                                    </td>    
                                </tr>
                                <tr>
                                    <th class="info" style="width:20%">POST</th>
                                    <td>
                                <?php
                                foreach($data['request']['globals']['post'] as $key=>$val) { 
                                    echo('<strong>' . $key . '</strong> => ' . print_r($val, TRUE) . '<br/>');
                                }
                                ?>
                                    </td>    
                                </tr>
                                <tr>
                                    <th class="info" style="width:20%">COOKEIS</th>
                                    <td>
                                <?php
                                foreach($data['request']['globals']['cookeis'] as $key=>$val) { 
                                    echo('<strong>' . $key . '</strong> => ' . print_r($val, TRUE) . '<br/>');
                                }
                                ?>
                                    </td>    
                                </tr>
                                <tr>
                                    <th class="info" style="width:20%">FILES</th>
                                    <td>
                                <?php
                                foreach($data['request']['globals']['files'] as $key=>$val) { 
                                    echo('<strong>' . $key . '</strong> => ' . print_r($val, TRUE) . '<br/>');
                                }
                                ?>
                                    </td>    
                                </tr>
                            </tbody>
                        </table>
                    </div>                    
                    <h3>Server Variables</h3>
                    <div class="table-responsive">
                        <table class="table table-condensed table-bordered">
                            <thead>
                            </thead>
                            <tbody>
                                <?php foreach($data['request']['globals']['vars'] as $key=>$val) { ?>
                                <tr>
                                    <th class="info" style="width:20%"><?php echo($key)?></th>
                                    <td><?php echo($val)?></td>
                                </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>                    
                </div>
            </div>
        </section>
        <section id="response-area" class="area hidden" style="padding-left: 15px;padding-right: 15px;padding-top: 15px;">
            <div id="pannel-request" class="panel panel-primary">
                <div class="panel-heading">
                  <h3 class="panel-title">Response</h3>
                </div>
                <div class="panel-body">
                    <h3>Basic Data</h3>
                    <div class="table-responsive">
                        <table class="table table-condensed table-bordered">
                            <thead>
                            </thead>
                            <tbody>
                                <tr>
                                    <th class="info" style="width:20%">Status</th>
                                    <td><?php echo($data['response']['code'])?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <h3>Headers</h3>
                    <div class="table-responsive">
                        <table class="table table-condensed table-bordered">
                            <thead>
                            </thead>
                            <tbody>
                                <?php foreach($data['response']['header'] as $key=>$val) { ?>
                                <tr>
                                    <th class="info" style="width:20%"><?php echo($key)?></th>
                                    <td><?php echo($val)?></td>
                                </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>                    
                </div>
            </div>
        </section>
        <section id="database-area" class="area hidden" style="padding-left: 15px;padding-right: 15px;padding-top: 15px;">
            <div id="pannel-request" class="panel panel-primary">
                <div class="panel-heading">
                  <h3 class="panel-title">Database</h3>
                </div>
                <div class="panel-body">
                    <h3>Sumary:</h3>
                    <div class="table-responsive">
                        <table class="table table-condensed table-bordered">
                            <thead>
                            </thead>
                            <tbody>
                                <tr>
                                    <th class="info" style="width:20%">Databases:</th>
                                    <td><?php if(array_key_exists('total_databases', $data['database'])) { echo($data['database']['total_databases']);} ?></td>
                                </tr>
                                <tr>
                                    <th class="info" style="width:20%">Queries:</th>
                                    <td><?php if(array_key_exists('total_queries', $data['database'])) { echo($data['database']['total_queries']);}?></td>
                                </tr>
                                <tr>
                                    <th class="info" style="width:20%">Query Time (secs):</th>
                                    <td><?php if(array_key_exists('total_query_times', $data['database'])) { echo($data['database']['total_query_times']);}?></td>
                                </tr>
                                <tr>
                                    <th class="info" style="width:20%">Query Avg (secs):</th>
                                    <td><?php if(array_key_exists('total_query_times', $data['database']) && $data['database']['total_queries']) { echo(($data['database']['total_query_times']/$data['database']['total_queries']));}?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <?php 
                    if(isset($data['database']['databases']) && is_array($data['database']['databases'])) {
                        foreach($data['database']['databases'] as $db) {
                    ?>
                    <h3>Database:&nbsp;<?php echo($db['name'] . " - " . $db['driver']['driver_type']) ?></h3>
                    <div class="table-responsive">
                        <table class="table table-condensed table-bordered">
                            <thead>
                            </thead>
                            <tbody>
                                <tr>
                                    <th class="info" style="width:20%">Queries: </th>
                                    <td><?php echo(number_format(count($db['driver']['queries']), 0, ".", ","))?></td>
                                </tr>
                                <tr>
                                    <th class="info" style="width:20%">Query Time (secs): </th>
                                    <td><?php echo(number_format($db['driver']['benchmark'], 5, ".", ","))?></td>
                                </tr>
                                <tr>
                                    <th class="info" style="width:20%">Queries: </th>
                                    <td>
                                        <table class="table table-condensed table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Time</th>
                                                    <th>Statement</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $current = 0;
                                                foreach($db['driver']['queries'] as $qry) {
                                                ?>
                                                <tr>
                                                    <td><?php echo(number_format($db['driver']['query_times'][$current], 5, ".", ","))?></td>
                                                    <td><?php echo($qry)?></td>
                                                </tr>
                                                <?php
                                                    $current++;
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </section>
        <section id="exceptions-area" class="area hidden" style="padding-left: 15px;padding-right: 15px;padding-top: 15px;">
            <div id="pannel-request" class="panel panel-primary">
                <div class="panel-heading">
                  <h3 class="panel-title">Exceptions</h3>
                </div>
                <div class="panel-body">
                    <h3>Details:</h3>
                    <?php
                        if($data['error']) {
                            foreach($data['error'] as $err) {
                    ?>
                    <div class="table-responsive">
                        <table class="table table-condensed table-bordered">
                            <thead>
                            </thead>
                            <tbody>
                                <tr>
                                    <th class="info" style="width:20%">Error Type: </th>
                                    <td><?php echo($err['type'])?></td>
                                </tr>
                                <tr>
                                    <th class="info" style="width:20%">Message: </th>
                                    <td><?php echo($err['message'])?></td>
                                </tr>
                                <tr>
                                    <th class="info" style="width:20%">File: </th>
                                    <td><?php echo($err['file_path'])?></td>
                                </tr>
                                <tr>
                                    <th class="info" style="width:20%">Line: </th>
                                    <td><?php echo($err['line'])?></td>
                                </tr>
                                <tr>
                                    <th class="info" style="width:20%">Backtrace: </th>
                                    <td>
                                        To be implemented
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <?php
                            }
                        }
                    ?>
                </div>
            </div>
        </section>
        <section id="execution-area" class="area hidden" style="padding-left: 15px;padding-right: 15px;padding-top: 15px;">
            <div id="pannel-request" class="panel panel-primary">
                <div class="panel-heading">
                  <h3 class="panel-title">Execution</h3>
                </div>
                <div class="panel-body">
                    <h3>Times:</h3>
                    <div class="table-responsive">
                        <table class="table table-condensed table-bordered">
                            <thead>
                            </thead>
                            <tbody>
                                <tr>
                                    <th class="info" style="width:20%">Start (secs): </th>
                                    <td><?php echo($data['execution']['times']['start'])?></td>
                                </tr>
                                <tr>
                                    <th class="info" style="width:20%">End (secs): </th>
                                    <td><?php echo($data['execution']['times']['end'])?></td>
                                </tr>
                                <tr>
                                    <th class="info" style="width:20%">Elapsed (secs): </th>
                                    <td><?php echo(number_format($data['execution']['times']['total'],5,".",","))?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <h3>Times:</h3>
                    <div class="table-responsive">
                        <table class="table table-condensed table-bordered">
                            <thead>
                            </thead>
                            <tbody>
                                <tr>
                                    <th class="info" style="width:20%">Peak: </th>
                                    <td><?php echo(number_format(($data['execution']['memory']['peak']/1024), 0, ".", ","))?>K</td>
                                </tr>
                                <tr>
                                    <th class="info" style="width:20%">Limit: </th>
                                    <td><?php echo($data['execution']['memory']['limit'])?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <h3>Stack:</h3>
                    <div class="table-responsive">
                        <table class="table table-condensed table-bordered">
                            <thead>
                            </thead>
                            <tbody>
                                <?php
                                if($data['execution']['stack']) {
                                    foreach($data['execution']['stack'] as $key=>$val) {

                                        $key = str_replace(array("controller_execution_time_","(",")"), "", $key);
                                        $key = str_replace(" / ", "::", $key);
                                ?>
                                <tr>
                                    <th class="info" style="width:20%"><?php echo($key)?> (secs): </th>
                                    <td><?php echo($val)?></td>
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
        </section>
        <section id="configuration-area" class="area hidden" style="padding-left: 15px;padding-right: 15px;padding-top: 15px;">
            <div id="pannel-request" class="panel panel-primary">
                <div class="panel-heading">
                  <h3 class="panel-title">Configuration</h3>
                </div>
                <div class="panel-body">
                    asdasd
                </div>
            </div>
        </section>
        <section id="logs-area" class="area hidden" style="padding-left: 15px;padding-right: 15px;padding-top: 15px;">
            <div id="pannel-request" class="panel panel-primary">
                <div class="panel-heading">
                  <h3 class="panel-title">Logs</h3>
                </div>
                <div class="panel-body">
                    asdasd
                </div>
            </div>
        </section>
        <nav class="navbar navbar-default navbar-fixed-bottom">
            <div class="container-fluid">
                <div class="footer-links">
                    <a href="http://www.spagiweb.com">Copyright &copy; 2016 - Spagi Sistemas, ME.</a>
                </div>
        </nav>        
        <script src="/public/_profiler/assets/js/jquery.min.js"></script>
        <script src="/public/assets/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
        <script src="/public/_profiler/assets/js/request.js"></script>
    </body>
</html>

