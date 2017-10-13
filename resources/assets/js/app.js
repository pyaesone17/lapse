import ErrorTable from "./components/ErrorTable";
import ErrorDetail from "./components/ErrorDetail";
import React from 'react';
import ReactDOM from 'react-dom';
import {
  BrowserRouter as Router,
  Route,
  Link
} from 'react-router-dom'


const Home = ({match}) => (
    <div>
        <ErrorTable url={window.currentUrl} />
    </div>
)

const Detail = ({ match }) => (
    <div>
        <ErrorDetail detailUrl={window.detailUrl} id={match.params.id}/>
    </div>
);


const SPA = () => (
    <Router basename={'lapse'}>
        <div>
            <Route exact path="/" component={Home}/>
            <Route path="/:id" component={Detail}/>
        </div>
    </Router>
)

if (document.getElementById('error-displayer')) {
    ReactDOM.render(
        <SPA/>,
        document.getElementById('error-displayer')
    )
} else{
    alert('Please provide error-displayer element');
}

