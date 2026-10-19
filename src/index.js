import React from 'react';
import ReactDOM from 'react-dom/client';
import './index.css';
import App from './App';
import Button from './component/Button';
import Card from "./component/Card";
import Counter from "./component/Counter";
import List from "./component/List";
import reportWebVitals from './reportWebVitals';

const root = ReactDOM.createRoot(document.getElementById('root'));
root.render(
  <React.StrictMode>
    <Button />
    <Card 
        name = "Mark Daniel"
        description = "This is me."/>
    <Counter />
    <List />
  </React.StrictMode>
);

// If you want to start measuring performance in your app, pass a function
// to log results (for example: reportWebVitals(console.log))
// or send to an analytics endpoint. Learn more: https://bit.ly/CRA-vitals
reportWebVitals();
