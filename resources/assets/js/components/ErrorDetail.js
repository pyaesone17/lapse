import React, { Component } from 'react';
import axios from "axios";
import {
  Link
} from 'react-router-dom'

axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

export default class ErrorDetail extends Component {

    constructor(props)
    {
        super(props)
        this.state = {
            data: ''
        }
    }

    componentDidMount() {
        this.fetchData(this.props.id)    
    }

    fetchData(id) {
        // Whenever the table model changes, or the user sorts or changes pages, 
        // this method gets called and passed the current table model.
        // You can set the `loading` prop of the table to true to use the built-in one or 
        // show you're own loading bar if you want.
        this.setState({ loading: true });
        // Request the data however you want.  Here, we'll use our mocked service we created earlier
        axios
        .get(this.props.detailUrl+'/'+id)
        .then(response => {
            this.setState({
                data: response.data,
                loading: false
            });
        });
    }


    render() {
        let {data} = this.state;
        return (
            <div>
            {
                data &&
                <div>
                    <h2>{data.title}</h2>
                    <div>User Id : {data.user_id ? data.user_id : 'unknown'}</div>
                    <br/>
                    <div>Url : <a href={data.url} target="_blank"> {data.url} </a> </div>
                    <br/>
                    <div>Exception type: {data.class}</div>
                    <br/>
                    <div>Error Id : {data.id }</div>
                    <br/>
                    <div>Time : {data.created_at }</div>
                    <br/>
                    <div>{data.content}</div>

                    <h4> <Link to='/'> Back </Link> </h4>
                </div>
            }
            </div>
        );
    }
}
