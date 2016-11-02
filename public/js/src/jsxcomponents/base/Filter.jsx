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
 * @filesource  Filter.jsx
 */

import React from 'react';
import FilterInt from './FilterInt.jsx';
import FilterString from './FilterString.jsx';
import FilterList from './FilterList.jsx';

var Filter = React.createClass ({
    handleClear(event) {        
        event.preventDefault();
        this.props.onFilterClick();
    },
    render() {
        var classMap = {
            filterBox: "box box-primary collapsed-box box-solid", //
            filterHeader: "box-header with-border",
            filterIcon: "fa fa-filter",
            filterBoxTools: "box-tools pull-right",
            filterBoxClose: "btn btn-box-tool",
            filterBoxCloseIcon: "fa fa-plus",
            filterButtonsDiv: "form-group pull-right",
            filterButtonSubmit: "btn btn-success",
            filterButtonSubmitIcons: "fa fa-filter",
            filterButtonClear: "btn btn-info",
            filterButtonClearIcons: "fa fa-eraser"
        };
        var fields = this.props.structure.map(function(field,i) {
            if(field.showfilter === true) {
                if(field.type === "uint" || field.type === "int") {
                    return (
                        <FilterInt structure={field} id={field.name} key={i}/>
                    );            
                } else if (field.type === "string") {
                    return (
                        <FilterString structure={field} id={field.name} key={i}/>
                    );            
                } else if(field.type === "list") {
                    return (
                        <FilterList structure={field} id={field.name} key={i} />
                    );            
                }
            }
        });
        return (
            <div className={classMap.filterBox}>
                <div className={classMap.filterHeader}>
                    <h3 className="box-title"><i className={classMap.filterIcon}></i>&nbsp;[Data filer to be translated]</h3>
                    <div className={classMap.filterBoxTools}>
                        <button id="filter-collapse" type="button" className={classMap.filterBoxClose} data-widget="collapse" >
                            <i className={classMap.filterBoxCloseIcon}></i>
                        </button>    
                    </div>
                </div>
                <div className="box-body">
                    <form id="form-filter" name="filter" method="get" action={this.props.apiUrl}>
                        {fields}
                        <div className={classMap.filterButtonsDiv}>
                            <button id="filter-submit" type="submit" className={classMap.filterButtonSubmit}><i className={classMap.filterButtonSubmitIcons}></i>&nbsp;Filter [translate]</button>&nbsp;
                            <button id="filter-clear" type="button" onClick={this.handleClear} className={classMap.filterButtonClear}><i className={classMap.filterButtonClearIcons}></i>&nbsp;Clear [translate]</button>
                        </div>
                    </form>
                </div>
            </div>
        );
    }
});

export default Filter;
