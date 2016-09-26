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
 * @filesource  List.jsx
 */

import React from 'react';
import Filter from './Filter.jsx';
import ListRecordCount from './ListRecordCount.jsx';
import ListTable from './ListTable.jsx';

var List = React.createClass ({
    getInitialState () {
        return {structure: []};
    },
    loadStructure() {
        this.setState({structure: []});
        $.ajax({
            url: this.props.apiUrl + "/structure",
            method: 'get',
            dataType: 'json',
            cache: false,
            success: function(data) {
                this.setState({structure: data});
            }.bind(this),
            error: function(xhr, status, err) {
                console.log(xhr);
            }.bind(this)
        });
    },
    componentDidMount() {
        this.onFilterClear();
    },
    onFilterClear() {
        console.log("Filter clear");
        this.loadStructure();
    },
    render () {
        var onFilterClick = this.onFilterClear.bind(null,this);

        var apiDelete = this.props.apiUrl + "delete";
        var editUrl = this.props.baseUrl + "edit"

        var classMap = {
            outDiv: "box-footer clearfix",
            rowNarrow: "row row-narrow-5",
            divSelect: "form-group pull-left form-inline",
            btnSuccess: "btn btn-success",
            btnSuccessIcon: "fa fa-file-o",
            btnDelete: "btn btn-danger hidden",
            btnDeleteIcon: "fa fa-trash-o"
        };

        return (
            <div className="row">
                <div className="col-xs-12">
                    <div className="box">
                        <div className="box-header">
                            <h3 className="box-title">List of [title to be translated]</h3>
                        </div>    
                        <div className="box-body">
                            <Filter 
                                apiUrl={this.props.apiUrl} 
                                structure={this.state.structure}
                                onFilterClick={this.onFilterClear}
                            />
                            <div className={classMap.outDiv}>
                                <div className={classMap.rowNarrow}>
                                    <ListRecordCount />
                                    <div className="pull-right">
                                        <a 
                                            className={classMap.btnSuccess} 
                                            href={editUrl}
                                        >
                                            <i className="classMap.btnSuccessIcon"></i>
                                            &nbsp;New record [translate]
                                        </a>
                                        <a 
                                            id="delete-many" 
                                            className={classMap.btnDelete} 
                                            href={apiDelete}
                                        >
                                            <i className={classMap.btnDeleteIcon}></i>
                                            &nbsp;Delete selected [translate]
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <ListTable
                                apiUrl={this.props.apiUrl} 
                                structure={this.state.structure}
                            />
                        </div>
                    </div>
                </div>
            </div>
        ); 
    }
});
export default List;

