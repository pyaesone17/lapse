import ReactTable from "react-table";
import "react-table/react-table.css";
import React, { Component } from 'react';
import ErrorDetail from './ErrorDetail';
import namor from "namor";
import moment from "moment";
import axios from "axios";
import {
  BrowserRouter as Router,
  Route,
  Link
} from 'react-router-dom'

axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

export default class ErrorTable extends Component {

    constructor() {
        super();
        this.state = {
            data: [],
            pages: null,
            loading: true
        };
    }

    fetchData(state, instance) {
        // Whenever the table model changes, or the user sorts or changes pages, 
        // this method gets called and passed the current table model.
        // You can set the `loading` prop of the table to true to use the built-in one or 
        // show you're own loading bar if you want.
        this.setState({ loading: true });
        // Request the data however you want.  Here, we'll use our mocked service we created earlier
        axios
        .get(this.props.url, {
            params: {
                per_page: state.pageSize,
                page: state.page+1,
                sorted: state.sorted,
                filtered: state.filtered
            }
        })
        .then(response => {
            this.setState({
                data: response.data.data,
                pages: response.data.last_page,
                loading: false
            });
        });
    }

    getColumns()
    {
        const data = this.state.data.map( d => {
                return {
                    id: d.id,
                    title: d.title,
                    type: d.class,
                    reason: d.content,
                    url: d.url,
                    user_id: d.user_id,
                    created_at: d.created_at,
                    view: <div style={{ textAlign: 'center'}}>
                        <Link to={`/${d.id}`}>
                            View
                        </Link>
                    </div>
                }
            }
        )
        const columns = [
            {
                Header: 'Information',
                columns: [
                    {
                        Header: 'Title',
                        accessor: "title",
                        filterable: false,
                        sortable: false,
                        width : 300
                    },
                    {
                        Header: 'Type',
                        accessor: "type",
                        filterable: false,
                        sortable: false
                    },
                    {
                        Header: 'Url',
                        accessor: "url",
                        filterable: false,
                        sortable: false
                    },
                    {
                        Header: 'User ID',
                        accessor: "user_id",
                        filterable: false,
                        sortable: false
                    }
                ]
            },
            {
                Header: "Reason",
                columns: [
                    {
                        Header: 'Reason',
                        accessor: "reason",
                        filterable: false,
                        sortable: false
                    }
                ]
            },
            {
                Header: "Date",
                columns: [
                    {
                        Header: "Time",
                        accessor: "created_at",
                        filterable: false,
                        sortable: false
                    }
                ]
            },
            {
                Header: "Action",
                columns: [
                    {
                        Header: "View",
                        accessor: "view",
                        filterable: false,
                        sortable: false
                    }
                ]
            },
        ];
        return [data, columns];        
    }

    render() {
        let [data, columns] = this.getColumns();
        let { pages, loading } = this.state;
        let { url } = this.props;
        return (
            <div>
                <div className="table-wrap">
                    <ReactTable
                        className="-striped -highlight"
                        columns={columns}
                        manual // Forces table not to paginate or sort automatically, so we can handle it server-side
                        defaultPageSize={20}
                        onFetchData={this.fetchData.bind(this)}
                        data={data}
                        pages={pages} // Display the total number of pages
                        loading={loading} // Display the loading overlay when we need it
                        filterable
                        responsive={true}
                    />
                </div>
            </div>
        );
    }
}
