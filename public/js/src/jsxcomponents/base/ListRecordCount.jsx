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
 * @filesource  ListRecordCount.jsx
 */

import React from 'react';

var ListRecordCount = React.createClass({    
    getInitialState () {
        var items = [10,20,30,40,50,60,70,80,90,100];
        return {items: items, selected:10};
    },
    handleChange(event) {
        this.setState({selected:event.target.value});
    },
    render() {

        var classMap = {
            divSelect: "form-group pull-left form-inline"
        };

        var options = this.state.items.map(function(row,i) {
            return (
                <option value={row} key={i}>{row}</option>
            );
        });

        return (
            <div className={classMap.divSelect}>
                <label htmlFor="rows_per_page">Rows per page [translate]:</label>&nbsp;
                <select name="page_size" id="page-size" className="form-control">
                    {options}
                </select>
            </div>
        );
    }
});

export default ListRecordCount;