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
 * @filesource  FilterList.jsx
 */

import React from 'react';

var FilterList = React.createClass({

    getInitialState () {
        var selected = 0;
        if(this.props.structure.list.multiple === true) {
            selected = [];
        }
        return {data: [], selected:selected};
    },

    loadData() {
        if(this.props.structure.related === true) {
            var url = this.props.structure.list.url;
            var params = "";
            if(this.props.structure.list.filter) {
                for(var k in this.props.structure.list.filter) {
                    if(typeof this.props.structure.list.filter[k] === "object") {
                        for(var kk in this.props.structure.list.filter[k]) {
                            params += "filter[" + k + "][" + kk + "]=" + this.props.structure.list.filter[k][kk] + "&";
                        }
                    } else {
                        params += "filter[" + k + "]=" + this.props.structure.list.filter[k] + "&";
                    }
                }
            }
            if(params) {
                params = "?" + params;
                params = params.replace(/&+$/,'');
            }

            $.ajax({
                url: url + params,
                method: 'get',
                dataType: 'json',
                cache: false,
                success: function(data) {
                    var options;
                    var selected;
                    if(Array.isArray(data)) {
                        options = data;
                        options.push({id:0,name:""});
                        
                        selected = this.props.structure.list.defaults;
                        
                    } else {
                        options = [{id:0, name: "Error loading data from server. [translate]"}];
                        selected = 0;
                    }
                    options.sort(function(a,b){
                        if(a.name < b.name) return -1;
                        if(a.name > b.name) return 1;
                        return 0;
                    });
                    this.setState({data: data, selected: selected});
                }.bind(this),
                error: function(xhr, status, err) {
                    var errString = "Error (" + xhr.status + " - " + xhr.statusText + "). [translate]";
                    var options = [{id:0,name: errString}];
                    var selected = 0;
                    this.setState({data: options, selected: selected});
                }.bind(this)
            });
        } else {
            this.props.structure.list.values.sort(function(a,b){
                if(a.name < b.name) return -1;
                if(a.name > b.name) return 1;
                return 0;
            });
            this.setState({data: this.props.structure.list.values,selected: this.props.structure.list.defaults});
        }
    },

    componentDidMount() {
        this.loadData(this.props.structure.list.values);
    },

    handleChange(event) {
        var items;
        if(this.props.structure.list.multiple) {
            items = [];
            var options = event.target.options;
            for (var i = 0, l = options.length; i < l; i++) {
                if (options[i].selected) {
                    items.push(options[i].value);
                }
            }
        } else {
            items = event.target.value;
        }
        this.setState({selected: items});        
    },

    render() {
        var classMap = {
            filterSelect: "form-control select2",
            filterSelectStyle: {width: '100%'}
        };
        
        var options = this.state.data.map(function(row,i) {
            return (
                <option value={row.id} key={i}>{row.name}</option>
            );
        });

        var filterId = "filter-" + this.props.structure.name;
        var filterName = "filter[" + this.props.structure.name + "]";
        return (
            <div className="form-group">
                <label 
                    className="sr-only" 
                    htmlFor={filterId}
                >
                    {this.props.structure.caption}
                </label>
                <select 
                    className={classMap.filterSelect} 
                    onChange={this.handleChange} 
                    multiple={this.props.structure.list.multiple} 
                    style={classMap.filterSelectStyle} 
                    id={filterId} 
                    name={filterName} 
                    value={this.state.selected}
                >
                    {options}
                </select>
            </div>
        );
    }
});

export default FilterList;
