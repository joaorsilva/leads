/**
 * Spagi Leads
 *
 * An open source leads manager
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2016 - 2016, SPAGI Systems
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	Spagi Leads
 * @author	SPAGI Systems
 * @copyright	Copyright (c) 2016 - 2016, SPAGI Systems (http://spagiweb.com.br/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	https://spagiweb.com.br
 * @since	Version 1.0.0
 * @filesource  ListTable.jsx
 */

import React from 'react';

var ListTable = React.createClass({
    getInitialState () {
        return {
            showLoader:"hidden",
            showError:"hidden",
            showNodata:"hidden",
            columnCount:1,
            columnSorted: {name: "id", dir: "asc"},
        };
    },
    handleSort(event) {
        event.preventDefault();
    },
    getColumnAlign(column) {
        console.log(column.type);
        if(column.type === "boolean") {
            return "text-center";
        } else if(column.type === "date" || column.type === "datetime" || column.type === "int" || column.type === "uint" || column.type === "double") {
            return "text-right";
        }
        return "text-left";
    },
    render() {
        var classMap = {
            tableClasses: "table table-responsive table-bordered table-hover",
            loaderIconClasses: "fa fa-spinner fa-spin",
            loaderProblemIconClasses: "fa fa-warning",
            loaderButtonRetryClasses: "btn btn-warning",
            loaderButtonRetryIconClasses: "fa fa-refresh",
            loaderCallOutClasses: "callout callout-danger",
            nodataCallOutClassses: "callout callout-warning",
            nodataCallOutIconClassses: "fa fa-exclamation-circle",
            tableColumnClasses: "hidden-xs", //TODO: Bing this data from structure
            tableColumnSortedClasses: "glyphicon glyphicon-sort pull-right"
        };
        
        
        var sortClickFunction = this.handleSort;
        var thisObject = this;
        var columns = this.props.structure.map(function(col,i) {
            if(col.showlist === true) {
                var fieldName = "field-" + col.name;
                var colClasses = thisObject.getColumnAlign(col) + " " + classMap.tableColumnClasses;
                return (
                    <th className={colClasses} key={i}>
                        <a href="#" onClick={sortClickFunction} id={fieldName}>
                            {col.caption}&nbsp;
                            <i className={classMap.tableColumnSortedClasses}></i>
                        </a>
                    </th>
                );
            }
        });        

        return(
            <div className="table-responsive">
                <table id="list" className={classMap.tableClasses}>
                    <thead>
                        <tr>
                            <th className="text-center">&nbsp;</th>
                            {columns}
                        </tr>
                    </thead>
                    <tbody>
                        <tr id="row-single" className={this.state.showLoader}>
                            <td colSpan={this.state.columnCount} className="text-center"><i className={classMap.loaderIconClasses}></i>&nbsp;Loading... [translate]</td>
                        </tr>
                        <tr id="row-error" className={this.state.showError}>
                            <td colSpan="{this.state.columnCount}" className="text-center">
                                <div className={classMap.loaderCallOutClasses}>
                                    <h4><i className={classMap.loaderProblemIconClasses}></i>&nbsp;Error loading your data. [translate] </h4>
                                    <p>Problem loading [translate]</p>
                                    <button id="table-retry" type="button" className={classMap.leaderRetryClasses}><i className={classMap.loaderButtonRetryIconClasses}></i>&nbsp;Retry</button>
                                </div>
                            </td>
                        </tr>
                        <tr id="row-no-data" className={this.state.showNodata}>
                            <td colSpan="{this.state.columnCount}" className="text-center">
                                <div className={classMap.nodataCallOutClassses}>
                                    <h4>
                                        <i className={classMap.nodataCallOutIconClassses}></i>
                                        &nbsp;No data found! [translate]</h4>
                                    <p>No data found using that criteria. [translate]</p>
                                </div>
                            </td>
                        </tr>              
                    </tbody>
                </table>
            </div>
        );
    }
});

export default ListTable;