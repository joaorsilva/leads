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

var List = React.createClass ({
    getInitialState () {
        return {structure: []};
    },
    loadStructure() {
        $.ajax({
            url: this.props.apiUrl + "/structure",
            method: 'get',
            dataType: 'json',
            cache: false,
            success: function(data) {
                console.log("Got data");
                this.setState({structure: data});
            }.bind(this),
            error: function(xhr, status, err) {
                console.log(xhr);
            }.bind(this)
        });
    },
    componentWillMount() {
      this.loadStructure();
    },
    render () {
        console.log("List render");
        return (
            <div className="row">
                <div className="col-xs-12">
                    <div className="box">
                        <div className="box-header">
                            <h3 className="box-title">List of [title to be translated]</h3>
                        </div>    
                        <div className="box-body">
                            <Filter apiUrl={this.props.apiUrl} structure={this.state.structure}/>
                            The table goes here {this.props.apiUrl}
                        </div>
                    </div>
                </div>
            </div>
        ); 
    }
});
export default List;

